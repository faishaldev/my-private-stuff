<?php

class CategoriesModel {
  private $dbh;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getCategories() {
    $this->db->query('SELECT * FROM categories ORDER BY created_at DESC');

    return $this->db->resultSet();
  }

  public function addCategory($data) {
    $id = uniqid('category-');

    TODO: // get category owner

    $createdAt = date('c');
    $updatedAt = $createdAt;

    $query = "INSERT INTO categories VALUES (:id, :user_id, :name, :description, :created_at, :updated_at)";

    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('user_id', 'user-234');
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('created_at', $createdAt);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getCategoryById($id) {
    $this->db->query('SELECT * FROM categories WHERE id = :id');
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function editUser($data) {
    $updatedAt = date('c');

    $query = "UPDATE categories SET name = :name, description = :description, updated_at = :updated_at WHERE id = :id";

    $this->db->query($query);
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

  public function getCategoryAmount() {
    $this->db->query('SELECT COUNT(*) FROM categories');
    $this->db->execute();

    return $this->db->row();
  }
}