<?php
class Study_Banner_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {   

        $this->_blockGroup = 'study_banner_adminhtml';
        $this->_controller = 'banner';
		
        
        $this->_mode = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Edit') : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Banner');
        


    }
   
}