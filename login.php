<?php
    session_start();

    if(isset($_SESSION['login_user'])){
	    header("Location: index.php");
    }

    require_once 'database.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
	
	    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
	    $records->bindParam(':email', $_POST['email']);
	    $records->execute();

        if($records->rowCount() == 1){
            $results = $records->fetch(PDO::FETCH_ASSOC);

            if(password_verify($_POST['password'], $results['password'])){
                $_SESSION['login_user'] = $results['id'];

                header("Location: index.php");
            }
        }else{
            setcookie("message", 'These credentials do not match our records.', time() + 1);
            header("Location: login.php");
	    }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>Welcome</title>
    </head>
<style>
    *{	
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    #conatiner{
        width: 300px;
        margin: 0 auto;
        margin-top: 50px;
    }

    input[type="email"], input[type="password"]{
        width: 100%;
        padding: 6px;
        margin-top: 4px;
        margin-bottom: 4px;
    }

    input[type="submit"]{
        width: 100%;
        padding: 6px;
    }
</style>
<body>
<div id="conatiner">
    <form method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?> >
        <fieldset>
            <legend>Login</legend>

            <?php
                if(!empty($_COOKIE['message'])){
                    echo "<p>" . $_COOKIE['message'] . "</p>";
                }
            ?>

            <input type="email" placeholder="E-mail" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" value="Login">
        </fieldset>
    </form>
</div>
</body>
</html>