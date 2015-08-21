<?php
/**
 * SystemProgramForm Registration
 * @author  <your name here>
 */
class CidadeForm extends TStandardForm{
    protected $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct(){
        parent::__construct();
                
        // creates the form
        
        $this->form = new TQuickForm('form_Cidade');
        $this->form->setFormTitle('Cidade');
        $this->form->class = 'tform'; // CSS class
        
        // defines the database
        parent::setDatabase('liger');
        
        // defines the active record
        parent::setActiveRecord('Cidade');
        
        // create the form fields
        $cid_id            = new TEntry('cid_id');
        $cid_nome          = new TEntry('cid_nome');
        $tb_estados_uf_id  = new TDBCombo('tb_estados_uf_id', 'liger', 'Estado', 'uf_id', 'uf_nome');
        
        $cid_id->setEditable(false);

        // add the fields
        $this->form->addQuickField('ID', $cid_id,  50);
        $this->form->addQuickField('Cidade: ', $cid_nome,  200);
        $this->form->addQuickField('Estado: ', $tb_estados_uf_id,  200);

        // add form actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Back to the listing'),new TAction(array('CidadeList','onReload')),'ico_datagrid.png');

        $container = new TTable;
        $container->style = 'width: 80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml','CidadeList'));
        $container->addRow()->addCell($this->form);
        
        
        // add the form to the page
        parent::add($container);
    }
}
?>