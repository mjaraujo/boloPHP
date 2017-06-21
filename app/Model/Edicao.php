<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evento
 *
 * @author marcio
 */
class Edicao extends AppModel{
    
    public $validate = array(
        'edi_tema' => array(
            'rule' => 'notBlank'
        ),
        'edi_descricao' => array(
            'rule' => 'notBlank'
        ),
        'edi_inicio' => array(
            'rule' => 'notBlank'
        ),
        'edi_fim' => array(
            'rule' => 'notBlank'
        )
    );
}
