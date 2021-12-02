<h2 class="mt-3">Mensagens</h2>
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
			<th>Mensagem</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($mensagens as $mensagem) { ?>
			<tr>
				<td><?php echo $mensagem['id']; ?></td>
				<td><?php echo $mensagem['nome']; ?></td>
				<td><?php echo $mensagem['email']; ?></td>
				<td><?php echo $mensagem['telefone']; ?></td>
				<td><?php echo $mensagem['mensagem']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>