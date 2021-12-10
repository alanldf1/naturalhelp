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
		<?php foreach($cases as $case) { ?>
			<tr>
				<td><?php echo $case['id']; ?></td>
				<td><?php echo $case['name']; ?></td>
				<td><?php echo $case['email']; ?></td>
				<td><?php echo $case['phone']; ?></td>
				<td><?php echo $case['doc']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>