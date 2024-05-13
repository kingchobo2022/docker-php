<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
$code = getGet('code');

if($code == '') {
    exit('파일을 다운로드 받을 수 없습니다. <a href="index.php">처음으로</a>');
}

if($idx == '') {
    exit('파일을 다운로드 받을 수 없습니다. <a href="list.php?code='.$code.'">뒤로가기</a>');
}

// 다운로드 횟수 증가
$sql = "SELECT file FROM step3 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
$file_hit++;
$tmp_str = $file_src .'|'. $file_name .'|'. $file_hit;

$sql = "UPDATE step3 SET file=:file WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':file' => $tmp_str]);

$filePath = 'data/'. $file_src;
$originalFileName = $file_name;
downloadFile($filePath, $originalFileName);
