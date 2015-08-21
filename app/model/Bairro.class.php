<?php

class Bairro extends TRecord{
    
    const TABLENAME     = 'tb_bairros'; 
    const PRIMARYKEY    = 'bairros_id';
    const IDPOLICY      = 'max';
    
    public function __construct($id = null) {
        parent::__construct($id);
        
        parent::addAttribute('bairros_nome');
        parent::addAttribute('tb_cidades_cid_id');
    }
}
