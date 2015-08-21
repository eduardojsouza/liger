<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Imovel
 *
 * @author Eduardo
 */
class Imovel extends TRecord {
    
    const TABLENAME     = 'tb_imovel'; 
    const PRIMARYKEY    = 'imovel_id';
    const IDPOLICY      = 'max';
    
    public function __construct($id = NULL){
        
        parent::__construct($id);
        
        parent::addAttribute('imovel_id');
        parent::addAttribute('numero');
        parent::addAttribute('quadra');
        parent::addAttribute('lote');
        parent::addAttribute('proprietarios');
        parent::addAttribute('inflogradouro');
        parent::addAttribute('tipopropriedade');
        parent::addAttribute('situacaojuridica');
        parent::addAttribute('localizacao');
        parent::addAttribute('caracteristica');
        parent::addAttribute('ocupacao');
        parent::addAttribute('numfrentes');
        parent::addAttribute('utilizacao');
        parent::addAttribute('tipo');
        parent::addAttribute('douso');
        parent::addAttribute('agua');
        parent::addAttribute('esgoto');
        parent::addAttribute('piso');
        parent::addAttribute('estrutura');
        parent::addAttribute('janelas');
        parent::addAttribute('revestimentointerno');
        parent::addAttribute('revestimentoexterno');
        parent::addAttribute('forro');
        parent::addAttribute('instalacaoeletrica');
        parent::addAttribute('instalacaosanitaria');
        parent::addAttribute('cobertura');
        parent::addAttribute('conservacao');
        parent::addAttribute('areaterreno');
        parent::addAttribute('testada');
        parent::addAttribute('areaedificada');
        parent::addAttribute('areatotaledificada');
        parent::addAttribute('imgimovel');
    }
}
