<?php

class Cidade extends TRecord {
    const TABLENAME     = 'tb_cidades'; 
    const PRIMARYKEY    = 'cid_id';
    const IDPOLICY      = 'max';
    
    private $estado;
    
    public function __construct($id = NULL){
        
        parent::__construct($id);
        
        parent::addAttribute('cid_id');
        parent::addAttribute('cid_nome');
        parent::addAttribute('tb_estados_uf_id');
    }
    
    public function get_uf_sigla(){
        if(empty($this->estado)){
            $this->estado = new Estado($this->tb_estados_uf_id);
        }
        return $this->estado->uf_sigla;
    }
  
}
