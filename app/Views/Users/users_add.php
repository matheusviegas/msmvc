<div class="row">
	<div class="col-md-6">
		<form method="POST" action="<?=$this->base('users/save');?>">
			<?php if(!empty($usuario)) : ?>
				<input type="hidden" name="id" value="<?=$usuario->id;?>" />
			<?php endif; ?>

			<div class="row">
				<div class="col-md-4">
					<input type="text" class="form-control" placeholder="Nome" name="nome" required value="<?=(!empty($usuario) ? $usuario->nome : '');?>" />
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" placeholder="Sobrenome" name="sobrenome" required value="<?=(!empty($usuario) ? $usuario->sobrenome : '');?>" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<input type="email" class="form-control" placeholder="Email" name="email" required value="<?=(!empty($usuario) ? $usuario->email : '');?>" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Nome de Usuário" name="usuario" required value="<?=(!empty($usuario) ? $usuario->usuario : '');?>" />
				</div>
				<div class="col-md-6">
					<select class="form-control" name="grupo">
						<option>Selecionar Grupo</option>
						<?php foreach($grupos as $grupo): ?>
							<option value="<?=$grupo->id;?>" <?=(!empty($usuario) && $usuario->grupo->id == $grupo->id ? 'selected' : '');?>><?=$grupo->nome;?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<input type="password" class="form-control" placeholder="Senha" name="senha" />
				</div>
				<div class="col-md-6">
					<input type="password" class="form-control" placeholder="Repita a Senha" name="confirmacao_senha" />
				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					<label class="btn btn-default" style="width: 100%;">
					    <i class="fa fa-camera" style="margin-right: 5px;"></i> Selecionar Foto <input type="file" style="display: none;">
					</label>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<input type="submit" name="salvar" value="Salvar Alterações" class="btn btn-primary" /> <a href="<?=$this->base('users');?>" class="btn btn-default">Voltar</a>
				</div>
			</div>
					
		</form>
	</div>
</div>
