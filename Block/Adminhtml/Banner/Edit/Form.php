<?php
class Study_Banner_Block_Adminhtml_Banner_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

	
    protected function _prepareForm()
    {

        // Instantiate a new form to display our brand for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'enctype' => 'multipart/form-data',
            'action' => $this->getUrl(
                'banners/banner/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
     
        
        $form->setUseContainer(true);

        $this->setForm($form);

        // Define a new fieldset. We need only one for our simple entity.
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Banner Details')
            )
        );

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'title' => array(
                'label' => $this->__('title'),
                'input' => 'text',
                'required' => true,
            ),
            'url' => array(
                'label' => $this->__('Url'),
                'input' => 'text',
                'required' => true,
            ),
            'image' => array(
                'label' => $this->__('Image'),
                'input' => 'image',
                'required' => true,
            ),
            'sort' => array(
                'label' => $this->__('Sort'),
                'input' => 'text',
                'required' => true,
            ),
            'status' => array(
                'label' => $this->__('Status'),
                'input' => 'select',
                'required' => true,
                'options' =>  array(1 => $this->_getHelper()->__('Enable'),
                	           0 => $this->_getHelper()->__('Disable'))
            ),

        ));
        
        return $this;
    }

    
    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('bannerData'));

        foreach ($fields as $name => $_data) {

            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

         
            $_data['name'] = "bannerData[$name]";

            // label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing banner data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getBanner()->getData($name);
            }

            

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

   
    protected function _getBanner()
    {

        if (!$this->hasData('banner')) {

            // This will have been set in the controller.
            $banner = Mage::registry('current_banner');

            // Just in case the controller does not register the banner.
            if (!$banner instanceof
                    Study_Banner_Model_Banner) {
                $banner = Mage::getModel(
                    'banner/banner'
                );
            }

            $this->setData('banner', $banner);
            
        }
       
        return $this->getData('banner');
    }

    protected function _getHelper()
    {
        return Mage::helper('study_banner');
    }
}