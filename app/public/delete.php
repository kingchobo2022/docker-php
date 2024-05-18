<?php
require 'inc/config.php';
require 'inc/function.php';
require 'inc/connect.php';

$code = getGet('code');
if ($code == '') {
    exit('게시판 코드가 비어있습니다. <a href="index.php">처음으로</a>');
}

require 'inc/session.php';
$idx = getGet('idx');
if ($idx == '') {
    exit('게시물 번호가 비어있습니다. <a href="list.php?code='.$code.'">목록으로</a>');
}

$sql = "SELECT file, member_id FROM step4 WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':code' => $code]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php?code='.$code.'">목록으로</a>');
}

if ($row['member_id'] != $ses_id) {
    exit('본인 게시물만 삭제가 가능합니다. <a href="view.php?code='.$code.'&idx='.$idx.'">뒤로하기</a>');
}

if ($row['file'] != '') {
    list($file_src, $file_name, $file_hit) = explode('|', $row['file']);

    $file_fullpath = 'data/'. $file_src;
    if (file_exists($file_fullpath)) {
        unlink($file_fullpath);
    }
}

$sql = "DELETE FROM step4 WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$rs = $stmt->execute([':idx' => $idx, ':code' => $code]);
if ($rs) {
    exit('게시물이 삭제되었습니다. <a href="list.php?code='.$code.'">목록으로 </a>');
} else {
    exit('게시물 삭제를 실패했습니다. <a href="list.php?code='.$code.'">목록으로 </a>');
}