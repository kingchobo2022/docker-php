<?php
require 'inc/function.php';

$code = getGet('code');

if($code == 'notice') {
    $board_title = '공지사항';
} else if($code == 'free') {
    $board_title = '자유게시판';
} else {
    $board_title = '';
}

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
    
</body>
</html>