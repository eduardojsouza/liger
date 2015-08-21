<?php

class Logradouro extends TRecord {
    
    const TABLENAME     = 'tb_logradouros'; 
    const PRIMARYKEY    = 'logra_id';
    const IDPOLICY      = 'max';
    
    private $bairros = array();
    
    public function __construct($id = NULL){
        
        parent::__construct($id);
        
        parent::addAttribute('logra_cep');
        parent::addAttribute('logra_nome');
        parent::addAttribute('tb_bairros_bairros_id');
    }
    
    public function addBairro(Bairro $object){
        $this->bairros[] = $object;
    }
    
    public function getBairros(){
        return $this->bairros;
    }
    
    public function clearParts(){
        $this->bairros = array();
    }
    
    public function load($id){

        $repository = new TRepository('LogradouroBairro');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_logradouros_logra_id', '=', $id));
        $logradourobairro = $repository->load($criteria);
        if ($logradourobairro){
            foreach ($logradourobairro as $logradourobairros){
                $bairro = new Bairro( $logradourobairros->tb_bairros_bairros_id );
                $this->addBairro($bairro);
            }
        }
    
        // load the object itself
        return parent::load($id);
    }
    
    public function store(){
        // store the object itself
        parent::store();
    

        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_logradouros_logra_id', '=', $this->id));
        $repository = new TRepository('LogradouroBairro');
        $repository->delete($criteria);

        if ($this->bairros){
            foreach ($this->bairros as $bairro){
                $logradourobairros = new LogradouroBairro;
                $logradourobairros->tb_bairros_bairros_id = $bairro->bairros_id;
                $logradourobairros->tb_logradouros_logra_id = $this->logra_id;
                $logradourobairros->store();
            }
        }
    }
    
    public function delete($id = NULL){
        $id = isset($id) ? $id : $this->logra_id;
        $repository = new TRepository('LogradouroBairro');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_logradouros_logra_id', '=', $id));
        $repository->delete($criteria);
        
        // delete the object itself
        parent::delete($id);
    }
}
