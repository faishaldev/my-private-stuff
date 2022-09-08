<?php

class StuffsModel {
  private $dbh;

  public function __construct() {
    $this->db = new Database;
  }

  public function getStuffs() {
    $this->db->query('SELECT stuffs.*, categories.name as category_name, users.username as user_username FROM stuffs JOIN categories ON stuffs.category_id = categories.id JOIN users ON stuffs.user_id = users.id ORDER BY created_at DESC');

    return $this->db->resultSet();
  }

  public function addStuff($data) {
    $id = uniqid('stuff-');

    TODO: // get stuff owner

    $createdAt = date('c');
    $updatedAt = $createdAt;

    $query = "INSERT INTO stuffs (id, category_id, user_id, name, description, created_at, updated_at) VALUES (:id, :category_id, :user_id, :name, :description, :created_at, :updated_at)";

    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('category_id', $data['category']);
    $this->db->bind('user_id', 'user-345');
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('created_at', $createdAt);
    $this->db->bind('updated_at', $updatedAt);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getStuffById($id) {
    $this->db->query('SELECT stuffs.*, categories.name as category_name, users.username as user_username FROM stuffs JOIN categories ON stuffs.category_id = categories.id JOIN users ON stuffs.user_id = users.id WHERE stuffs.id = :id');
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function editUser($data) {
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
  
  public function getStuffAmount() {
    $this->db->query('SELECT COUNT(*) FROM stuffs');
    $this->db->execute();

    return $this->db->row();
  }
}