<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
$code = getGet('code');

require 'inc/session.php';

if ($code == '') {
    exit('파일을 다운로드 할 수 없습니다. <a href="index.php">처음으로</a>');
}
if ($idx == '') {
    exit('파일을 다운로드 할 수 없습니다. <a href="list.php?code='.$code.'">처음으로</a>');
}

// 다운로드 횟수 증가
$sql = "SELECT file FROM step4 WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':code' => $code]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if(!$row) {
    exit('존재하지 않는 데이터입니다. <a href="list.php?code='.$code.'">목록으로</a>');
}

list($file_src, $file_name, $file_hit) = explode('|', $row['file']);

$file_hit = $file_hit ? $file_hit : 0;
$file_hit++;

//$tmp_str = $file_src .'|'. $file_name .'|'. $file_hit;
$tmp_str = "{$file_src}|{$file_name}|{$file_hit}";

$sql = "UPDATE step4 SET file=:file WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':code' => $code, ':file' => $tmp_str]);

downloadFile('data/'.$code.'/'. $file_src, $file_name);