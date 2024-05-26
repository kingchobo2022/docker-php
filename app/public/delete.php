<?php

require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');

if ($idx == '') {
    $msg = '게시물 번호가 비어 있습니다.';
    $where = 'list.php';
    myAlert($msg, $where);
}

// 파일이 첨부되어 있는지 확인
$row = getBoardView($idx, $conn, 'file');

if ($row['file'] != '') {
    list($file_src, $file_name, $file_hit) = explode('|', $row['file']);

    $file_fullpath = 'data/'. $file_src;
    if (file_exists($file_fullpath)) {
        unlink($file_fullpath);
    }
}

$sql = "DELETE FROM step6 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$rs = $stmt->execute([':idx' => $idx]);

if ($rs) {
    $msg = "게시물이 삭제되었습니다.";
    $where = "list.php";
    myAlert($msg, $where);
} else {
    $msg = "게시물이 삭제하는 도중에 오류가 발생했습니다.";
    $where = "list.php";
    myAlert($msg, $where);
}
