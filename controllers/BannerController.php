<?php 
class Study_Banner_BannerController extends Mage_Adminhtml_Controller_Action{

    public function indexAction()
    {

        $this->loadLayout();    
        $this->_addContent($this->getLayout()
             ->createBlock('study_banner_adminhtml/banner'));
        $this->renderLayout();
        
    }


    public function editAction()
    {

        $banner = Mage::getModel('banner/banner');

        if ($bannerId = $this->getRequest()->getParam('id', false)) {

            $banner->load($bannerId);

            if (!$banner->getId()){
            	 $this->_getSession()->addError(
                    $this->__('This banner no longer exists.')
                );
                return $this->_redirect(
                    'banners/banner/index'
                );
            }
        }

  
        if ($postData = $this->getRequest()->getPost('bannerData')) {
            try {

            

            if($_FILES['bannerData']['tmp_name']['image'] != ''){


               
                $fileName = $_FILES['bannerData']['name']['image'];
                $path = Mage::getBaseDir('media').DS.'banners'.DS.$fileName[0].DS.$fileName[1].DS;

                if(file_exists($path.$fileName)){

                    $this->_getSession()->addError(
                    $this->__('This file is already exist.')
                );
                return $this->_redirect(
                    'banners/banner/edit'
                );

                }

                $uploader = new Varien_File_Uploader('bannerData[image]');
                $uploader->setAllowCreateFolders(true); 
                $uploader->setAllowRenameFiles(false); 
                $uploader->save($path); 
            }


            

            $uploadedFileName = isset($fileName) ? 
                        Study_Banner_Helper_Data::BANNERS_PATH.$fileName[0].DS.$fileName[1].DS.$uploader->getUploadedFileName() 
                        : $banner->getImage();
            
            $banner->addData($postData);
            $banner->setImage($uploadedFileName);
            $banner->save(); 

            

                $this->_getSession()->addSuccess(
                    $this->__('The banner has been saved.')
                );


                return $this->_redirect(
                    'banners/banner/edit',
                    array('id' => $banner->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

            
        }


        Mage::register('current_banner', $banner);


        $bannerEditBlock = $this->getLayout()->createBlock(
            'study_banner_adminhtml/banner_edit'
        );

       
        $this->loadLayout()
            ->_addContent($bannerEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {

        if ($bannerId = $this->getRequest()->getParam('id', false)) {
            $this->deleteBanner($bannerId);
        }

        
        $this->_getSession()->addSuccess(
                $this->__('The banner has been deleted.')
            );
        return $this->_redirect(
            'banners/banner/index'
        );
    }


    protected function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('banners');

        if(!isset($ids)){
            $this->_getSession()->addError(
                    $this->__('No banners selected.')
                );
                return $this->_redirect(
                    'banners/banner/index'
                );
        }

        foreach ($ids as $bannerId) {
            $this->deleteBanner($bannerId);
        }

        $this->_getSession()->addSuccess(
                $this->__('The banners has been deleted.')
            );
        return $this->_redirect(
            'banners/banner/index'
        );
    }

    protected function deleteBanner($bannerId)
    {
        $banner = Mage::getModel('banner/banner');
        $banner->load($bannerId);

        if (!$banner->getId()){
                 $this->_getSession()->addError(
                    $this->__('Banner no longer exists.')
                );
                return $this->_redirect(
                    'banners/banner/index'
                );
            }

        try {
            $banner->delete();

        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }
    }

    protected function massStatusAction()
    {

        $this->loadLayout();

        $ids = $this->getRequest()->getParam('banners');
        $status = $this->getRequest()->getParam('status');

        if(!isset($ids)){
            $this->_getSession()->addError(
                    $this->__('No banners selected.')
                );
                return $this->_redirect(
                    'banners/banner/index'
                );
        }
        
        $banner = Mage::getModel('banner/banner');

        foreach ($ids as $bannerId) {
            $banner->load($bannerId);

            $banner->setStatus($status);

            $banner->save();

        }

        $this->_getSession()->addSuccess(
                $this->__('The banners statuses has been changed.')
            );
        return $this->_redirect(
            'banners/banner/index'
        );


    }

    protected function gridAction()
    {

        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('study_banner_adminhtml/banner_grid')->toHtml()
            );

    }
    
    protected function _isAllowed()
    {
        
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('banners/banner');
                break;
        }

        return $isAllowed;
    }
}