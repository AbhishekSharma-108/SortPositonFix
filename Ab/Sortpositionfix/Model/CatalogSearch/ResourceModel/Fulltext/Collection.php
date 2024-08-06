<?php
namespace Ab\Sortpositionfix\Model\CatalogSearch\ResourceModel\Fulltext;

use Magento\Framework\App\ObjectManager;

class Collection extends \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
{
    protected function _renderFiltersBefore()
    {
        /**
         * @var \Magento\Framework\App\RequestInterface $request
         */
        if (isset($_SERVER['REQUEST_URI']) && !stristr($_SERVER['REQUEST_URI'], "catalogsearch")) {
            $request = ObjectManager::getInstance()->create("\Magento\Framework\App\RequestInterface");
            if ($request->getParam("product_list_order")) {
                $attribute = $request->getParam("product_list_order", "position");
                $direction = $request->getParam("product_list_dir", "asc");
                $this->addAttributeToSort($attribute, $direction);
            } else {
                $this->addAttributeToSort("position", "asc");
            }
        }

        parent::_renderFiltersBefore();
    }
}
