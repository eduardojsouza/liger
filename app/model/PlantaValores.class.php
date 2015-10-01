<?php

    class PlantaValores extends TRecord{
     
        const TABLENAME     = 'tb_plantavalores'; 
        const PRIMARYKEY    = 'plantavalores_id';
        const IDPOLICY      = 'max';
        
        public function __construct($id = null) {
            parent::__construct($id);
        
            parent::addAttribute('anobase');
            parent::addAttribute('plantavalores_valorm2territorial');
            parent::addAttribute('plantavalores_valorm2predial');
            parent::addAttribute('plantavalores_aliquotaterritorial1');
            parent::addAttribute('plantavalores_aliquotaterritorial2');
            parent::addAttribute('plantavalores_aliquotaresidencial1');
            parent::addAttribute('plantavalores_aliquotaresidencial2');
            parent::addAttribute('plantavalores_aliquotanresidencial1');
            parent::addAttribute('plantavalores_aliquotanresidencial2');
            
        }
    }
?>

