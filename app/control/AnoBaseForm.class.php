<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnoBaseForm
 *
 * @author eduardo
 */
class AnoBaseForm extends TStandardForm{
    
    protected $form;
    
    function __construct(){
        
    
        parent::__construct();
        
        $this->form = new TQuickForm('form_AnoBase');
        $this->form->setFormTitle('Ano Base');
        $this->form->class = 'tform';
        
        parent::setDatabase('liger');
        
        parent::setActiveRecord('AnoBase');
        
        // create the form fields
        $anobase_id            = new TEntry('anobase_id');
        $anobase_data          = new TEntry('anobase_data');
        
        $anobase_data->setMask('9999');
        $anobase_id->setEditable(false);
        
        $this->form->addQuickField('ID: ', $anobase_id,  50);
        $this->form->addQuickField('Ano Base: ', $anobase_data,  100);
        
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Back to the listing'),new TAction(array('AnoBaseList','onReload')),'ico_datagrid.png');

        $container = new TTable;
        $container->style = 'width: 80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml','AnoBaseList'));
        $container->addRow()->addCell($this->form);
        
        parent::add($container);
    }
    
}
