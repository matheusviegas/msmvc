<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($groups as $group): ?>
            <tr>
                <td><?= $group->id; ?></td>
                <td><?= $group->name; ?></td>
                <td>
                    <a href="<?= base('groups/open/' . $group->id, TRUE); ?>" class="btn btn-primary btn-xs"><i class="lnr lnr-eye"></i></a>
                    <a href="<?= base('groups/edit/' . $group->id, TRUE); ?>" class="btn btn-default btn-xs"><i class="lnr lnr-pencil"></i></a>
                    <a href="<?= base('groups/delete/' . $group->id, TRUE); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja excluir este item?')"><i class="lnr lnr-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
