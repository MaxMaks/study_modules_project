<?php
class Study_Banner_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
    parent::__construct();
 
    $this->setSaveParametersInSession(true);
    $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel(
            'banner/banner'
        )->getCollection();
   
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
   
        return $this->getUrl(
            'banners/banner/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareMassaction()
    {
        parent::_prepareMassaction();
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('banners'); 
    
        $this->getMassactionBlock()->addItem(
            'study_banner',
            array('label' => $this->__('Delete'), 
                 'url' => $this->getUrl('*/*/massDelete')
            )
        );

          $this->getMassactionBlock()->addItem('status', array(
             'label'=> $this->_getHelper()->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'status' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => $this->_getHelper()->__('Status'),
                         'values' => array(1 => $this->_getHelper()->__('Enable'),
                               0 => $this->_getHelper()->__('Disable'))
                     )
             )
        ));
    }

    public function getId()
    {
        return 'bannersGrid';
    }

    protected function _prepareColumns()
    {

        
        $this->addColumn('banner_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'id',
        ));

        $this->addColumn('title', array(
            'header' => $this->_getHelper()->__('title'),
            'type' => 'text',
            'index' => 'title',
        ));

        $this->addColumn('url', array(
            'header' => $this->_getHelper()->__('Url'),
            'type' => 'text',
            'index' => 'url',
        ));

        $this->addColumn('image', array(
            'header' => $this->_getHelper()->__('Image'),
            'type' => 'text',
            'index' => 'image',
        ));

        $this->addColumn('sort', array(
            'header' => $this->_getHelper()->__('Sort'),
            'type' => 'number',
            'index' => 'sort',
        ));
        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created at'),
            'type' => 'date',
            'index' => 'created_at',
        ));
        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated at'),
            'type' => 'date',
            'index' => 'updated_at',
        ));

       
        $this->addColumn('status', array(
            'header' => $this->_getHelper()->__('Status'),
            'type' => 'options',
            'index' => 'status',
            'options' => array(1 => $this->_getHelper()->__('Enable'),
                	           0 => $this->_getHelper()->__('Disable'))
        ));

       
        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => array(
                        'base' => 'banners'
                                  . '/banner/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'id',
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {

        return $this->getUrl('*/banner/grid', array('_current' => true));
    }

    protected function _getHelper()
    {
        return Mage::helper('study_banner');
    }




    public function getJavaScript()
    {   
    return "   {$this->getJsObjectName()} = new varienGridMassaction('{$this->getHtmlId()}', "
            . "{$this->getGridJsObjectName()}, '{$this->getSelectedJson()}'"
            . ", '{$this->getFormFieldNameInternal()}', '{$this->getFormFieldName()}');"
            . "{$this->getJsObjectName()}.setItems({$this->getItemsJson()}); "
            . "{$this->getJsObjectName()}.setGridIds('{$this->getGridIdsJson()}');"
            . ($this->getUseAjax() ? "{$this->getJsObjectName()}.setUseAjax(true);" : '')
            . ($this->getUseSelectAll() ? "{$this->getJsObjectName()}.setUseSelectAll(true);" : '')
            . "{$this->getJsObjectName()}.errorText = '{$this->getErrorText()}';";
    }
}
