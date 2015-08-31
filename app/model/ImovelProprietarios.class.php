<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ImovelProprietarios
 *
 * @author Eduardo
 */
class ImovelProprietarios extends TRecord {
    
    const TABLENAME = 'tb_imovelproprietarios';
    const PRIMARYKEY= 'id_imovel_proprietarios';
    const IDPOLICY =  'max'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL){
        
        parent::__construct($id);
        parent::addAttribute('tb_imovel_imovel_id');
        parent::addAttribute('tb_contribuinte_contribuinte_id');
    }
}
