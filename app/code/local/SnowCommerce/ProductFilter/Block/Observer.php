<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 09.07.13
 * Time: 17:06
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_ProductFilter_Block_Observer
{
    public function addField($observe)
    {
        $form = $observe->getEvent()->getForm();
        $fieldset = $form->getElement('base_fieldset');
        $yesnoSource = Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray();
        $fieldset->addField('sc_is_filtered', 'select', array(
            'name'      => 'sc_is_filtered',
            'label'     => Mage::helper('catalog')->__('Used for frontend ProductFilter filtering'),
            'title'     => Mage::helper('catalog')->__('Used for frontend ProductFilter filtering'),
            'note'      => Mage::helper('catalog')->__('Depends on design theme'),
            'values'    => $yesnoSource,
        ));
        return $this;
    }

    public function sortCollection($observe)
    {
        $data = Mage::app()->getRequest()->getParams();
//        var_dump($data);
//        exit;
//        $price_from=Mage::app()->getRequest()->getParam("price_from");
//        $price_to=Mage::app()->getRequest()->getParam("price_to");
        $collection = $observe->getEvent()->getCollection();
        $ignore = array('id','price_from','price_to');
        $prices['gteq'] = '0';
        if($data['price_to'] != 0)
        {
            $prices['lteq'] = $data['price_to'];
            $collection->addFieldToFilter('price',array('lteq' => $data['price_to']));

        }
        if($data['price_from'])
        {
            $collection->addFieldToFilter('price',array('gteq' => $data['price_from']));
            $prices['gteq'] = $data['price_from'];
        }
        foreach($data as $k => $param)
        {
            if($param != "" and !(in_array($k,$ignore)))
            {
                $collection->addFieldToFilter($k,array('eq' => $param));
            }
        }
        return $this;
    }
}