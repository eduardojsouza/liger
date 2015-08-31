<?php
/**
 * SystemProgramList Listing
 * @author  <your name here>
 */
class BairroList extends TPage{
    private $form;     
    private $datagrid;
    private $pageNavigation;
    private $loaded;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct(){
        parent::__construct();
        
        // creates the form
        $this->form = new TForm('form_search_Bairro');
        $this->form->class = 'tform';
        
        // creates a table
        $table = new TTable;
        $table->style = 'width:100%';
        
        $table->addRowSet( new TLabel('Bairro'), '' )->class = 'tformtitle';

        // add the table inside the form
        $this->form->add($table);
        
        // create the form fields
        $bairros_id = new TEntry('bairros_id');
        $bairros_id->setValue(TSession::getValue('bairros_id'));
        
        $bairros_nome = new TEntry('bairros_nome');
        $bairros_nome->setValue(TSession::getValue('bairros_nome'));
        
        // add rows for the filter fields
        $row=$table->addRowSet(new TLabel('ID: '),$bairros_id);
        $row=$table->addRowSet(new TLabel('Bairro: '), $bairros_nome);

        // create two action buttons to the form
        $find_button = new TButton('find');
        $new_button  = new TButton('new');
        
        // define the button actions
        $find_button->setAction(new TAction(array($this, 'onSearch')), _t('Find'));
        $find_button->setImage('ico_find.png');
        
        $new_button->setAction(new TAction(array('BairroForm', 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        // define wich are the form fields
        $this->form->setFields(array($bairros_id, $bairros_nome, $find_button, $new_button));

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
        
        // creates the datagrid columns
        $bairros_id             = new TDataGridColumn('bairros_id', 'ID', 'right');
        $bairros_nome           = new TDataGridColumn('bairros_nome','Bairro', 'left');
        $tb_cidades_cid_id   = new TDataGridColumn('tb_cidades_cid_id','Cidade', 'left');
        $tb_cidades_cid_id   = new TDataGridColumn('nome_cidade','Cidade', 'left');
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($bairros_id);
        $this->datagrid->addColumn($bairros_nome);
        $this->datagrid->addColumn($tb_cidades_cid_id);

        //creates the datagrid column actions
        $order_id= new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'bairros_id');
        $bairros_id->setAction($order_id);

        $order_name= new TAction(array($this, 'onReload'));
        $order_name->setParameter('order', 'bairros_nome');
        $bairros_nome->setAction($order_name);

        $order_estado= new TAction(array($this, 'onReload'));
        $order_estado->setParameter('order', 'tb_cidades_cid_id');
        $tb_cidades_cid_id->setAction($order_estado);

        //inline editing
        $name_edit = new TDataGridAction(array($this, 'onInlineEdit'));
        $name_edit->setField('bairros_id');
        $bairros_nome->setEditAction($name_edit);

        // creates two datagrid actions
        $action1 = new TDataGridAction(array('BairroForm', 'onEdit'));
        $action1->setLabel(_t('Edit'));
        $action1->setImage('ico_edit.png');
        $action1->setField('bairros_id');
        
        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel(_t('Delete'));
        $action2->setImage('ico_delete.png');
        $action2->setField('bairros_id');
        
        // add the actions to the datagrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // creates the page structure using a table
        $table = new TTable;
        $table->style = 'width: 80%';
        $table->addRow()->addCell(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $table->addRow()->addCell($this->form);
        $table->addRow()->addCell($this->datagrid);
        $table->addRow()->addCell($this->pageNavigation);
        
        // add the table inside the page
        parent::add($table);
    }
    
    /**
     * method onInlineEdit()
     * Inline record editing
     * @param $param Array containing:
     *              key: object ID value
     *              field name: object attribute to be updated
     *              value: new attribute content 
     */
    function onInlineEdit($param)
    {
        try
        {
            // get the parameter $key
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];
            
            // open a transaction with database 'permission'
            TTransaction::open('liger');
            
            // instantiates object SystemProgram
            $object = new Bairro($key);
            // deletes the object from the database
            $object->{$field} = $value;
            $object->store();
            
            // close the transaction
            TTransaction::close();
            
            // reload the listing
            $this->onReload($param);
            // shows the success message
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
    
    /**
     * method onSearch()
     * Register the filter in the session when the user performs a search
     */
    function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        TSession::setValue('Bairro_id_filter',   NULL);
        TSession::setValue('Bairro_id', '');
        
        TSession::setValue('Bairro_nome_filter',   NULL);
        TSession::setValue('Bairro_nome', '');
        
        // check if the user has filled the form
        if ( $data->bairros_id )
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('bairros_id', 'like', "%{$data->bairros_id}%");
            
            // stores the filter in the session
            TSession::setValue('Bairro_id_filter',   $filter);
            TSession::setValue('Bairro_id', $data->bairros_id);            
        }
        
        if ( $data->bairros_nome )
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('bairros_nome', 'like', "%{$data->bairros_nome}%");
            
            // stores the filter in the session
            TSession::setValue('Bairro_nome_filter',   $filter);
            TSession::setValue('Bairro_nome', $data->bairros_nome);            
        }
        
        // fill the form with data again
        $this->form->setData($data);
        
        $param=array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * method onReload()
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'permission'
            TTransaction::open('liger');
            
            // creates a repository for SystemProgram
            $repository = new TRepository('Bairro');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            
            if (TSession::getValue('Bairro_id_filter'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('Bairro_id_filter'));
            }
            if (TSession::getValue('Bairro_nome_filter'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('Bairro_nome_filter'));
            }
            // load the objects according to criteria
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
    
    /**
     * method onDelete()
     * executed whenever the user clicks at the delete button
     * Ask if the user really wants to delete the record
     */
    function onDelete($param)
    {
        // define the delete action
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
            $object = new Bairro ($key);
            
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
?>
