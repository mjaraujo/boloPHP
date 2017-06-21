<h1>Edições cadastradas</h1>

<table>
    <tr>
        <th>TEMA</th>
        <th>Descrição</th>
        <th>Início</th>
        <th>Fim</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($edicaos as $edicao): ?>
        <tr>
            <td><?php echo $edicao['Edicao']['edi_tema']; ?>
            <td><?php echo $edicao['Edicao']['edi_descricao']; ?>
            <td><?php echo $edicao['Edicao']['edi_inicio']; ?>
            <td><?php echo $edicao['Edicao']['edi_fim']; ?>
            <td>
                <?php echo $this->Html->link('Editar', array('action' => 'edit', $edicao['Edicao']['id'])) ?>
                <?php echo $this->Html->link('Apagar', array('action' => 'delete', $edicao['Edicao']['id'])) ?>
            </td>
        </tr>

        <?php
    endforeach;
    ?>
</table>

<?php
//debug($edicaos);   
echo $this->Html->link('Adicionar edição', array('action' => 'add'));
