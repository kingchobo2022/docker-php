<?php
require 'connect.php';

$sql = "INSERT INTO step1 
        SET name=:name, passwd=:passwd, subject=:subject, content=:content, rdatetime=NOW()";
$stmt = $conn->prepare($sql);
$arr = [
    ':name' => $_POST['name'],
    ':passwd' => $_POST['passwd'],
    ':content' => $_POST['content'],
    ':subject' => $_POST['subject'],
];

$rs = $stmt->execute($arr);

if($rs) {
    echo "성공적으로 저장이 되었습니다. <a href='list.php'>글목록으로 이동</a>";
} else{
    echo "글 저장에 실패했습니다. <a href='list.php'>글목록으로 이동</a>";
}