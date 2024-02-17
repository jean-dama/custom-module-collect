<?php
namespace SeuModulo\NomeModulo\Block;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\View\Element\Template\Context;

class RecentProducts extends \Magento\Framework\View\Element\Template
{
    protected $categoryFactory;
    protected $categoryRepository;

    public function __construct(
        Context $context,
        CategoryFactory $categoryFactory,
        CategoryRepositoryInterface $categoryRepository,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getRecentProducts()
    {
        $categoryId = 'teste'; // ID da categoria 'teste'
        $category = $this->categoryFactory->create()->load($categoryId);
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*')
            ->addCategoryFilter($category)
            ->setPageSize(10) // Altere conforme necessário
            ->addAttributeToSort('created_at', 'desc'); // Ordena por produtos mais recentes
        return $collection;
    }
}
