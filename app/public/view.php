<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$code = getGet('code');
require 'inc/session.php';

$board_title = getBoardName($code);


if ($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

$idx = getGet('idx');

if ($idx == '') {
    exit('게시물 번호가 비어 있습니다. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로</a>');
}

$sql = "SELECT * FROM step4 WHERE code=:code AND idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':code' => $code , ':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다.. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로</a>');
}