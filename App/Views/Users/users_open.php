<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tbody>
                <tr>
                    <th>Nome</th>
                    <td><?= $user->name; ?></td>
                </tr>
                <tr>
                    <th>Sobrenome</th>
                    <td><?= $user->lastname; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $user->email; ?></td>
                </tr>
                <tr>
                    <th>Nome de Usuário</th>
                    <td><?= $user->username; ?></td>
                </tr>
                <tr>
                    <th>Grupo</th>
                    <td><?= $user->group->name; ?></td>						
                </tr>
            </tbody>
        </table>

        <a href="<?= $this->base('users'); ?>" class="btn btn-default">Voltar</a>
    </div>
</div>
