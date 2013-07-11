<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 09.07.13
 * Time: 15:17
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE catalog_eav_attribute ADD sc_is_filtered int(2);
");

$installer->endSetup();