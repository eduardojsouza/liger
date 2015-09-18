<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImovelForm
 *
 * @author Eduardo
 */
class ImovelForm extends TPage{
    
    function __construct(){
        
        parent::__construct();
        
        $table = new TTable;
        $table->style = "width:100%";
        
        $frame_proprietarios = new TFrame;
        $frame_proprietarios->setLegend('Proprietarios');
        
        $frame_inf = new TFrame;
        $frame_inf->setLegend('Informações do Logradouro');
        
        $this->form = new TForm('form_Imovel');
        $this->form->class = 'tform';
        
        $this->form->add($table);
        $table->addRowSet( new TLabel('Imóvel'), '', '','' )->class = 'tformtitle';
        
        $imovel_id              = new TEntry('imovel_id');
        $logradouro             = new TEntry('logradouro');
        $numero                 = new TEntry('numero');
        $quadra                 = new TEntry('quadra');
        $lote                   = new TEntry('lote');
        $multifield1            = new TMultiField('proprietarios');
        $proprietarios_id       = new TDBSeekButton('proprietarios_id','liger','form_Imovel','Contribuinte','contribuinte_nome','proprietarios_proprietarios_id','proprietarios_contribuinte_nome');
        $contribuinte_nome     = new TEntry('contribuinte_nome');
        
        $inflogradouro          = new TCheckGroup('inflogradouro');
        $inflogradouro->addItems(array('1' => 'Pavimentação   ', '2' => 'Meio Fio   ', '3' => 'Galerias Pluviais   ', '4' => 'Arborização   ', '5' => 'Rede Elétrica   '
            , '6' => 'Inluminação Pública   ', '7' => 'Rede D\'Água   ', '8' => 'Rede de Esgoto   ', '9' => 'Coleta de Lixo   '));
        $inflogradouro->setLayout('horizontal');
        
        $tipopropriedade        = new TCombo('tipopropriedade');
        $tipopropriedade->addItems(array('1' => 'Particular','2' => 'Municipal','3' => 'Estadual','4' => 'Federal','5' => 'Religiosa'));
        
        $situacaojuridica        = new TCombo('situacaojuridica');
        $situacaojuridica->addItems(array('1' => 'Plena','2' => 'Poseiro','3' => 'Aforamento','4' => 'Litigiosa'));
        
        $localizacao        = new TCombo('localizacao');
        $localizacao->addItems(array('1' => 'Esquina','2' => 'Encravado','3' => 'Meio de Quadra','4' => 'Toda Quadra', '5' => 'Gleba'));
        
        $ocupacao        = new TCombo('ocupacao');
        $ocupacao->addItems(array('1' => 'Vago','2' => 'Edificado','3' => 'Edificação Temporaria','4' => 'Edificação em Construção', '5' => 'Construção Paralizada',
            '6' => 'Edificação em Demolição', '7' => 'Edificação em Ruinas', '8' => 'Praça'));
        
        $numfrentes             = new TEntry('numfrentes');
        
        $utilizacao        = new TCombo('utilizacao');
        $utilizacao->addItems(array('1' => 'Própria','2' => 'Alugada','3' => 'Cedida','4' => 'Desocupada', '5' => 'Fechada'));

        $tipo        = new TCombo('tipo');
        $tipo->addItems(array('1' => 'Casa','2' => 'Apartamento','3' => 'Sala','4' => 'Loja', '5' => 'Galpão'));
        
        $douso        = new TCombo('douso');
        $douso->addItems(array('1' => 'Residencial','2' => 'Comercial','3' => 'Industrial','4' => 'Religioso', '5' => 'Administração Pública',
            '6' => 'Serviços'));
        
        $agua        = new TCombo('agua');
        $agua->addItems(array('1' => 'Sem','2' => 'Cisterna','3' => 'Com Pena DÁgua','4' => 'Hidrometro'));
        
        $esgoto        = new TCombo('esgoto');
        $esgoto->addItems(array('1' => 'Sem','2' => 'Fossa Negra','3' => 'Fossa Septica','4' => 'Rede Pública'));
      
        $areaterreno            = new TEntry('areaterreno');
        $testada                = new TEntry('testada');
        $areaedificada          = new TEntry('areaedificada');
        $areatotaledificada     = new TEntry('areatotaledificada');
        $imgimovel              = new TEntry('imgimovel');
        
        $frame_proprietarios->add($multifield1);
        
        $multifield1->setHeight(140);
        $multifield1->setClass('Proprietarios');
        $multifield1->addField('proprietarios_id','Contribuinte' . ' ID',  $proprietarios_id, 100, true);
        $multifield1->addField('contribuinte_nome','Nome', $contribuinte_nome, 250);
        $multifield1->setOrientation('horizontal'); 
        
        $imovel_id->setEditable(false);
        $contribuinte_nome->setEditable(false);
        $imovel_id->setSize(100);
        $logradouro->setSize(250);
        $quadra->setSize(100);
        $lote->setSize(100);
        $numero->setSize(100);
        $numfrentes->setSize(100);
        
        $table->addRowSet(new TLabel('ID:'), $imovel_id, new TLabel('Logradouro: '), $logradouro);
        $table->addRowSet(new TLabel('Quadra: '), $quadra, new TLabel('Lote: '), $lote);
        $table->addRowSet(new TLabel('Número: '), $numero, new TLabel('Nº de Frentes: '), $numfrentes);
        $table->addRowSet(new TLabel('Propriedade: '), $tipopropriedade, new TLabel('Situação Juridica: '), $situacaojuridica);
        $table->addRowSet(new TLabel('Localização: '), $localizacao, new TLabel('Ocupação: '), $ocupacao);
        $table->addRowSet(new TLabel('Utilização: '), $utilizacao, new TLabel('Tipo: '), $tipo);
        $table->addRowSet(new TLabel('Do Uso: '), $douso, new TLabel('Água: '), $agua);
        $table->addRowSet(new TLabel('Esgoto: '), $esgoto);

        $table->addRowSet(new TLabel('Área do Terreno: '), $areaterreno);
        $table->addRowSet(new TLabel('Testada: '), $testada);
        $table->addRowSet(new TLabel('Área Edificada: '), $areaedificada);
        $table->addRowSet(new TLabel('Área Total Edificada: '), $areatotaledificada);
        $table->addRowSet(new TLabel('Imagem do Imóvel: '), $imgimovel);
        
        $frame_inf->add($inflogradouro);
        $row1 = $table->addRow();
        $cell = $row1->addCell($frame_inf);
        $cell->colspan = 4;
        
        $row = $table->addRow();
        $cell = $row->addCell($frame_proprietarios);
        $cell->colspan = 4;
        
        $save_button=new TButton('save');
        $save_button->setAction(new TAction(array($this, 'onSave')), _t('Save'));
        $save_button->setImage('ico_save.png');
        
        $new_button=new TButton('new');
        $new_button->setAction(new TAction(array($this, 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        $list_button=new TButton('list');
        $list_button->setAction(new TAction(array('ImovelList','onReload')), _t('Back to the listing'));
        $list_button->setImage('ico_datagrid.png');

        $this->form->setFields(array($imovel_id,$logradouro,$multifield1,$inflogradouro,$tipopropriedade,$situacaojuridica,
            $localizacao, $ocupacao, $numero, $quadra, $lote, $numfrentes,$utilizacao,$tipo,$douso,$agua,$esgoto,$areaterreno,$testada,$areaedificada,
            $areatotaledificada,$imgimovel,$save_button,$new_button,$list_button));
        
        $buttons = new THBox;
        $buttons->add($save_button);
        $buttons->add($new_button);
        $buttons->add($list_button);
        
        $container = new TTable;
        $container->width = '80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml', 'ImovelList'));
        $container->addRow()->addCell($this->form);
        
        $row=$table->addRow();
        $row->class = 'tformaction';
        $cell = $row->addCell( $buttons );
        $cell->colspan = 2;

        parent::add($container);
    }
    
    function onSave(){
        try{
            TTransaction::open('liger');
            
            $object = $this->form->getData('Imovel');
            
            if( $object->proprietarios ){
                foreach( $object->proprietarios as $proprietario ){
                    $object->addProprietario( $proprietario );
                }
            }
            
            $this->form->validate(); // form validation
            $object->store(); // stores the object
            $this->form->setData($object); // fill the form with the active record data
            
            TTransaction::close(); // close the transaction
            new TMessage('info', _t('Record saved')); // shows the success message
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }    
    
    function onEdit($param){
        try{
            if (isset($param['key'])){
                
                $key=$param['key'];
                
                TTransaction::open('liger');
                
                $object = new Imovel($key);
                
                $object->proprietarios = $object->getProprietarios();
                
                $this->form->setData($object);
                
                TTransaction::close();
            }else{
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
