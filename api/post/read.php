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

// Instantiate Post Query
$result = $post->getPost();

// Number of Posts
$num = $result->rowCount();

// If Any Post
if($num > 0) {
    // Data Array
    $postsArr = array();
    $postsArr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        //Post Item Array
        $postItem = array(
            'id' => $id,
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
            'created_at' => $created_at
        );

        // Push to 'data' Value
        array_push($postsArr['data'], $postItem);

        // Array to JSON Encoding
        $jsonEncoded = json_encode($postsArr);
    }
    
    // Print the JSON
    print_r($jsonEncoded);
} else {
    $errorArr = array(
        'message' => 'No post found!'
    );

    // JSON Encode and Print the Error
    echo json_encode($errorArr);
}