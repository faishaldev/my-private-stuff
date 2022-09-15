<?php

class UsersModel {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getUsers() {
    $this->db->query("SELECT users.* FROM users JOIN roles ON users.role_id = roles.id ORDER BY created_at DESC");

    return $this->db->resultSet();
  }

  public function addUser($data) {
    $id = uniqid('user-');
    $roleId = $this->getUserRoleId();
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

  public function getUserRoleId() {
    $this->db->query("SELECT id FROM roles WHERE name = 'User'");

    return $this->db->row();
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

  public function getUserIdByUsername($username) {
    $this->db->query('SELECT id FROM users WHERE username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function updateUser($data) {
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

  public function removeUser($id) {
    $this->db->query('DELETE FROM users WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function recoverUser($id) {
    $this->db->query('UPDATE users SET is_deleted = 0 WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getUserAmountByUsernameOrEmail($username, $email) {
    $this->db->query('SELECT COUNT(*) FROM users WHERE username = :username OR email = :email');
    $this->db->bind('username', $username);
    $this->db->bind('email', $email);

    return $this->db->row();
  }

  public function getUserAmountByUsername($username) {
    $this->db->query('SELECT COUNT(*) FROM users WHERE username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function getPasswordByUsernameOrEmail($user) {
    $this->db->query('SELECT password FROM users WHERE username = :user OR email = :user');
    $this->db->bind('user', $user);

    return $this->db->row();
  }

  public function getUserByUsernameOrEmailAndPassword($user, $password) {
    $this->db->query('SELECT * FROM users WHERE (username = :user OR email = :user) AND password = :password');
    $this->db->bind('user', $user);
    $this->db->bind('password', $password);

    return $this->db->resultSet();
  }

  public function getRoleNameByUsername($username) {
    $this->db->query('SELECT name FROM roles JOIN users ON roles.id = users.role_id WHERE users.username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function getUserAmountByEmail($email) {
    $this->db->query('SELECT COUNT(*) FROM users WHERE email = :email');
    $this->db->bind('email', $email);
    
    return $this->db->row();
  }

  public function updateUserPassword($data) {
    $updatedAt = date('c');

    $this->db->query('UPDATE users SET password = :password, updated_at = :updated_at WHERE email = :email');
    $this->db->bind('password', $data['new_password']);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->bind('email', $data['email']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getUserInfoByUsername($username) {
    $this->db->query('SELECT * FROM users WHERE username = :username');
    $this->db->bind('username', $username);

    return $this->db->single();
  }

  public function updateUserProfile($data) {
    $updatedAt = date('c');

    $query = "UPDATE users SET username = :username, fullname = :fullname, email = :email, phonenumber = :phonenumber, address = :address, updated_at = :updated_at WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('fullname', $data['fullname']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('id', $data['id']);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getUserEmailByUsername($username) {
    $this->db->query('SELECT email FROM users WHERE username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function changeUserPasswordByUsername($newPassword, $username) {
    $this->db->query('UPDATE users SET password = :password WHERE username = :username');
    $this->db->bind('password', $newPassword);
    $this->db->bind('username', $username);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getEmailById($id) {
    $this->db->query('SELECT email FROM users WHERE id = :id');
    $this->db->bind('id', $id);

    return $this->db->row();
  }

  public function getFullnameById($id) {
    $this->db->query('SELECT fullname FROM users WHERE id = :id');
    $this->db->bind('id', $id);

    return $this->db->row();
  }

  public function checkEmailAvailability($email) {
    $this->db->query('SELECT COUNT(*) FROM users WHERE email = :email');
    $this->db->bind('email', $email);

    return $this->db->row();
  }

  public function getFullnameByEmail($email) {
    $this->db->query('SELECT fullname FROM users WHERE email = :email');
    $this->db->bind('email', $email);

    return $this->db->row();
  }

  public function checkPassword($password) {
    $this->db->query('SELECT COUNT(*) FROM users WHERE password = :password');
    $this->db->bind('password', $password);
    
    return $this->db->row();
  }
}
