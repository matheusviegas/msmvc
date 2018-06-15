<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->name; ?></td>
                <td><?= $user->lastname; ?></td>
                <td><?= $user->email; ?></td>
                <td>
                    <a href="<?= base('users/open/' . $user->id, TRUE); ?>" class="btn btn-primary btn-xs"><i class="lnr lnr-eye"></i></a>
                    <a href="<?= base('users/edit/' . $user->id, TRUE); ?>" class="btn btn-default btn-xs"><i class="lnr lnr-pencil"></i></a>
                    <a href="<?= base('users/delete/' . $user->id, TRUE); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja excluir este item?')"><i class="lnr lnr-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
