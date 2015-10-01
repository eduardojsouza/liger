<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlantaValores
 *
 * @author Eduardo
 */
class PlantaValoresForm extends TStandardForm{
    
    protected $form;
    
    function __construct(){
        
    
        parent::__construct();
        
        $this->form = new TQuickForm('form_PlantaValores');
        $this->form->setFormTitle('Planta de Valores');
        $this->form->class = 'tform';
        
        parent::setDatabase('liger');
        
        parent::setActiveRecord('PlantaValores');
        
        // create the form fields
        $plantavalores_id                           = new TEntry('plantavalores_id');
        $anobase                                    = new TDBCombo('anobase','liger','AnoBase','anobase_id','anobase_data');
        $plantavalores_valorm2territorial           = new TEntry('plantavalores_valorm2territorial');
        $plantavalores_valorm2predial               = new TEntry('plantavalores_valorm2predial');
        $plantavalores_aliquotaterritorial1         = new TEntry('plantavalores_aliquotaterritorial1');
        $plantavalores_aliquotaterritorial2         = new TEntry('plantavalores_aliquotaterritorial2');
        $plantavalores_aliquotaresidencial1         = new TEntry('plantavalores_aliquotaresidencial1');
        $plantavalores_aliquotaresidencial2         = new TEntry('plantavalores_aliquotaresidencial2');
        $plantavalores_aliquotanresidencial1        = new TEntry('plantavalores_aliquotanresidencial1');
        $plantavalores_aliquotanresidencial2        = new TEntry('plantavalores_aliquotanresidencial2');
        
        $plantavalores_id->setEditable(false);
        
        $this->form->addQuickField('ID: ', $plantavalores_id,  50);
        $this->form->addQuickField('Ano Base: ', $anobase,  100);
        $this->form->addQuickField('Valor M² Territorial: ', $plantavalores_valorm2territorial,  100);
        $this->form->addQuickField('Valor M² Predial: ', $plantavalores_valorm2predial,  100);
        $this->form->addQuickField('Aliquota Territorial 1: ', $plantavalores_aliquotaterritorial1,  100);
        $this->form->addQuickField('Aliquota Territorial 2: ', $plantavalores_aliquotaterritorial2,  100);
        $this->form->addQuickField('Aliquota Residencial 1: ', $plantavalores_aliquotaresidencial1,  100);
        $this->form->addQuickField('Aliquota Residencial 2: ', $plantavalores_aliquotaresidencial2,  100);
        $this->form->addQuickField('Aliquota Não Residencial 1: ', $plantavalores_aliquotanresidencial1,  100);
        $this->form->addQuickField('Aliquota Não Residencial 2: ', $plantavalores_aliquotanresidencial2,  100);
        
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Back to the listing'),new TAction(array('PlantaValoresList','onReload')),'ico_datagrid.png');

        $container = new TTable;
        $container->style = 'width: 80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml','PlantaValoresList'));
        $container->addRow()->addCell($this->form);
        
        parent::add($container);
    }
}
