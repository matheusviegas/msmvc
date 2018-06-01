<div class="row">
	<div class="col-md-6">
		<form method="POST" action="<?=$this->base('groups/save');?>">
			<?php if(!empty($group)) : ?>
				<input type="hidden" name="id" value="<?=$group->id;?>" />
			<?php endif; ?>

			<div class="row">
				<div class="col-md-12">
					<input type="text" class="form-control" placeholder="Nome" name="name" required value="<?=(!empty($group) ? $group->name : '');?>" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					 <?php foreach($roles as $role): ?>
                      <div class="checkbox-custom checkbox-primary">
                        <input type="checkbox" id="role_<?=$role->id;?>" name="roles[]" value="<?=$role->id;?>"
                        <?php if(!empty($group)){
                              if(\App\Models\Group::find($group->id)->roles->contains($role->id)){
                                echo "checked";
                              }
                            }
                        ?>
                        />
                        <label for="role_<?=$role->id;?>"><?=$role->role;?></label>
                      </div>


                    <?php endforeach; ?>
				</div>
			</div>


			<div class="row">
				<div class="col-md-12">
					<input type="submit" name="salvar" value="Salvar Alterações" class="btn btn-primary" /> <a href="<?=$this->base('groups');?>" class="btn btn-default">Voltar</a>
				</div>
			</div>
					
		</form>
	</div>
</div>
