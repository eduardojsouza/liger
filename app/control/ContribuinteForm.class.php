<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContribuinteForm
 *
 * @author Eduardo
 */
class ContribuinteForm extends TStandardForm{
    
    protected $form;
    
    function __construct(){
        
        parent::__construct();
        
        $this->form = new TQuickForm('form_Contribuinte');
        $this->form->setFormTitle('Contribuinte');
        $this->form->class = 'tform';
        
        parent::setDatabase('liger');
        
        parent::setActiveRecord('Contribuinte');
        
        $contribuinte_id                    = new TEntry('contribuinte_id');
        $contribuinte_nome                  = new TEntry('contribuinte_nome');
        $contribuinte_tipo                  = new TCombo('contribuinte_tipo');
        $contribuinte_endereco              = new TEntry('contribuinte_endereco');
        $contribuinte_bairro                = new TEntry('contribuinte_bairro');
        $contribuinte_cidade                = new TEntry('contribuinte_cidade');
        $contribuinte_estado                = new TDBCombo('tb_estados_uf_id', 'liger', 'Estado', 'uf_id', 'uf_nome');
        $contribuinte_cep                   = new TEntry('contribuinte_cep');
        $contribuinte_telefone              = new TEntry('contribuinte_telefone');
        $contribuinte_cpf                   = new TEntry('contribuinte_cpf');
        $contribuinte_dtnascimento          = new TDate('contribuinte_dtnascimento');
        $contribuinte_rg                    = new TEntry('contribuinte_rg');
        $contribuinte_cnpj                  = new TEntry('contribuinte_cnpj');
        $contribuinte_inscricaoestadual     = new TEntry('contribuinte_inscricaoestadual');
        $contribuinte_inscricaomunicipal    = new TEntry('contribuinte_inscricaomunicipal');
        $contribuinte_regjuceg              = new TEntry('contribuinte_regjuceg');
        $contribuinte_ramo                  = new TEntry('contribuinte_ramo');
        $contribuinte_codatividade          = new TEntry('contribuinte_codatividade');
        $contribuinte_numempregados         = new TEntry('contribuinte_numempregados');
        $contribuinte_inicioatividades      = new TDate('contribuinte_inicioatividades');
        
        $tipo = array( 1 => "Físico", 2 => "Jurídico");
        
        $contribuinte_id->setEditable(false);
        $contribuinte_tipo->addItems($tipo);
        
        
        $this->form->addQuickField('ID',$contribuinte_id,100);
        $this->form->addQuickField('Nome/Razão Social',$contribuinte_nome,400);        
        $this->form->addQuickField('Tipo',$contribuinte_tipo,200);
        $this->form->addQuickField('Endereço',$contribuinte_endereco,400);
        $this->form->addQuickField('Bairro',$contribuinte_bairro,200);
        $this->form->addQuickField('Cidade',$contribuinte_cidade,200);
        $this->form->addQuickField('Estado',$contribuinte_estado,200);
        $this->form->addQuickField('CEP',$contribuinte_cep,200);
        $this->form->addQuickField('Telefone',$contribuinte_telefone,200);
        $this->form->addQuickField('CPF',$contribuinte_cpf,200);
        $this->form->addQuickField('Data de Nascimento',$contribuinte_dtnascimento,200);
        $this->form->addQuickField('RG',$contribuinte_rg,200);
        $this->form->addQuickField('CNPJ',$contribuinte_cnpj,200);
        $this->form->addQuickField('Inscrição Municipal',$contribuinte_inscricaomunicipal,200);
        $this->form->addQuickField('Inscrição Estadual',$contribuinte_inscricaoestadual,200);
        $this->form->addQuickField('Registro JUCEG',$contribuinte_regjuceg,200);
        $this->form->addQuickField('Ramo',$contribuinte_ramo,200);
        $this->form->addQuickField('Código de Atividade',$contribuinte_codatividade,200);
        $this->form->addQuickField('Nº de Empregados',$contribuinte_numempregados,200);
        $this->form->addQuickField('Início das Atividades',$contribuinte_inicioatividades,200);
        
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Back to the listing'),new TAction(array('ContribuinteList','onReload')),'ico_datagrid.png');
        
        $container = new TTable;
        $container->style = 'width: 80%';
        $container->addRow()->addCell(new TXMLBreadCrumb('menu.xml','ContribuinteList'));
        $container->addRow()->addCell($this->form);
        
        parent::add($container);
    }
}
