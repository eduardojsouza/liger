<?php

class Estado extends TRecord {
    
    const TABLENAME     = 'tb_estados'; 
    const PRIMARYKEY    = 'uf_id';
    const IDPOLICY      = 'max';
    
    public function __construct($id = NULL){
        
        parent::__construct($id);
        
        parent::addAttribute('uf_id');
        parent::addAttribute('uf_nome');
        parent::addAttribute('uf_cod_ibge');
        parent::addAttribute('uf_sigla');
    }
}
