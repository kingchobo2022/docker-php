<?php
require 'connect.php';
$idx = (isset($_POST['idx']) && is_numeric($_POST['idx'])) ? $_POST['idx'] : '';

if($idx == '') {
    echo '게시물 번호가 비어 있습니다.';  exit;
}

$sql = "UPDATE step1 
SET name=:name, passwd=:passwd, subject=:subject, content=:content
WHERE idx=:idx";

$stmt = $conn->prepare($sql);
$arr = [
    ':name' => $_POST['name'],
    ':passwd' => $_POST['passwd'],
    ':subject' => $_POST['subject'],
    ':content' => $_POST['content'],
    ':idx' => $idx
];
$rs = $stmt->execute($arr);

if($rs) {
    echo '
    <h1>정상적으로 수정이 되었습니다.</h1>
    <a href="list.php">목록으로</a>
    ';
}

