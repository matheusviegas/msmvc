<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tbody>
                <tr>
                    <th>Nome</th>
                    <td><?= $group->name; ?></td>
                </tr>
                <tr>
                    <th>Roles</th>
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

        <a href="<?= base('groups', TRUE); ?>" class="btn btn-default">Voltar</a>
    </div>
</div>
