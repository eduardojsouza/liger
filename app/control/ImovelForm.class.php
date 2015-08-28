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
        $numero                 = new TEntry('numero');
        $quadra                 = new TEntry('quadra');
        $lote                   = new TEntry('lote');
        $multifield1            = new TMultiField('proprietarios');
        $proprietarios_id       = new TDBSeek('proprietarios_id','liger','form_Imovel','Proprietarios','proprietarios_nome','proprietarios_proprietarios_id','proprietarios_proprietarios_nome');
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
    }
}
