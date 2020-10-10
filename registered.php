<a href="index.php"></a>
<?php

include('config.php');
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo("<script>alert('Username is wrong!');</script>");
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['ID'];
            echo("<script>alert('Congratulations, you are logged in!');</script>");
        } else {
            echo("<script>alert('Password is wrong!');</script>");
        }
    }
}

?>

<script type="text/javascript">
  document.querySelector("a").click();
</script>
