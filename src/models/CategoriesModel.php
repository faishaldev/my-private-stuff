<?php

class CategoriesModel {
  public function __construct() {
    $this->db = new Database;
  }
  
  public function getCategories() {
    $this->db->query('SELECT categories.*, users.username FROM categories JOIN users ON categories.user_id = users.id ORDER BY categories.created_at DESC');

    return $this->db->resultSet();
  }

  public function getCategoryById($id) {
    $this->db->query('SELECT * FROM categories WHERE id = :id');
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function getCategoriesByUsername($username) {
    $this->db->query('SELECT categories.*, users.username FROM categories JOIN users ON categories.user_id = users.id WHERE users.username = :username ORDER BY categories.created_at DESC');
    $this->db->bind('username', $username);

    return $this->db->resultSet();
  }

  public function getCategoriesAmount() {
    $this->db->query('SELECT COUNT(*) FROM categories');

    return $this->db->row();
  }

  public function getCategoriesAmountByUsername($username) {
    $this->db->query('SELECT COUNT(*) FROM categories JOIN users ON categories.user_id = users.id WHERE users.username = :username');
    $this->db->bind('username', $username);

    return $this->db->row();
  }

  public function addCategory($data, $userId) {
    $id = uniqid('category-');
    $createdAt = date('c');
    $updatedAt = $createdAt;
    
    $this->db->query('INSERT INTO categories VALUES (:id, :user_id, :name, :description, :created_at, :updated_at)');
    $this->db->bind('id', $id);
    $this->db->bind('user_id', $userId);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('created_at', $createdAt);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateCategory($data) {
    $updatedAt = date('c');

    $this->db->query('UPDATE categories SET name = :name, description = :description, updated_at = :updated_at WHERE id = :id');
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->bind('id', $data['id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteCategory($id) {
    $this->db->query('DELETE FROM categories WHERE id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteCategoriesByUserId($userId) {
    $this->db->query('DELETE FROM categories WHERE user_id = :user_id');
    $this->db->bind('user_id', $userId);
    $this->db->execute();

    return $this->db->rowCount();
  }
}