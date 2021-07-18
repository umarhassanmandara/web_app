<?php
include("../classes/controller.class.php");

$post = $_POST["post"];
$userId = $_SESSION['user'];

if(empty($post)){

    print_r(json_encode(array(
        'status'=>0,
        'msg'=>'pls fill all the filled'
    )));
    exit();
}
else{
    // print_r(json_encode($post));
    
            $newPost = new Control();
            //parse registration message to script file
             print_r(json_encode($newPost->createPost($userId,$post)));
         // }

}

?>