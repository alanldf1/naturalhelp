<h2 class="mt-3">Recebedor</h2>
<style type="text/css">
	h2{
		text-align: center;
	}
</style>

<table class="table table-striped mt5">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Telefone</th>
			<th>CPF</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($usuarios as $usuario) { ?>
			<tr>
				<td><?php echo $usuario['id']; ?></td>
				<td><?php echo $usuario['nome']; ?></td>
				<td><?php echo $usuario['email']; ?></td>
				<td><?php echo $usuario['telefone']; ?></td>
				<td><?php echo $usuario['doc']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>