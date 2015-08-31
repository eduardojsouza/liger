<?php
/**
 * System_group_program Active Record
 * @author  <your-name-here>
 */
class LogradouroBairro extends TRecord{
    
    const TABLENAME = 'tb_logradouros_tb_bairros';
    const PRIMARYKEY= 'id_logra_bairro';
    const IDPOLICY =  'max'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL){
        
        parent::__construct($id);
        parent::addAttribute('tb_logradouros_logra_id');
        parent::addAttribute('tb_bairros_bairros_id');
    }
}
?>