<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?= base('users/save', TRUE); ?>" enctype="multipart/form-data">
            <?php if (!empty($user)) : ?>
                <input type="hidden" name="id" value="<?= $user->id; ?>" />
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Nome" name="name" required value="<?= (!empty($user) ? $user->name : ''); ?>" />
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Sobrenome" name="lastname" required value="<?= (!empty($user) ? $user->lastname : ''); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="email" class="form-control" placeholder="Email" name="email" required value="<?= (!empty($user) ? $user->email : ''); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nome de Usuário" name="username" required value="<?= (!empty($user) ? $user->username : ''); ?>" />
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="group">
                        <option>Selecionar Grupo</option>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group->id; ?>" <?= (!empty($user) && $user->group->id == $group->id ? 'selected' : ''); ?>><?= $group->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input type="password" class="form-control" placeholder="Senha" name="password" />
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control" placeholder="Repita a Senha" name="password_confirmation" />
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="picture" />
                    <!--<label class="btn btn-default" style="width: 100%;">
                        <i class="fa fa-camera" style="margin-right: 5px;"></i> Selecionar Foto <input type="file" name="picture" style="display: none;">
                    </label>-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="salvar" value="Salvar Alterações" class="btn btn-primary" /> <a href="<?= base('users', TRUE); ?>" class="btn btn-default">Voltar</a>
                </div>
            </div>

        </form>
    </div>
</div>
