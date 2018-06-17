<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tbody>
                <tr>
                    <th><?=$this->lang->get('lbl_name', TRUE);?></th>
                    <td><?= $group->name; ?></td>
                </tr>
                <tr>
                    <th><?=$this->lang->get('lbl_roles', TRUE);?></th>
                    <td>
                        <ul>
                            <?php foreach ($group->roles as $role): ?>
                                <li><?= '<b>' . $role->role . '</b> - ' . $role->description; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="<?= base('groups', TRUE); ?>" class="btn btn-default"><?=$this->lang->get('btn_back', TRUE);?></a>
    </div>
</div>
