<!--/login.php-->
<?php 
session_start();
include('includes/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users Where username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0){
        $suer = $result->fetch_assoc();
        if(password_verify($password,  $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit;
        }else{
            $error = "Niepoprawne Hasło!";
        }
    }   else {
        $error = "Użytkownik nie isnieje!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h2>Logowanie</h2>
            <?php
            if (isset($error)) echo "<p class="error">$error</p>";
            ?>
            <label for="username">Nazwa uzytkowniaka:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
    
</body>
</html>