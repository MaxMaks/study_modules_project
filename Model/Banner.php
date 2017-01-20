<?php
class Study_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('banner/banner');
    }

     protected function _beforeSave()
     {
        parent::_beforeSave();

        $currentTime = Varien_Date::now();

            
        if ((!$this->getId() || $this->isObjectNew()) || !$this->getCreatedAt()) {

            $this->setCreatedAt($currentTime);

        }

        $this->setUpdatedAt($currentTime);  

        return $this;  
     }
} 