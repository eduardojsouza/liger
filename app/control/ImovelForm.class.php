<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImovelForm
 *
 * @author Eduardo
 */
class ImovelForm extends TPage{
    
    function __construct(){
        
        parent::__construct();
        
        $table = new TTable;
        $table->style = "width:100%";
        
        $frame_proprietarios = new TFrame;
        $frame_proprietarios->setLegend('Proprietarios');
        
        $this->form = new TForm('form_Imovel');
        $this->form->class = 'tform';
        
        $this->form->add($table);
        $table->addRowSet( new TLabel('Imóvel'), '' )->class = 'tformtitle';
        
        $imovel_id              = new TEntry('imovel_id');
        $logradouro             = new TEntry('logradouro');
        $numero                 = new TEntry('numero');
        $quadra                 = new TEntry('quadra');
        $lote                   = new TEntry('lote');
        $multifield1            = new TMultiField('proprietarios');
        $proprietarios_id       = new TDBSeekButton('proprietarios_id','liger','form_Imovel','Proprietarios','proprietarios_nome','proprietarios_proprietarios_id','proprietarios_proprietarios_nome');
        $proprietarios_nome     = new TEntry('proprietarios_nome');
        $inflogradouro          = new TEntry('inflogradouro');
        $tipopropriedade        = new TEntry('tipopropriedade');
        $situacaojuridica       = new TEntry('situacaojuridica');
        $localizacao            = new TEntry('localizacao');
        $ocupacao               = new TEntry('ocupacao');
        $numfrentes             = new TEntry('numfrentes');
        $utilizacao             = new TEntry('utilizacao');
        $tipo                   = new TEntry('tipo');
        $douso                  = new TEntry('douso');
        $agua                   = new TEntry('agua');
        $esgoto                 = new TEntry('esgoto');
        $piso                   = new TEntry('piso');
        $estrutura              = new TEntry('estrutura');
        $janelas                = new TEntry('janelas');
        $revestimentointerno    = new TEntry('revestimentointerno');
        $revestimentoexterno    = new TEntry('revestimentoexterno');
        $forro                  = new TEntry('forro');
        $instalacaoeletrica     = new TEntry('instalacaoeletrica');
        $instalacaosanitaria    = new TEntry('instalacaosanitaria');
        $cobertura              = new TEntry('cobertura');
        $conservacao            = new TEntry('conservacao');
        $areaterreno            = new TEntry('areaterreno');
        $testada                = new TEntry('testada');
        $areaedificada          = new TEntry('areaedificada');
        $areatotaledificada     = new TEntry('areatotaledificada');
        $imgimovel              = new TEntry('imgimovel');
        
        $frame_proprietarios->add($multifield1);
        
        $multifield1->setHeight(140);
        $multifield1->setClass('Proprietarios');
        $multifield1->addField('proprietarios_id','Proprietarios' . ' ID',  $proprietarios_id, 100, true);
        $multifield1->addField('proprietarios_nome','Nome', $proprietarios_nome, 250);
        $multifield1->setOrientation('horizontal'); 
        
        $imovel_id->setEditable(false);
        $proprietarios_nome->setEditable(false);
        
        $table->addRowSet(new TLabel('ID:'), $imovel_id);
        $table->addRowSet(new TLabel('Logradouro: '), $logradouro);
        $table->addRowSet(new TLabel('Informações Logradouro: '), $inflogradouro);
        
        $row = $table->addRow();
        $cell = $row->addCell($frame_proprietarios);
        $cell->colspan = 2;
        
        $save_button=new TButton('save');
        $save_button->setAction(new TAction(array($this, 'onSave')), _t('Save'));
        $save_button->setImage('ico_save.png');
        
        $new_button=new TButton('new');
        $new_button->setAction(new TAction(array($this, 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        $list_button=new TButton('list');
        $list_button->setAction(new TAction(array('LogradouroList','onReload')), _t('Back to the listing'));
        $list_button->setImage('ico_datagrid.png');

        $this->form->setFields(array($imovel_id,$logradouro,$multifield1,$inflogradouro,$tipopropriedade,$situacaojuridica,$save_button,$new_button,$list_button));
        
        $buttons = new THBox;
        $buttons->add($save_button);
        $buttons->add($new_button);
        $buttons->add($list_button);
        
        $container = new TTable;
        $container->width = '80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml', 'ImovelList'));
        $container->addRow()->addCell($this->form);
        
        $row=$table->addRow();
        $row->class = 'tformaction';
        $cell = $row->addCell( $buttons );
        $cell->colspan = 2;

        parent::add($container);
    }
    
    function onSave(){
        try{
            TTransaction::open('liger');
            
            $object = $this->form->getData('Imovel');
            
            if( $object->proprietarios ){
                foreach( $object->proprietarios as $proprietario ){
                    $object->addProprietario( $proprietario );
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
    
    function onEdit($param){
        try{
            if (isset($param['key'])){
                $key=$param['key'];
                
                TTransaction::open('liger');
                
                $object = new Imovel($key);
                
                $object->proprietarios = $object->getProprietarios();
                
                $this->form->setData($object);
                
                TTransaction::close();
            }else{
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
