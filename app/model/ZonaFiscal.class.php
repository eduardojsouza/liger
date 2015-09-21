<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZonaFiscal
 *
 * @author eduardo
 */
class ZonaFiscal extends TRecord{
    
    const TABLENAME     = 'tb_zonafiscal'; 
    const PRIMARYKEY    = 'zona_id';
    const IDPOLICY      = 'max';
    
    public function __construct($id = null) {
            parent::__construct($id);
        
            parent::addAttribute('zona_tipo');
    }
}
