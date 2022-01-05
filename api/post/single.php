<?php

// Headers
header('Access-Control-Aloww-Origin: *');
header('Content-Type: application/json');

// Includes
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();

// Instantiate Post Object
$post = new Post($db);

// Get the Post ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Single Post
$result = $post->singlePost();

// Create the Array
$postArr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
    'created_at' => $post->created_at
);

//Convert to JSON and Print
print_r(json_encode($postArr));