<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?= base('users/save', TRUE); ?>" enctype="multipart/form-data">
            <?php if (!empty($user)) : ?>
                <input type="hidden" name="id" value="<?= $user->id; ?>" />
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="<?=$this->lang->get('lbl_name', TRUE);?>" name="name" required value="<?= (!empty($user) ? $user->name : ''); ?>" />
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="<?=$this->lang->get('lbl_lastname', TRUE);?>" name="lastname" required value="<?= (!empty($user) ? $user->lastname : ''); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="email" class="form-control" placeholder="<?=$this->lang->get('lbl_email', TRUE);?>" name="email" required value="<?= (!empty($user) ? $user->email : ''); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="<?=$this->lang->get('lbl_username', TRUE);?>" name="username" required value="<?= (!empty($user) ? $user->username : ''); ?>" />
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="group">
                        <option><?=$this->lang->get('lbl_select_group', TRUE);?></option>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group->id; ?>" <?= (!empty($user) && $user->group->id == $group->id ? 'selected' : ''); ?>><?= $group->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input type="password" class="form-control" placeholder="<?=$this->lang->get('lbl_password', TRUE);?>" name="password" />
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control" placeholder="<?=$this->lang->get('lbl_password_confirmation', TRUE);?>" name="password_confirmation" />
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="picture" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="salvar" value="<?=$this->lang->get('btn_save', true);?>" class="btn btn-primary" /> <a href="<?= base('users', TRUE); ?>" class="btn btn-default"><?=$this->lang->get('btn_back', true);?></a>
                </div>
            </div>

        </form>
    </div>
</div>
