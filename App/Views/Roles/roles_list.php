<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Role</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= $role->id; ?></td>
                <td><?= $role->role; ?></td>
                <td><?= $role->description; ?></td>
                <td>
                    <a href="<?= base('roles/edit/' . $role->id, TRUE); ?>" class="btn btn-default btn-xs"><i class="lnr lnr-pencil"></i></a>
                    <a href="<?= base('roles/delete/' . $role->id, TRUE); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja excluir este item?')"><i class="lnr lnr-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
