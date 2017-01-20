<?php
class Study_Banner_Block_Bannerhtml_Banner extends Mage_Core_Block_Template
{
	public function getBanners()
	{

		$banners = Mage::getModel('banner/banner')->getCollection()
		    ->addFieldToFilter('status', array('eq' => 1))
		    ->setOrder('sort', 'ASC')
		    ->setPageSize(10);
		return $banners;
	}
}
