<a href="index.php"></a>
<?php

include('config.php');
session_start();

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo("<script>alert('The email address is already registered!');</script>");
    }

    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO users VALUES (:username,:email,:password_hash)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo("<script>alert('Your registration was successful!');</script>");
        } else {
            echo("<script>alert('Something went wrong! Please try again');</script>");
        }
    }
}

?>

<script type="text/javascript">
  document.querySelector("a").click();
</script>
