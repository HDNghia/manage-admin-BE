<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>login - Food Order System</title>
    <link rel="stylesheet" href="../css/Admin.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <br><br>
        <!-- login Form Starts Here -->
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Login Forn Ends HEre -->
        <p class="text-center">Created By <a href="www.nghia.com">nghia</a></p>
    </div>

</body>

</html>

<?php

//CHeck whether the Submit button is Clicked or Not
if (isset($_POST['submit'])) {
    //Process for Login
    //1. Get the Data from Login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    //2. SQL to check whether the user with username and passNord exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //User AVailable and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

        //REdirect to HOne Page/Dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        //user not Avalable and togin FA
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //REdirect to home Page/Dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>