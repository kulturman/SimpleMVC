<?php
namespace App\Controllers;

class UserController extends BaseController
{
    private $connection;

    public function __construct()
    {
        $this->connection = $this->getConnection();
    }

    /** @return mixed */
    public function index() {
        $users = $this->connection->query('SELECT * FROM user')->fetchAll();
        return $this->view('index', ['users' => $users]);
    }

    public function create() {
        return $this->view('create-user');
    }

    public function store() {
        $preparedStatement = $this->connection->prepare('INSERT INTO user VALUES(NULL, ?, ?, ?, ?)');
        $preparedStatement->execute([$_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age']]);
        setFlashMessage('success', 'User created successfully');
        redirect(makeUrl('user', 'index'));
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $preparedStatement = $this->connection->prepare('SELECT id FROM user WHERE id = ?');
        $preparedStatement->execute([$id]);

        if($preparedStatement->fetch() === false) {
            setFlashMessage('error', 'USer not found');
        }

        //We can safely concatenate here as we a converting to int;
        $result = $this->connection->exec('DELETE FROM user WHERE id = '. (int) $id);
        if ($result === 0) {
            setFlashMessage('error', 'Sorry we were not able to delete user');
        }
        else {
            setFlashMessage('success', 'User deleted succesfully');
        }
        redirect(makeUrl('user', 'index'));
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $preparedStatement = $this->connection->prepare('SELECT * FROM user WHERE id = ?');
        $preparedStatement->execute([$id]);
        $user = $preparedStatement->fetchObject();

        if($user === false) {
            setFlashMessage('error', 'USer not found');
        }

        return $this->view('edit-user', ['user' => $user]);
    }

    public function update() {
        $id = $_GET['id'] ?? 0;
        $preparedStatement = $this->connection->prepare('UPDATE user SET first_name = ?, last_name = ?, gender = ?, age = ? WHERE id = ?');
        $result = $preparedStatement->execute([$_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age'], $id]);
        if ($result === 0) {
            setFlashMessage('error', 'Sorry we were not able to update user');
        }
        else {
            setFlashMessage('success', 'User updated successfully');
        }
        redirect(makeUrl('user', 'index'));
    }
}