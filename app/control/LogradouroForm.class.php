<?php
/**
 * System_groupForm Registration
 * @author  <your name here>
 */
class LogradouroForm extends TPage
{
    protected $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the table container
        $table = new TTable;
        $table->style = 'width:100%';
        
        $frame_bairros = new TFrame;
        $frame_bairros->setLegend('Bairros');
        
        // creates the form
        $this->form = new TForm('form_Logradouro');
        $this->form->class = 'tform';
        
        
        // add the notebook inside the form
        $this->form->add($table);
        $table->addRowSet( new TLabel('Logradouro'), '' )->class = 'tformtitle';

        // create the form fields
        $logra_id           = new TEntry('logra_id');
        $logra_cep          = new TEntry('logra_cep');
        $logra_nome         = new TEntry('logra_nome');
        $multifield         = new TMultiField('bairros');
        $bairros_id         = new TDBSeekButton('bairros_id', 'liger', 'form_Logradouro', 'Bairro', 'bairros_nome', 'bairros_bairros_id', 'bairros_bairros_nome');
        $bairros_nome       = new TEntry('bairros_nome');
  
        
        $frame_bairros->add($multifield);    
        
        $multifield->setHeight(140);
        $multifield->setClass('Bairro');
        $multifield->addField('bairros_id','Bairro' . ' ID',  $bairros_id, 100, true);
        $multifield->addField('bairros_nome','Nome', $bairros_nome, 250);
        $multifield->setOrientation('horizontal');
        
        // define the sizes
        $bairros_id->setSize(70);
        $logra_id->setSize(100);
        $logra_nome->setSize(200);
        
        // outras propriedades
        $logra_id->setEditable(false);
        $bairros_nome->setEditable(false);

        // add a row for the field id
        $table->addRowSet(new TLabel('ID:'), $logra_id);
        $table->addRowSet(new TLabel(_t('Name') . ': '), $logra_nome);
        
        // add a row for the field name
        $row = $table->addRow();
        $cell = $row->addCell($frame_bairros);
        $cell->colspan = 2;

        // create an action button (save)
        $save_button=new TButton('save');
        $save_button->setAction(new TAction(array($this, 'onSave')), _t('Save'));
        $save_button->setImage('ico_save.png');
        
        // create an new button (edit with no parameters)
        $new_button=new TButton('new');
        $new_button->setAction(new TAction(array($this, 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        $list_button=new TButton('list');
        $list_button->setAction(new TAction(array('LogradouroList','onReload')), _t('Back to the listing'));
        $list_button->setImage('ico_datagrid.png');

        // define the form fields
        $this->form->setFields(array($logra_id,$logra_nome,$multifield,$save_button,$new_button,$list_button));
        
        $buttons = new THBox;
        $buttons->add($save_button);
        $buttons->add($new_button);
        $buttons->add($list_button);
        
        $container = new TTable;
        $container->width = '80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml', 'LogradouroList'));
        $container->addRow()->addCell($this->form);
        
        $row=$table->addRow();
        $row->class = 'tformaction';
        $cell = $row->addCell( $buttons );
        $cell->colspan = 2;

        // add the form to the page
        parent::add($container);
    }

    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        try
        {
            // open a transaction with database 'liger'
            TTransaction::open('liger');
            
            // get the form data into an active record System_group
            $object = $this->form->getData('Logradouro');
            
            if( $object->bairros )
            {
                foreach( $object->bairros as $bairro )
                {
                    $object->addBairro( $bairro );
                }
            }
            
            $this->form->validate(); // form validation
            $object->store(); // stores the object
            $this->form->setData($object); // fill the form with the active record data
            
            TTransaction::close(); // close the transaction
            new TMessage('info', _t('Record saved')); // shows the success message
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
     * method onEdit()
     * Executed whenever the user clicks at the edit button da datagrid
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                // get the parameter $key
                $key=$param['key'];
                
                // open a transaction with database 'liger'
                TTransaction::open('liger');
                
                // instantiates object System_group
                $object = new Logradouro($key);
                
                $object->bairros = $object->getBairros();
                
                // fill the form with the active record data
                $this->form->setData($object);
                
                // close the transaction
                TTransaction::close();
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
?>