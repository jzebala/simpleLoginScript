<?php

    session_start();

    require_once 'database.php';

    if(isset($_SESSION['login_user'])){ // login_user has the id value of the user.
        $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['login_user']);
        $records->execute();

        if($records->rowCount() == 1){
            $user = $records->fetch(PDO::FETCH_OBJ);
        }else{
            session_destroy();
            header("Location: login.php");
        }

    }else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>Home</title>
    </head>
<body>
<style>
    *{	
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .conatiner{
        max-width: 1000px;
        margin: 0 auto;
        padding: 10px;
    }
</style>
<div class="conatiner">
    <h1>Welcome, <?php echo $user->name ?></h1>
    <a href="logout.php">Logout</a>
    <table style="width:100%">
        <caption>User</caption>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Password</th>
            <th>Created at</th>
        </tr>
        <tr>
            <td><?php echo $user->id ?></td>
            <td><?php echo $user->name ?></td>
            <td><?php echo $user->email ?></td>
            <td><?php echo $user->password ?></td>
            <td><?php echo $user->created_at ?></td>
        </tr>
    </table>
</body>
</html>