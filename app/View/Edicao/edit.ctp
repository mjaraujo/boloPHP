<h1>
    Editar edição
</h1>
    


<?php
echo $this->Form->create('Edicao');

echo $this->Form->input('edi_tema');
echo $this->Form->input('edi_descricao');
echo $this->Form->input('edi_inicio');
echo $this->Form->input('edi_fim');

echo $this->Form->input('edi_Id', array('type'=>'hidden'));

echo $this->Form->end('Salvar edição');
echo $this->Html->link('Cancelar', array('action' => 'index'));
