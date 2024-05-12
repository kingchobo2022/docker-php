<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$code = getGet('code');
$idx = getGet('idx');

$board_title = getBoardName($code);

if ($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

if ($idx == '') {
    exit('게시물 번호가 누락되었습니다. <a href="list.php?code='.$code.'">처음으로</a>');
}

if( !isset($_COOKIE['last_idx']) || $_COOKIE['last_idx'] != $idx) {
    $sql = "UPDATE step3 SET hit=hit+1 WHERE idx=:idx";
    $stmt= $conn->prepare($sql);
    $stmt->execute([':idx' => $idx]);
    
    setcookie('last_idx', $idx, time() + 86400);
}

$sql = "SELECT * FROM step3 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로 이동</a>');
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

