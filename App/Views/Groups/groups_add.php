<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?= base('groups/save', TRUE); ?>">
            <?php if (!empty($group)) : ?>
                <input type="hidden" name="id" value="<?= $group->id; ?>" />
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="<?=$this->lang->get('lbl_name', TRUE);?>" name="name" required value="<?= (!empty($group) ? $group->name : ''); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($roles as $role): ?>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="role_<?= $role->id; ?>" name="roles[]" value="<?= $role->id; ?>"
                            <?php
                            if (!empty($group)) {
                                if (\App\Models\Group::find($group->id)->roles->contains($role->id)) {
                                    echo "checked";
                                }
                            }
                            ?>
                                   />
                            <label for="role_<?= $role->id; ?>"><?= $role->role; ?></label>
                        </div>


<?php endforeach; ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="salvar" value="<?=$this->lang->get('btn_save', TRUE);?>" class="btn btn-primary" /> <a href="<?= base('groups', TRUE); ?>" class="btn btn-default"><?=$this->lang->get('btn_back', TRUE);?></a>
                </div>
            </div>

        </form>
    </div>
</div>
