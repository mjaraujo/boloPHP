<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventosController
 *
 * @author marcio
 */
class EdicaoController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Session');

    public function index() {
        $this->set('edicaos', $this->Edicao->find('all'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Edicao->create();
            if ($this->Edicao->save($this->request->data)) {
                $this->Flash->set('Os dados foram salvos');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set('Falha ao salvar');
            }
        }
    }

    public function edit($id = null){
        if(!$id){
            throw new NotFoundException('Edição inválida');
        }
        
        $edicao = $this->Edicao->findById($id);
        if(!$edicao){
            throw new NotFoundException('Edição inválida');
        }
        
        if($this->request->is(array('post','put'))){
            debug($edicao);
            $this->Edicao->id = $id;
            if($this->Edicao->save($this->request->data)){
                $this->Flash->set('Os dados da edição foram salvos');
                $this->redirect(array('action'=>'index'));
            }
            
            $this->Flash->set('Falha ao salvar!');
        }
        if(!$this->request->data){
            $this->request->data = $edicao;
        }
    }
}
