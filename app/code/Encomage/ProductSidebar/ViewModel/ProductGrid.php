<?php
namespace Encomage\ProductSidebar\ViewModel;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection as LinkCollection;

/**
 * Class ProductGrid. Retrieve all products data
 */
class ProductGrid implements ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    private $productCollection;

    /**
     * @var LinkCollection
     */
    private $linkCollection;

    /**
     * ProductGrid constructor.
     *
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection
     */
    public function __construct(
        Collection $productCollection,
        LinkCollection $linkCollection
    ) {
        $this->productCollection = $productCollection;
        $this->linkCollection = $linkCollection;
    }

    /**
     * Return Product Collection
     */
    public function getProductCollection()
    {
        $select = $this->productCollection->getSelect()
            ->orderRand('e.entity_id')
            ->limit(3);
        $collection = $this->productCollection->addAttributeToSelect('*')
            ->addPriceData()
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addFieldToFilter('type_id', ['eq' => 'simple']);
        return $collection;
    }
}
