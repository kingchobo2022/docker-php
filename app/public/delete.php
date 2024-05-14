<?php
include 'inc/config.php';
include 'inc/function.php';
include 'inc/connect.php';

$code = getGet('code');
if ($code == '') {
    exit('게시판 코드 번호가 누락되었습니다. <a href="index.php">처음으로</a>');
}

$board_title = getBoardName($code);
if ($board_title == '') {
    exit('올바른 게시판 코드가 아닙니다. <a href="index.php">처음으로</a>');
}

$idx = getGet('idx');
if ($idx == '') {
    exit('게시물 번호가 누락되었습니다. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로</a>');
}

$sql = "SELECT file FROM step3 WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':code' => $code]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로</a>');
}

if ($row['file'] != '') {
    list($file_src, $file_name, $file_hit) = explode('|', $row['file']);

    $file_pullpath = "data/". $file_src; 
    if (file_exists($file_pullpath)) {
        unlink($file_pullpath);
    }
}

$sql = "DELETE FROM step3 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$rs = $stmt->execute([':idx' => $idx]);
if ($rs) {
    exit('게시물이 삭제되었습니다. <a href="list.php?code='. $code .'">목록으로 이동</a>');
} else {
    exit('게시물 삭제를 실패했습니다. <a href="list.php?code='. $code .'">목록으로 이동</a>');
}