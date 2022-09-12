<?php

class StuffsModel {
  public function __construct() {
    $this->db = new Database;
  }

  public function getStuffs() {
    $this->db->query('SELECT stuffs.*, categories.name as category_name, users.username as user_username FROM stuffs JOIN categories ON stuffs.category_id = categories.id JOIN users ON stuffs.user_id = users.id ORDER BY created_at DESC');

    return $this->db->resultSet();
  }

  public function addStuff($data) {
    $id = uniqid('stuff-');
    $userId = $this->getStuffOwnerByUsername($data['username']);
    $createdAt = date('c');
    $updatedAt = $createdAt;

    $query = "INSERT INTO stuffs (id, category_id, user_id, name, description, created_at, updated_at) VALUES (:id, :category_id, :user_id, :name, :description, :created_at, :updated_at)";

    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('category_id', $data['category']);
    $this->db->bind('user_id', $userId);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('created_at', $createdAt);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getStuffOwnerByUsername($username) {
    $this->db->query('SELECT id FROM users WHERE username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function getStuffById($id) {
    $this->db->query('SELECT stuffs.*, categories.name as category_name, users.username as user_username FROM stuffs JOIN categories ON stuffs.category_id = categories.id JOIN users ON stuffs.user_id = users.id WHERE stuffs.id = :id');
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function updateStuff($data) {
    $updatedAt = date('c');

    $query = "UPDATE stuffs SET category_id = :category_id, name = :name, description = :description, updated_at = :updated_at WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('category_id', $data['category']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->bind('id', $data['id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteStuff($id) {
    $this->db->query('DELETE FROM stuffs WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }
  
  public function getStuffsAmount() {
    $this->db->query('SELECT COUNT(*) FROM stuffs');

    return $this->db->row();
  }

  public function getStuffsAmountByUsername($username) {
    $this->db->query('SELECT COUNT(*) FROM stuffs JOIN users ON stuffs.user_id = users.id WHERE users.username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function getStuffsByUsername($username) {
    $this->db->query('SELECT stuffs.*, categories.name as category_name, users.username as user_username FROM stuffs JOIN users ON stuffs.user_id = users.id JOIN categories ON stuffs.category_id = categories.id WHERE users.username = :username ORDER BY stuffs.created_at DESC');
    $this->db->bind('username', $username);

    return $this->db->resultSet();
  }

  public function getStuffsAmountByCategoryId($categoryId) {
    $this->db->query('SELECT COUNT(*) FROM stuffs WHERE category_id = :category_id');
    $this->db->bind('category_id', $categoryId);

    return $this->db->row();
  }
}