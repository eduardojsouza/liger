<?php

    class AnoBase extends TRecord{
        
        const TABLENAME     = 'tb_anobase'; 
        const PRIMARYKEY    = 'anobase_id';
        const IDPOLICY      = 'max';
        
        public function __construct($id = null) {
            parent::__construct($id);
        
            parent::addAttribute('anobase_data');
            
        }
    }

?>
