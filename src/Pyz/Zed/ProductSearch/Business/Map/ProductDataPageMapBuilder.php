<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSearch\Business\Map;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Generated\Shared\Transfer\RawProductAttributesTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface;
use Spryker\Zed\Price\Business\PriceFacadeInterface;
use Spryker\Zed\ProductImage\Persistence\ProductImageQueryContainerInterface;
use Spryker\Zed\ProductSearch\Business\ProductSearchFacadeInterface;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

/**
 * @method \Pyz\Zed\Collector\Communication\CollectorCommunicationFactory getFactory()
 */
class ProductDataPageMapBuilder
{

    /**
     * @var \Spryker\Zed\Price\Business\PriceFacadeInterface
     */
    protected $priceFacade;

    /**
     * @var \Spryker\Zed\ProductSearch\Business\ProductSearchFacadeInterface
     */
    protected $productSearchFacade;

    /**
     * @var \Generated\Shared\Transfer\ProductSearchAttributeMapTransfer[]
     */
    protected $attributeMap;

    /**
     * @var \Spryker\Zed\ProductImage\Persistence\ProductImageQueryContainerInterface
     */
    protected $productImageQueryContainer;

    /**
     * @var \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface
     */
    protected $categoryQueryContainer;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    private $productFacade;

    /**
     * @param \Spryker\Zed\ProductSearch\Business\ProductSearchFacadeInterface $productSearchFacade
     * @param \Spryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     * @param \Spryker\Zed\Price\Business\PriceFacadeInterface $priceFacade
     * @param \Spryker\Zed\ProductImage\Persistence\ProductImageQueryContainerInterface $productImageQueryContainer
     * @param \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface $categoryQueryContainer
     */
    public function __construct(
        ProductSearchFacadeInterface $productSearchFacade,
        ProductFacadeInterface $productFacade,
        PriceFacadeInterface $priceFacade,
        ProductImageQueryContainerInterface $productImageQueryContainer,
        CategoryQueryContainerInterface $categoryQueryContainer
    ) {
        $this->priceFacade = $priceFacade;
        $this->productSearchFacade = $productSearchFacade;
        $this->productImageQueryContainer = $productImageQueryContainer;
        $this->productFacade = $productFacade;
        $this->categoryQueryContainer = $categoryQueryContainer;
    }

    /**
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function buildPageMap(PageMapBuilderInterface $pageMapBuilder, array $productData, LocaleTransfer $localeTransfer)
    {
        $pageMapTransfer = (new PageMapTransfer())
            ->setStore(Store::getInstance()->getStoreName())
            ->setLocale($localeTransfer->getLocaleName());

        $attributes = $this->getProductAttributes($productData);
        $price = $this->getPriceBySku($productData['abstract_sku']);

        /*
         * Here you can hard code which product data will be used for which search functionality
         */
        $pageMapBuilder
            ->addSearchResultData($pageMapTransfer, 'id_product_abstract', $productData['id_product_abstract'])
            ->addSearchResultData($pageMapTransfer, 'abstract_sku', $productData['abstract_sku'])
            ->addSearchResultData($pageMapTransfer, 'abstract_name', $productData['abstract_name'])
            ->addSearchResultData($pageMapTransfer, 'price', $price)
            ->addSearchResultData($pageMapTransfer, 'url', $this->getProductUrl($productData))
            ->addSearchResultData($pageMapTransfer, 'images', $this->generateImages($productData['id_image_set']))
            ->addFullTextBoosted($pageMapTransfer, $productData['abstract_name'])
            ->addSuggestionTerms($pageMapTransfer, $productData['abstract_name'])
            ->addCompletionTerms($pageMapTransfer, $productData['abstract_name'])
            ->addStringSort($pageMapTransfer, 'name', $productData['abstract_name'])
            ->addIntegerSort($pageMapTransfer, 'price', $price)
            ->addIntegerFacet($pageMapTransfer, 'price', $price);

        $this->setCategories($pageMapBuilder, $pageMapTransfer, $productData, $localeTransfer);

        $pageMapTransfer = $this->setIsFeatured($pageMapTransfer, $attributes);

        /*
         * We'll then extend this with dynamically configured product attributes from database
         */
        $pageMapTransfer = $this
            ->productSearchFacade
            ->mapDynamicProductAttributes($pageMapBuilder, $pageMapTransfer, $attributes);

