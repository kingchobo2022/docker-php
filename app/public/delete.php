<?php
require 'connect.php';
require 'function.php';

$idx = getGet('idx');
if ($idx == '') {
    exit('게시물 번호가 누락되었습니다. <a href="list.php">목록으로 이동 </a>');
}

$sql = "SELECT file FROM step2 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php">목록으로 이동 </a>');
}

if ($row['file'] != '') {

    list($file_src, $file_name) = explode('|', $row['file']);

    if (file_exists("data/". $file_src)) {
        unlink("data/". $file_src);
    }
}

$sql = "DELETE FROM step2 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$rs = $stmt->execute([':idx' => $idx]);

if ($rs) {
    exit('게시물이 삭제되었습니다. <a href="list.php">목록으로 이동</a>');
} else {
    exit('게시물 삭제를 실패했습니다. <a href="list.php">목록으로 이동</a>');
}

