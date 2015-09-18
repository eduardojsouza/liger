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
        parent::addAttribute('logradouro');
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
    
    public function addProprietario(Contribuinte $object){
        $this->proprietarios[] = $object;
    }
    
    public function getProprietarios(){
        return $this->proprietarios;
    }
    
    public function clearParts(){
        $this->proprietarios = array();
    }
    
    public function load($id){

        $repository = new TRepository('ImovelProprietarios');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_imovel_imovel_id', '=', $id));
        $imovelproprietario = $repository->load($criteria);
        if ($imovelproprietario){
            foreach ($imovelproprietario as $imovelproprietarios){
                $proprietario = new Contribuinte( $imovelproprietarios->tb_contribuinte_contribuinte_id );
                $this->addProprietario($proprietario);
            }
        }
        
        return parent::load($id);
    }
        
    public function store(){
        
        parent::store();
    

        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_imovel_imovel_id', '=', $this->imovel_id));
        $repository = new TRepository('ImovelProprietarios');
        $repository->delete($criteria);

        if ($this->proprietarios){
            foreach ($this->proprietarios as $proprietario){
                $imovelproprietarios = new ImovelProprietarios;
                $imovelproprietarios->tb_contribuinte_contribuinte_id = $proprietario->proprietarios_id;
                $imovelproprietarios->tb_imovel_imovel_id = $this->imovel_id;
                $imovelproprietarios->store();
            }
        }
    }
    
    public function delete($id = NULL){
        $id = isset($id) ? $id : $this->imovel_id;
        $repository = new TRepository('ImovelProprietarios');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tb_imovel_imovel_id', '=', $id));
        $repository->delete($criteria);
        
        // delete the object itself
        parent::delete($id);
    }
}
