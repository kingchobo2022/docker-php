<?php
require 'connect.php';
require 'function.php';

$idx = getGet('idx');
if ($idx == '') {
    exit('파일을 다운로드 받을 수 없습니다. <a href="list.php">목록으로 이동</a>');
}

$sql = "SELECT file FROM step2 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

list($file_src, $originalFileName) = explode('|', $row['file']);

$filePath = 'data/'. $file_src;

downloadFile($filePath, $originalFileName);






