<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tbody>
				<tr>
					<th>Nome</th>
					<td><?=$usuario->nome;?></td>
				</tr>
				<tr>
					<th>Sobrenome</th>
					<td><?=$usuario->sobrenome;?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?=$usuario->email;?></td>
				</tr>
				<tr>
					<th>Usuário</th>
					<td><?=$usuario->usuario;?></td>
				</tr>
				<tr>
					<th>Grupo</th>
					<td><?=$usuario->grupo->nome; ?></td>						
				</tr>
			</tbody>
		</table>

		<a href="<?=$this->base('users');?>" class="btn btn-default">Voltar</a>
	</div>
</div>
