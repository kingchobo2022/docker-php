<?php
require 'inc/config.php';
require 'inc/function.php';

$code = getGet('code');

$board_title = getBoardName($code);

if($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $board_title ?></title>
</head>
<body>
    <h1><?= $board_title ?></h1>
    
    <form method="post" enctype="multipart/form-data" action="write_ok.php" autocomplete="off">
        <input type="hidden" name="code" value="<?= $code ?>">
        이름 : <input type="text" name="name" maxlength="30"> <br>
        비밀번호 : <input type="password" name="passwd" maxlength="50"> <br>
        제목 : <input type="text" name="subject"> <br>
        본문 : <br>
        <textarea cols="100" rows="15" name="content"></textarea> <br>
        파일첨부<br>
        <input type="file" name="file"><br>
        <button>확인</button>
    </form>
</body>
</html>