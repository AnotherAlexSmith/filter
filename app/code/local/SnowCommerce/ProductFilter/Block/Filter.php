<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 09.07.13
 * Time: 17:22
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_ProductFilter_Block_Filter extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $collection = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('sc_is_filtered', array("eq" => "1"));
        $this->setCollection($collection);
    }

//    public function arrayFiltering()
//    {
//        $collection = Mage::getResourceModel('catalog/product_attribute_collection')
//            ->addFieldToFilter('sc_is_filtered', array("eq" => "1"));
//        return $collection;
//    }

    public function buildSelect($attr)
    {
        $data = Mage::app()->getRequest()->getParams();
        $result = "<h2>".$attr->getFrontendLabel()."</h2>";
        $result .= "<select name='".$attr->getAttributeCode()."'>";

        foreach ($attr->getSource()->getAllOptions(true, true) as $instance)
        {
            $result .= "<br /><option ";
            if($data[$attr->getAttributeCode()] == $instance['value'])
            {
                $result .= "selected ";
            }
            $result .= "value='".$instance['value']."'>".$instance['label']."</option>";
        }
        $result .= "<br /></select><br /><br />";
        return $result;
    }
}