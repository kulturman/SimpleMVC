<h1>Users list</h1>
<?php if (hasFlashData('success')) :?>
    <div class="alert alert-success">
        <?= getFlashMessage('success') ?>
    </div>
<?php endif; ?>

<?php if (hasFlashData('error')) :?>
    <div class="alert alert-danger">
        <?= getFlashMessage('error') ?>
    </div>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <tbody>
        <?php foreach ($users as $user) :?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['first_name'] . ' ' . $user['last_name']?></td>
                <td><?= $user['age'] ?></td>
                <td><?= $user['gender'] ?></td>
                <td>
                    <a href="<?= makeUrl('user', 'edit', ['id' => $user['id']]) ?>" class="btn btn-primary">Update</a>
                    <a href="<?= makeUrl('user', 'delete', ['id' => $user['id']]) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name and forename</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
<a href="?controler=user&action=create" class="btn btn-success">Add a user</a>
