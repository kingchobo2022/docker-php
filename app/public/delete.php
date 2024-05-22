<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');

if($idx == '') {
    myAlert('게시물 번호가 누락되었습니다.', 'list.php');
}

$sql = "DELETE FROM step5 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$rs = $stmt->execute([':idx' => $idx]);

if($rs) {
    myAlert('게시물이 삭제되었습니다.', 'list.php');
} else {
    myAlert('게시물 삭제를 실패했습니다.', 'list.php');
}
?>