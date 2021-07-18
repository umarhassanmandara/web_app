<?php
include("model.class.php");

class Control extends Model{

    public function createPost($userId,$post){
        return Model::createPost($userId,$post);
    }

    public function createComment($postId,$comment){
        return Model::createComment($postId,$comment);
    }

    public function getPosts(){
        return Model::getPosts();
    }

    public function getSinglePost($userId){
        return Model::getSinglePost($userId);
    }
}

// $con = new Control();
// var_dump($con->createUser('hadiza','yusuf','f@gmail.com','098373773','jambutu','mypic','1234'));

// var_dump($con->getPosts());
?>