<?php

require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');

if ($idx == '') {
    $msg = '게시물 번호가 비어 있습니다.';
    $where = 'list.php';
    myAlert($msg, $where);
}

$row = getBoardView($idx, $conn, 'file');

// 파일 다운로드 횟수 증가
list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
$file_hit++;
$tmp_str = $file_src .'|'. $file_name .'|'. $file_hit;
$sql = "UPDATE step6 SET file=:file WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':file' => $tmp_str]);

// 파일 다운로드
downloadFile('data/'. $file_src, $file_name);
