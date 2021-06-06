<?php

//sessoin is included for once 
//if it exist it will not work it not then it will load
include_once 'session.php';

//database is included here
include 'database.php';


//all mechanism started from here

class user{
    private $db;

    public function __construct(){
        $this->db = new database;
    }


    //user registration mechanism is created here
    public function userRegistration($data){
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];
        $phoneNumber = $data['phoneNumber'];
        $address = $data['address'];
        if($_FILES['f1']['name']){
            move_uploaded_file($_FILES['f1']['tmp_name'], "assets/image".$_FILES['f1']['name']);
            $img="assets/image".$_FILES['f1']['name'];
        }
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
        $emailcheck = $this->checkEmail($email);


        //empty validation of fields
        if($name ==  "" OR $username ==  "" OR $email ==  "" OR $password ==  "" OR $cpassword ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //length validatoin

        //name length validation
        if(strlen($name) < 3){
            $msg = "<div class='alert alert-danger'>* Name can not be less than 3 character!</div>";
            return $msg;
        }elseif(strlen($name) > 15){
            $msg = "<div class='alert alert-danger'>* Name can not be more than 15 characters</div>";
            return $msg;
        }

        //username validation
        if(strlen($username) < 5){
            $msg = "<div class='alert alert-danger'>* Username can not be more than 5 characters</div>";
            return $msg;
        }elseif(strlen($username) > 15){
            $msg = "<div class='alert alert-danger'>* Username can not be more than 15 characters</div>";
            return $msg;
        }

        //password and confirm password length validation
        if(strlen($password) < 5 && strlen($cpassword) < 5){
            $msg = "<div class='alert alert-danger'>* Password can not be less than 5 characters</div>";
            return $msg;
        }elseif(strlen($password) > 30 && strlen($cpassword) > 30){
            $msg = "<div class='alert alert-danger'>* Password can not be more than 15 characters</div>";
            return $msg;
        }

        //passwords equality validation
        if($password != $cpassword){
            $msg = "<div class='alert alert-danger'>* Password are not the same</div>";
            return $msg;
        }


        //email vaidation
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'>* Email is not valid!</div>";
            return $msg;
        }


        //email existence validation
        if($emailcheck == true){
            $msg = "<div class='alert alert-danger'>* Email already exist!</div>";
            return $msg;
        }


        
        //insert data if there is no error            
        $query = "INSERT INTO `users`(`user_name`, `user_username`, `user_email`, `phoneNumber`,  `address`, `image`, `user_password`) VALUES (:name, :username, :email, :phoneNumber, :address, :image, :password)";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phoneNumber', $phoneNumber);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':image', $img);
        $sql->bindValue(':password', $password);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your account is created successfully</div>";
            return $msg;
            header("location: login.php");
        }

        
}


    //email existence check before account registering
    public function checkEmail($email){

        $query = "SELECT * FROM users WHERE `user_email` = :email";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }



    //user login mechanism is created here
    public function userLogin($data){
        $username = $data['username'];
        $password = $data['password'];

        //empty value validation
        if($username == "" OR $password == ""){
            $msg = "<div class='alert alert-danger'>* Fields are required</div>";
            return $msg;
        }


        //length validation
        
        //username length validation
        if(strlen($username) <5 && strlen($username) > 15){
            $msg = "<div class='alert alert-danger'>* Username should be between 5-15 characters</div>";
            return $msg;
        }

        //password validation
        if(strlen($password) <5 && strlen($password) > 15){
            $msg = "<div class='alert alert-danger'>* Password should be between 5-15 characters</div>";
            return $msg;
        }


        //user will be login if there is no error

        $result = $this->getLoginUserData($username, $password);
        
        if($result){
            session::init();
            session::set("login", true);
            session::set("id", $result->id);
            session::set("name", $result->name);
            session::set("username", $result->username);
            session::set("email", $result->email);
            session::set("loginmsg", "<div class='container'><div class='alert alert-success'>You are logged in</div></div>");
            header("location: index.php");
        }else{
            echo "<div class='container mt-5'><div class='alert alert-danger'>Username and Passwords are not correct</div></div>";
        }
    }


    
    //user data fetch form database
    public function getLoginUserData($username, $password){

        $query = "SELECT * FROM users WHERE `user_username` = :username AND `user_password` = :password";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':password', $password);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
    }


    //get all data from the database
    public function userList(){
        
        $query = "SELECT * FROM users";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //get all data from database based on id
    public function userById($userid){

        $query = "SELECT * FROM users WHERE `user_id` = :id LIMIT 1";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id', $userid);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }


    //user update mechanism is created here
    public function userUpdate($id, $data){
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
        $emailcheck = $this->checkEmail($email);


        //empty validation of fields
        if($name ==  "" OR $username ==  "" OR $email ==  "" OR $password ==  "" OR $cpassword ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //length validatoin

        //name length validation
        if(strlen($name) < 3){
            $msg = "<div class='alert alert-danger'>* Name can not be less than 3 character!</div>";
            return $msg;
        }elseif(strlen($name) > 15){
            $msg = "<div class='alert alert-danger'>* Name can not be more than 15 characters</div>";
            return $msg;
        }

        //username validation
        if(strlen($username) < 5){
            $msg = "<div class='alert alert-danger'>* Username can not be more than 5 characters</div>";
            return $msg;
        }elseif(strlen($username) > 15){
            $msg = "<div class='alert alert-danger'>* Username can not be more than 15 characters</div>";
            return $msg;
        }

        //password and confirm password length validation
        if(strlen($password) < 5 && strlen($cpassword) < 5){
            $msg = "<div class='alert alert-danger'>* Password can not be less than 5 characters</div>";
            return $msg;
        }elseif(strlen($password) > 30 && strlen($cpassword) > 30){
            $msg = "<div class='alert alert-danger'>* Password can not be more than 15 characters</div>";
            return $msg;
        }

        //passwords equality validation
        if($password != $cpassword){
            $msg = "<div class='alert alert-danger'>* Password are not the same</div>";
            return $msg;
        }


        //email vaidation
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'>* Email is not valid!</div>";
            return $msg;
        }


        //email existence validation
        if($emailcheck == true){
            $msg = "<div class='alert alert-danger'>* Email already exist!</div>";
            return $msg;
        }


        
        //insert data if there is no error            
        $query = "UPDATE `users` SET `user_name`=:name,`user_username`=:username,`user_email`=:email,`user_password`=:password WHERE `user_id` = :id";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->bindValue(':id', $id);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your updated successfully</div>";
            return $msg;
        }
    }

}