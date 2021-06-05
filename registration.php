<?php

//header file is included here
include 'inc/header.php';

//user file is included here
include 'lib/user.php';
$user = new user;



//if user logged in redirect user to index page
session::userLogin();

// update on reg form and database 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->userRegistration($_POST);
}

?>

<!-- body area started form here -->

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Create a new account</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegi)){
    echo $userRegi;
}

?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="number" name="phoneNumber" class="form-control" id="phoneNumber">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address">
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" name="f1" class="form-control"  id="image">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword">
                </div>
                <div class="form-check">
                    <input type="checkbox" name="terms" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">I agree with terms and conditions</label>
                </div>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>