<?php session_start();
?>

<html>
<head>
    <link rel = "stylesheet" href ="login.css"> 
</head>
<?php include "header.php"?>
<body>
    <h2>Login</h2>    
    <?php #This will be the area that stores the session variables, currently dummy values are being used.        
    if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        include "sqlaccess.php";
        if (!empty($user)){
            if (md5($_POST['password']) == $user['password']){
                //echo "<h4>Entered Password: ".md5($_POST['password'])."</h4>";#uncomment to see the passwords
                //echo "</br>";#uncomment to see the passwords
                //echo "<h4>Stored Password: ".$user['password']."</h4>";#uncomment to see the passwords
                echo "<h4 class = 'status-success'>Successfully Login</h4>";
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $user['id'];
                header("Location:home.php");
            }
            else{
                echo "<h4 class = 'status-fail'>Invalid Username/Password</h4>";
            }
            // if (password_verify($_POST["password"],$user["password"])){
            // }
        }
        else{
            echo "<h4 class = 'status-fail'>Invalid Username/Password</h4>";
        }
    }
    ?>
    <div class = "login-container">
        <form class = "form-login" role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
        <div class = "input-container">
            <input type = "text" class = "form-control" name = "email" placeholder = "Email address" required autofocus></br>
        </div>
        <div class = "input-container">
            <input type = "password" class = "form-control" name = "password" placeholder = "Password" required></br>
        </div>
        <div class = "submit-container">
            <button class = "form-but" type = "submit" name = "login">Login</button>
        </div>
        </form>         
    </div> 
    <?php include "footer.php"?>  
   </body>
</html>