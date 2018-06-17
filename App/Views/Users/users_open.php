<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tbody>
                <tr>
                    <th><?=$this->lang->get('lbl_name', TRUE);?></th>
                    <td><?= $user->name; ?></td>
                </tr>
                <tr>
                    <th><?=$this->lang->get('lbl_lastname', TRUE);?></th>
                    <td><?= $user->lastname; ?></td>
                </tr>
                <tr>
                    <th><?=$this->lang->get('lbl_email', TRUE);?></th>
                    <td><?= $user->email; ?></td>
                </tr>
                <tr>
                    <th><?=$this->lang->get('lbl_username', TRUE);?></th>
                    <td><?= $user->username; ?></td>
                </tr>
                <tr>
                    <th><?=$this->lang->get('lbl_group', TRUE);?></th>
                    <td><?= $user->group->name; ?></td>						
                </tr>
            </tbody>
        </table>

        <a href="<?= base('users', TRUE); ?>" class="btn btn-default"><?=$this->lang->get('btn_back', true);?></a>
    </div>
</div>
