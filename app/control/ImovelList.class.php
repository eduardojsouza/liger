<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImovelList
 *
 * @author Eduardo
 */
class ImovelList extends TPage{
    
    private $form;     // registration form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    
    public function __construct(){
        
        parent::__construct();
        
        $this->form = new TForm('form_search_Imovel');
        $this->form->class = 'tform';
        
        // creates a table
        $table = new TTable;
        $table->style = 'width:100%';
        
        $table->addRowSet( new TLabel('Imóvel'), '' )->class = 'tformtitle';
        
        $this->form->add($table);
        
        $imovel_id = new TEntry('imovel_id');
        $imovel_id->setValue(TSession::getValue('s_id'));
        
        $logradouro = new TEntry('logradouro');
        $logradouro->setValue(TSession::getValue('s_name'));
        
        $row=$table->addRow();
        $row->addCell(new TLabel('ID:'));
        $row->addCell($imovel_id);
        
        $row=$table->addRow();
        $row->addCell(new TLabel('Logradouro' . ': '));
        $row->addCell($logradouro);
        
        $find_button = new TButton('find');
        $new_button  = new TButton('new');

        $find_button->setAction(new TAction(array($this, 'onSearch')), _t('Find'));
        $find_button->setImage('ico_find.png');
        
        $new_button->setAction(new TAction(array('ImovelForm', 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        $container = new THBox;
        $container->add($find_button);
        $container->add($new_button);

        $row=$table->addRow();
        $row->class = 'tformaction';
        $cell = $row->addCell( $container );
        $cell->colspan = 2;
        
        $this->form->setFields(array($imovel_id, $logradouro, $find_button, $new_button));
        
        $this->datagrid = new TDataGrid;
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        // creates the datagrid columns
        $imovel_id   = new TDataGridColumn('imovel_id', 'ID', 'center');
        $logradouro = new TDataGridColumn('logradouro', 'Logradouro', 'center');
    
        $this->datagrid->addColumn($imovel_id);
        $this->datagrid->addColumn($logradouro);
        
        $order_id= new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'imovel_id');
        $imovel_id->setAction($order_id);

        $order_name= new TAction(array($this, 'onReload'));
        $order_name->setParameter('order', 'logradouro');
        $logradouro->setAction($order_name);

        // inline editing
        $name_edit = new TDataGridAction(array($this, 'onInlineEdit'));
        $name_edit->setField('imovel_id');
        $logradouro->setEditAction($name_edit);
        
        $action1 = new TDataGridAction(array('ImovelForm', 'onEdit'));
        $action1->setLabel(_t('Edit'));
        $action1->setImage('ico_edit.png');
        $action1->setField('imovel_id');
        
        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel(_t('Delete'));
        $action2->setImage('ico_delete.png');
        $action2->setField('imovel_id');
        
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        
        $this->datagrid->createModel();
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        $container = new TTable;
        $container->style = 'width: 80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->addRow()->addCell($this->form);
        $container->addRow()->addCell($this->datagrid);
        $container->addRow()->addCell($this->pageNavigation);
        
        parent::add($container);
    }
    
    function onInlineEdit($param){
        try{
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];
            
            TTransaction::open('liger');
            
            $object = new Imovel($key);
            $object->{$field} = $value;
            $object->store();
            
            TTransaction::close();
            
            $this->onReload($param);
            new TMessage('info', "Record Updated");
        }
        catch (Exception $e){
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    function onSearch(){
        $data = $this->form->getData();
        
        TSession::setValue('s_id_filter',   NULL);
        TSession::setValue('s_name_filter', NULL);
        
        TSession::setValue('s_id', '');
        TSession::setValue('s_name', '');
        
        if ( $data->imovel_id ){
            $filter = new TFilter('imovel_id', '=', "{$data->imovel_id}");
            
            TSession::setValue('s_id_filter',   $filter);
            TSession::setValue('s_id', $data->imovel_id);
        }
        if ( $data->logradouro ){
            $filter = new TFilter('logradouro', 'like', "%{$data->logradouro}%");
            
            TSession::setValue('s_name_filter', $filter);
            TSession::setValue('s_name', $data->logradouro);            
        }
        $this->form->setData($data);
        
        $param=array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    function onReload($param = NULL){
        try{
            TTransaction::open('liger');
            
            if( ! isset($param['order']) ){
                $param['order'] = 'imovel_id';
                $param['direction'] = 'asc';
            }
            
            $repository = new TRepository('Imovel');
            $limit = 10;
            $criteria = new TCriteria;
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);
            
            if (TSession::getValue('s_id_filter')){
                $criteria->add(TSession::getValue('s_id_filter'));
            }if (TSession::getValue('s_name_filter')){
                $criteria->add(TSession::getValue('s_name_filter'));
            }
            
            $objects = $repository->load($criteria);
            
            $this->datagrid->clear();
            if ($objects){
                foreach ($objects as $object){
                    $this->datagrid->addItem($object);
                }
            }
            
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    function onDelete($param){
        $action = new TAction(array($this, 'Delete'));
        $action->setParameters($param); // pass the key parameter ahead
        
        new TQuestion(TAdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    function Delete($param){
        try{
            $key=$param['key'];

            TTransaction::open('liger');
            
            $object = new Imovel($key);
            
            $object->delete();
            
            TTransaction::close();
            
            $this->onReload( $param );
            // shows the success message
            new TMessage('info', TAdiantiCoreTranslator::translate('Record deleted'));
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}
