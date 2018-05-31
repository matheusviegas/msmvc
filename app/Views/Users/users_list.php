<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>Sobrenome</th>
			<th>Email</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
								
		<?php foreach($usuarios as $usuario): ?>
			<tr>
				<td><?=$usuario->id;?></td>
				<td><?=$usuario->nome;?></td>
				<td><?=$usuario->sobrenome;?></td>
				<td><?=$usuario->email;?></td>
				<td>
					

					<a href="<?=$this->base('users/view/' . $usuario->id); ?>" class="btn btn-primary btn-xs"><i class="lnr lnr-eye"></i></a>

					<a href="<?=$this->base('users/edit/' . $usuario->id); ?>" class="btn btn-default btn-xs"><i class="lnr lnr-pencil"></i></a>

					<a href="<?=$this->base('users/delete/' . $usuario->id); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja excluir este item?')"><i class="lnr lnr-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>
