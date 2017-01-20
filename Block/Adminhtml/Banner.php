<?php
class Study_Banner_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        
        $this->_blockGroup = 'study_banner_adminhtml';

        $this->_controller = 'banner';
        
        $this->_headerText = Mage::helper('study_banner')
            ->__('Banner');

    }

    public function getCreateUrl()
    {
        
        return $this->getUrl(
            'banners/banner/edit'
        );
    }
}