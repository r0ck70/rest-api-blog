<?php

class Post {
    // DB Staff
    private $connect;
    private $postTable = 'posts';
    private $categoryTable = 'category';

    //Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // DB Construction
    public function __construct($db) {
        $this->connect = $db;
    }

    // Get Post Data
    public function getPost() {
        // Query
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at 
        FROM posts p LEFT JOIN category c ON p.category_id = c.id ORDER BY p.created_at DESC';

        // Prepare Statement
        $stmt = $this->connect->prepare($query);

        // Execute the Query
        $stmt->execute();

        // Return the Result
        return $stmt;
    }

    // Get Single Post Data
    public function singlePost() {
        // Query
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at 
        FROM posts p LEFT JOIN category c ON p.category_id = c.id
        WHERE p.id = ? 
        LIMIT 0,1';

        // Prepare Statement
        $stmt = $this->connect->prepare($query);

        // Bind ID Param
        $stmt->bindParam(1, $this->id);

        // Execute the Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Single Post Properties
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->created_at = $row['created_at'];
    }
}