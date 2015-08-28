<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContribuinteList
 *
 * @author Eduardo
 */
class ContribuinteList extends TPage{
    
    private $form;     
    private $datagrid;
    private $pageNavigation;
    private $loaded;    
    
    public function __construct(){
        
        parent::__construct();

        $this->form = new TForm('form_search_Contribuinte');
        $this->form->class = 'tform';
        
        $table = new TTable;
        $table->style = 'width:100%';
        
        $table->addRowSet( new TLabel('Contribuinte'), '' )->class = 'tformtitle';
        
        $this->form->add($table);
        
        $contribuinte_id = new TEntry('contribuinte_id');
        $contribuinte_id->setValue(TSession::getValue('contribuinte_id'));
        
        $contribuinte_nome = new TEntry('contribuinte_nome');
        $contribuinte_nome->setValue(TSession::getValue('contribuinte_nome'));
        
        $row=$table->addRowSet(new TLabel('ID: '),$contribuinte_id);
        $row=$table->addRowSet(new TLabel('Nome/Razão Social: '), $contribuinte_nome);      
        
        $find_button = new TButton('find');
        $new_button  = new TButton('new');
        
        $find_button->setAction(new TAction(array($this, 'onSearch')), _t('Find'));
        $find_button->setImage('ico_find.png');
        
        $new_button->setAction(new TAction(array('ContribuinteForm', 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        $this->form->setFields(array($contribuinte_id, $contribuinte_nome, $find_button, $new_button));

        $container = new THBox;
        $container->add($find_button);
        $container->add($new_button);
        
        $row=$table->addRow();
        $row->class = 'tformaction';
        $cell = $row->addCell( $container );
        $cell->colspan = 2;

        // creates a DataGrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        $contribuinte_id             = new TDataGridColumn('contribuinte_id', 'ID', 'right');
        $contribuinte_nome           = new TDataGridColumn('contribuinte_nome','Nome/Razão Social', 'left');
        $contribuinte_tipo           = new TDataGridColumn('contribuinte_tipo','Tipo', 'left');
        $contribuinte_tipo           = new TDataGridColumn('contribuinte_tipos','Tipo', 'left');
        
        
        $this->datagrid->addColumn($contribuinte_id);
        $this->datagrid->addColumn($contribuinte_nome);
        $this->datagrid->addColumn($contribuinte_tipo);
        
        $order_id= new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'contribuinte_id');
        $contribuinte_id->setAction($order_id);

        $order_name= new TAction(array($this, 'onReload'));
        $order_name->setParameter('order', 'contribuinte_nome');
        $contribuinte_nome->setAction($order_name);
        
        $name_edit = new TDataGridAction(array($this, 'onInlineEdit'));
        $name_edit->setField('contribuinte_id');
        $contribuinte_nome->setEditAction($name_edit);

        // creates two datagrid actions
        $action1 = new TDataGridAction(array('ContribuinteForm', 'onEdit'));
        $action1->setLabel(_t('Edit'));
        $action1->setImage('ico_edit.png');
        $action1->setField('contribuinte_id');
        
        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel(_t('Delete'));
        $action2->setImage('ico_delete.png');
        $action2->setField('contribuinte_id');
        
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        
        $this->datagrid->createModel();
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        $table = new TTable;
        $table->style = 'width: 80%';
        $table->addRow()->addCell(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $table->addRow()->addCell($this->form);
        $table->addRow()->addCell($this->datagrid);
        $table->addRow()->addCell($this->pageNavigation);
        
        // add the table inside the page
        parent::add($table);
    }
    
    function onInlineEdit($param){
        try{
            
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];
            
            
            TTransaction::open('liger');
            
            $object = new Contribuinte($key);
            $object->{$field} = $value;
            $object->store();
            
            TTransaction::close();
            
            $this->onReload($param);
            new TMessage('info', "Alterado com Sucesso");
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    function onSearch(){
        $data = $this->form->getData();
        
        TSession::setValue('contribuinte_id_filter',   NULL);
        TSession::setValue('contribuinte_id', '');
        
        TSession::setValue('contribuinte_nome_filter',   NULL);
        TSession::setValue('contribuinte_nome', '');
        
        if ( $data->contribuinte_id ){
            $filter = new TFilter('contribuinte_id', 'like', "%{$data->contribuinte_id}%");
            
            TSession::setValue('contribuinte_id_filter',   $filter);
            TSession::setValue('contribuinte_id', $data->contribuinte_id);            
        }
        
        if ( $data->contribuinte_nome ){
            $filter = new TFilter('contribuinte_nome', 'like', "%{$data->contribuinte_nome}%");
            
            TSession::setValue('contribuinte_nome_filter',   $filter);
            TSession::setValue('contribuinte_nome', $data->contribuinte_nome);            
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
            
            $repository = new TRepository('Contribuinte');
            $limit = 10;
            $criteria = new TCriteria;
            
            if (TSession::getValue('contribuinte_id_filter')){
                $criteria->add(TSession::getValue('contribuinte_id_filter'));
            }
            if (TSession::getValue('contribuinte_nome_filter')){
                $criteria->add(TSession::getValue('contribuinte_nome_filter'));
            }
            $objects = $repository->load($criteria);
            
            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($object);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
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
        
        // shows a dialog to the user
        new TQuestion(TAdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    function Delete($param){
        try{
            // get the parameter $key
            $key=$param['key'];
            // open a transaction with database 'permission'
            TTransaction::open('liger');
            
            // instantiates object SystemProgram
            $object = new Contribuinte ($key);
            
            // deletes the object from the database
            $object->delete();
            
            // close the transaction
            TTransaction::close();
            
            // reload the listing
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
    
    function show(){
        // check if the datagrid is already loaded
        if (!$this->loaded){
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}
