

<table class="table">
    <thead>
    <tr style="background: #ebf1f5">
        <th scope="col"><a class="btn btn-primary" href="">Добавить</a></th>
        <th scope="col">e-mail</th>
        <th scope="col">Role</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($users as $user): ?>
        <tr>
            <th scope="row"></th>
            <td><?= $user['user_email']; ?></td>

            <td>
                <a class="btn btn-success" href="">
                    Редактировать
                </a>
                <button class="btn btn-danger"
                        onclick="remove()">
                    Удалить
                </button>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>;

