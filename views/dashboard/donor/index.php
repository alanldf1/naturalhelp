<h2 class="mt-3">Doador</h2>
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
		<?php
		echo($donors);
		foreach($donors as $donor) { ?>
			<tr>
				<td><?php echo $donor['id']; ?></td>
				<td><?php echo $donor['name']; ?></td>
				<td><?php echo $donor['email']; ?></td>
				<td><?php echo $donor['phone']; ?></td>
				<td><?php echo $donor['doc']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>



