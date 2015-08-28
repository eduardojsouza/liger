<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contribuinte
 *
 * @author Eduardo
 */
class Contribuinte extends TRecord {
    
    const TABLENAME     = 'tb_contribuinte'; 
    const PRIMARYKEY    = 'contribuinte_id';
    const IDPOLICY      = 'max';
    
    public function __construct($id = NULL){
        
        parent::__construct($id);    
        
        parent::addAttribute('contribuinte_id');
        parent::addAttribute('contribuinte_nome');
        parent::addAttribute('contribuinte_tipo');
        parent::addAttribute('contribuinte_endereco');
        parent::addAttribute('contribuinte_bairro');
        parent::addAttribute('contribuinte_cidade');
        parent::addAttribute('contribuinte_estado');
        parent::addAttribute('contribuinte_cep');
        parent::addAttribute('contribuinte_telefone');
        parent::addAttribute('contribuinte_cpf');
        parent::addAttribute('contribuinte_dtnascimento');
        parent::addAttribute('contribuinte_rg');
        parent::addAttribute('contribuinte_cnpj');
        parent::addAttribute('contribuinte_inscricaoestadual');
        parent::addAttribute('contribuinte_inscricaomunicipal');
        parent::addAttribute('contribuinte_regjuceg');
        parent::addAttribute('contribuinte_ramo');
        parent::addAttribute('contribuinte_codatividade');
        parent::addAttribute('contribuinte_numempregados');
        parent::addAttribute('contribuinte_inicioatividades');
    }
    
    public function get_contribuinte_tipos(){
        
        $tipos = array( 1 => "Físico", 2 => "Jurídico" );
        return $tipos[$this->contribuinte_tipo];
    }
}