        return $pageMapTransfer;
    }

    /**
     * @param array $productData
     *
     * @return array
     */
    protected function getProductAttributes(array $productData)
    {
        $abstractAttributesData = $this->productFacade->decodeProductAttributes($productData['abstract_attributes']);
        $abstractLocalizedAttributesData = $this->productFacade->decodeProductAttributes($productData['abstract_localized_attributes']);

        $concreteAttributesDataCollection = $this->productFacade->decodeProductAttributes('[' . $productData['concrete_attributes'] . ']');
        $concreteLocalizedAttributesDataCollection = $this->productFacade->decodeProductAttributes('[' . $productData['concrete_localized_attributes'] . ']');
        // TODO: need to loop over concrete collections and collect all possible attribute data

        $rawProductAttributesTransfer = new RawProductAttributesTransfer();
        $rawProductAttributesTransfer
            ->setAbstractAttributes($abstractAttributesData)
            ->setAbstractLocalizedAttributes($abstractLocalizedAttributesData)
            ->setConcreteAttributes($concreteAttributesDataCollection)
            ->setConcreteLocalizedAttributes($concreteLocalizedAttributesDataCollection);

        return $this->productFacade->combineRawProductAttributes($rawProductAttributesTransfer);
    }

    /**
     * @param string $sku
     *
     * @return int
     */
    protected function getPriceBySku($sku)
    {
        return $this->priceFacade->getPriceBySku($sku);
    }

    /**
     * @param array $productData
     *
     * @return bool
     */
    protected function getProductUrl(array $productData)
    {
        $productUrls = explode(',', $productData['product_urls']);

        return $productUrls[0];
    }

    /**
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return void
     */
    protected function setCategories(PageMapBuilderInterface $pageMapBuilder, PageMapTransfer $pageMapTransfer, array $productData, LocaleTransfer $locale)
    {
        $allParentCategories = $this->getAllParentCategories($productData['id_product_abstract'], $locale->getIdLocale());
        $directParentCategories = $this->getDirectParentCategories($productData['id_product_abstract'], $locale->getIdLocale());

        $pageMapBuilder->addCategory($pageMapTransfer, $allParentCategories, $directParentCategories);
    }

    /**
     * @param int $idAbstractProduct
     * @param int $idLocale
     *
     * @return mixed
     */
    protected function getDirectParentCategories($idAbstractProduct, $idLocale)
    {
        $categoryEntities = $this->categoryQueryContainer
            ->queryCategory($idLocale)
            ->useSpyProductCategoryQuery()
                ->filterByFkProductAbstract($idAbstractProduct)
            ->endUse()
            ->find();

        $categoryIds = [];
        foreach ($categoryEntities as $categoryEntity) {
            $categoryIds[] = $categoryEntity->getIdCategory();
        }

        return $categoryIds;
    }

    /**
     * @param int $idAbstractProduct
     * @param int $idLocale
     *
     * @return mixed
     */
    protected function getAllParentCategories($idAbstractProduct, $idLocale)
    {
        $categoryEntities = $this->categoryQueryContainer
            ->queryCategory($idLocale)
            ->useSpyProductCategoryQuery()
                ->filterByFkProductAbstract($idAbstractProduct)
            ->endUse()
            ->find();

        $categoryIds = [];
        foreach ($categoryEntities as $categoryEntity) {
            $nodeEntities = $this->categoryQueryContainer->queryAllNodesByCategoryId($categoryEntity->getIdCategory())->find();

            foreach ($nodeEntities as $nodeEntity) {

                $pathData = $this->categoryQueryContainer->queryPath($nodeEntity->getIdCategoryNode(), $idLocale, false)->find();
                foreach ($pathData as $path) {
                    $categoryIds[] = (int)$path['fk_category'];
                }
            }
        }

        return array_values(array_unique($categoryIds));
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $attributes
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    protected function setIsFeatured(PageMapTransfer $pageMapTransfer, array $attributes)
    {
        $isFeatured = array_key_exists(PageIndexMap::IS_FEATURED, $attributes) ? (bool)$attributes[PageIndexMap::IS_FEATURED] : false;

        $pageMapTransfer->setIsFeatured($isFeatured);

        return $pageMapTransfer;
    }

    /**
     * @param int $idImageSet
     *
     * @return array
     */
    protected function generateImages($idImageSet)
    {
        if ($idImageSet === null) {
            return [];
        }

        $imagesCollection = $this->productImageQueryContainer
            ->queryImagesByIdProductImageSet($idImageSet)
            ->find();

        $result = [];

        foreach ($imagesCollection as $image) {
            $imageArray = $image->getSpyProductImage()->toArray();
            $imageArray += $image->toArray();
            $result[] = $imageArray;
        }

        return $result;
    }

}
