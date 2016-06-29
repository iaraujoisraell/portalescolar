<head>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <?php include 'application/views/includes.php'; ?>
    <title>Matriz | <?php echo $system_title; ?></title>
</head>
<?php
$count = 1;
$codigo_matriz = '';
foreach ($matriz as $row1):
    $codigo_matriz = $row1['matriz_id'];
    ?>
    <?php echo $row1['cur_tx_descricao']; ?> - <?php echo $row1['mat_tx_ano']; ?>/<?php echo $row1['mat_tx_semestre']; ?>
<?php endforeach; ?>
<?php foreach ($disciplina as $row): ?>
<?php endforeach; ?>
<span>Total <?php echo count($disciplina); ?> Disciplina(s)</span>




<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
    <thead>
        <tr>
            <th><div>ID</div></th>
<th><div><?php echo 'Cód.Disc.'; ?></div></th>
<th><div><?php echo 'Disciplina'; ?></div></th>
<th><div><?php echo 'C.H.'; ?></div></th>
<th><div><?php echo 'CR'; ?></div></th>
<th><div><?php echo 'Período'; ?></div></th>

</tr>
</thead>
<tbody>
    <?php
    $count = 1;
    foreach ($disciplina as $row):
        $periodo = $row['periodo'];

        if ($periodo == '1') {
            $periodo2 = 'I';
        } else if ($periodo == '2') {
            $periodo2 = 'II';
        } else if ($periodo == '3') {
            $periodo2 = 'III';
        } else if ($periodo == '4') {
            $periodo2 = 'IV';
        } else if ($periodo == '5') {
            $periodo2 = 'V';
        } else if ($periodo == '6') {
            $periodo2 = 'VI';
        } else if ($periodo == '7') {
            $periodo2 = 'VII';
        } else if ($periodo == '8') {
            $periodo2 = 'VIII';
        }
        ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td ><?php echo $row['disc_tx_abrev']; ?></td>
            <td><?php echo $row['disc_tx_descricao']; ?></td>
            <td><?php echo $row['carga_horaria']; ?></td>
            <td><?php echo $row['credito']; ?></td>
            <td><?php echo $periodo2; ?></td>

        </tr>
    <?php endforeach; ?>
</tbody>
</table>


