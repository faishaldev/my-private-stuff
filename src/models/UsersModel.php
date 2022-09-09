<?php

class UsersModel {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getUsers() {
    $this->db->query("SELECT users.* FROM users JOIN roles ON users.role_id = roles.id WHERE roles.name = 'User' ORDER BY created_at DESC");

    return $this->db->resultSet();
  }

  public function addUser($data) {
    $id = uniqid('user-');

    // get user role
    $query = "SELECT id FROM roles WHERE name = 'User'";

    $this->db->query($query);

    $roleId = $this->db->row();

    $createdAt = date('c');
    $updatedAt = $createdAt;

    $query = "INSERT INTO users (id, role_id, username, email, password, fullname, phonenumber, address, created_at, updated_at) VALUES (:id, :role_id, :username, :email, :password, :fullname, :phonenumber, :address, :created_at, :updated_at)";

    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('role_id', $roleId);
    $this->db->bind('username', $data['username']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('fullname', $data['fullname']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('created_at', $createdAt);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function activateUser($id) {
    $this->db->query('UPDATE users SET is_active = 1 WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deactivateUser($id) {
    $this->db->query('UPDATE users SET is_active = 0 WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getUserById($id) {
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function editUser($data) {
    $updatedAt = date('c');

    $query = "UPDATE users SET username = :username, fullname = :fullname, email = :email, phonenumber = :phonenumber, address = :address, password = :password, updated_at = :updated_at WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('fullname', $data['fullname']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('id', $data['id']);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteUser($id) {
    $this->db->query('UPDATE users SET is_deleted = 1 WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function recoveryUser($id) {
    $this->db->query('UPDATE users SET is_deleted = 0 WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function checkUserAvailability($username, $email) {
    $this->db->query('SELECT COUNT(*) FROM users WHERE username = :username OR email = :email');
    $this->db->bind('username', $username);
    $this->db->bind('email', $email);

    return $this->db->row();
  }

  public function loginUser($user, $password) {
    $this->db->query('SELECT * FROM users WHERE username = :user OR email = :user AND password = :password');
    $this->db->bind('user', $user);
    $this->db->bind('password', $password);

    return $this->db->resultSet();
  }
}
