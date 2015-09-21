<?php

class AnoBaseList extends TPage{
    
    private $form;     
    private $datagrid;
    private $pageNavigation;
    private $loaded;
    
    public function __construct(){
        
        parent::__construct();

        $this->form = new TForm('form_search_AnoBase');
        $this->form->class = 'tform';
        
        $table = new TTable;
        $table->style = 'width:100%';
        
        $table->addRowSet( new TLabel('Ano Base'), '' )->class = 'tformtitle';

        $this->form->add($table);
        
        $anobase_id = new TEntry('anobase_id');
        $anobase_id->setValue(TSession::getValue('anobase_id'));
        
        $anobase_data = new TEntry('anobase_data');
        $anobase_data->setValue(TSession::getValue('anobase_data'));
        
        $row=$table->addRowSet(new TLabel('ID: '),$anobase_id);
        $row=$table->addRowSet(new TLabel('Ano Base: '), $anobase_data);

        $find_button = new TButton('find');
        $new_button  = new TButton('new');
        
        // define the button actions
        $find_button->setAction(new TAction(array($this, 'onSearch')), _t('Find'));
        $find_button->setImage('ico_find.png');
        
        $new_button->setAction(new TAction(array('AnoBaseForm', 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        $this->form->setFields(array($anobase_id, $anobase_data, $find_button, $new_button));

        $container = new THBox;
        $container->add($find_button);
        $container->add($new_button);

        $row=$table->addRow();
        $row->class = 'tformaction';
        $cell = $row->addCell( $container );
        $cell->colspan = 2;

        $this->datagrid = new TDataGrid;
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        $anobase_id             = new TDataGridColumn('anobase_id', 'ID', 'right');
        $anobase_data           = new TDataGridColumn('anobase_data','Ano Base', 'left');
        
        $this->datagrid->addColumn($anobase_id);
        $this->datagrid->addColumn($anobase_data);

        $order_id= new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', '$anobase_id');
        $anobase_id->setAction($order_id);

        $order_data= new TAction(array($this, 'onReload'));
        $order_data->setParameter('order', '$anobase_data');
        $anobase_data->setAction($order_data);

        $data_edit = new TDataGridAction(array($this, 'onInlineEdit'));
        $data_edit->setField('$anobase_id');
        $anobase_data->setEditAction($data_edit);

        $action1 = new TDataGridAction(array('AnoBaseForm', 'onEdit'));
        $action1->setLabel(_t('Edit'));
        $action1->setImage('ico_edit.png');
        $action1->setField('bairros_id');
        
        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel(_t('Delete'));
        $action2->setImage('ico_delete.png');
        $action2->setField('bairros_id');

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
        
        parent::add($table);
    }
    
    function onInlineEdit($param){
        try{
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];

            TTransaction::open('liger');
            
            $object = new AnoBase($key);
            $object->{$field} = $value;
            $object->store();
            
            TTransaction::close();
            
            $this->onReload($param);
            new TMessage('info', "Alterado com Sucesso");
        }
        catch (Exception $e){
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            TTransaction::rollback();
        }
    }
    
    function onSearch(){

        $data = $this->form->getData();
        
        TSession::setValue('Anobase_id_filter',   NULL);
        TSession::setValue('Anobase_id', '');
        
        if ( $data->anobase_id ){
            $filter = new TFilter('anobase_id', 'like', "%{$data->anobase_id}%");
            
            TSession::setValue('Anobase_id_filter',   $filter);
            TSession::setValue('Anobase_id', $data->anobase_id);            
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
            
            $repository = new TRepository('AnoBase');
            $limit = 10;
            
            $criteria = new TCriteria;
            
            if (TSession::getValue('Anobase_id_filter')) {
                
                $criteria->add(TSession::getValue('Anobase_id_filter'));
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
        
        // shows a dialog to the user
        new TQuestion(TAdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    /**
     * method Delete()
     * Delete a record
     */
    function Delete($param)
    {
        try
        {
            // get the parameter $key
            $key=$param['key'];
            // open a transaction with database 'permission'
            TTransaction::open('liger');
            
            // instantiates object SystemProgram
            $object = new AnoBase ($key);
            
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
    
    /**
     * method show()
     * Shows the page
     */
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
