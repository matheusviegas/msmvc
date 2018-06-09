<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?= $this->base('roles/save'); ?>">
            <?php if (!empty($role)) : ?>
                <input type="hidden" name="id" value="<?= $role->id; ?>" />
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Name" name="role" required value="<?= (!empty($role) ? $role->role : ''); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Description" name="description" required value="<?= (!empty($role) ? $role->description : ''); ?>" />
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="salvar" value="Salvar Alterações" class="btn btn-primary" /> <a href="<?= $this->base('roles'); ?>" class="btn btn-default">Voltar</a>
                </div>
            </div>

        </form>
    </div>
</div>
