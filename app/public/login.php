<?php
include 'inc/function.php';

$code = getGet('code');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post" action="login_ok.php">
        <input type="hidden" name="<?= $code ?>" />
        아이디: <input type="text" name="id"> <br>
        암호 : <input type="password" name="passwd"> <br>
        <button>로그인</button>
    </form>
</body>
</html>