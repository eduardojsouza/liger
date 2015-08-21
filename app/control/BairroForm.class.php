<?php

class BairroForm extends TStandardForm{
    protected $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
                
        // creates the form
        
        $this->form = new TQuickForm('form_Bairro');
        $this->form->setFormTitle('Bairro');
        $this->form->class = 'tform'; // CSS class
        
        // defines the database
        parent::setDatabase('liger');
        
        // defines the active record
        parent::setActiveRecord('Bairro');
        
        // create the form fields
        $bairros_id            = new TEntry('bairros_id');
        $bairros_nome          = new TEntry('bairros_nome');
        $tb_cidades_cid_id  = new TDBCombo('tb_cidades_cid_id', 'liger', 'Cidade', 'cid_id', 'cid_nome');
        
        $bairros_id->setEditable(false);

        // add the fields
        $this->form->addQuickField('ID', $bairros_id,  50);
        $this->form->addQuickField('Bairro: ', $bairros_nome,  200);
        $this->form->addQuickField('Cidade: ', $tb_cidades_cid_id,  200);

        // add form actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Back to the listing'),new TAction(array('BairroList','onReload')),'ico_datagrid.png');

        $container = new TTable;
        $container->style = 'width: 80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml','BairroList'));
        $container->addRow()->addCell($this->form);
        
        
        // add the form to the page
        parent::add($container);
    }
}

