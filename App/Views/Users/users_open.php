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

        <a href="<?= base('users', TRUE); ?>" class="btn btn-default"><?=$this->lang->get('btn_back', true);?></a>
    </div>
</div>
