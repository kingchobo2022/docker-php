<?php
require "inc/connect.php";
require "inc/function.php";

$name = getPost('name');
$subject = getPost('subject');
$content = getPost('content');
$passwd = getPost('passwd');

if ($name == '') {
    checkEmptygoBack($name, '이름');
}
if ($subject == '') {
    checkEmptygoBack($subject, '제목');
}
if ($passwd == '') {
    checkEmptygoBack($passwd, '비밀번호');
}
if ($content == '') {
    checkEmptygoBack($content, '글내용');
}

$filename = uploadFile('file'); 


$sql = "INSERT INTO step6 SET name=:name, subject=:subject, passwd=:passwd, content=:content, 
file=:file, hit=0, rdatetime=NOW()";

$stmt = $conn->prepare($sql);

$arr = [
    ':name' => $name,
    ':passwd' => $passwd,
    ':subject' => $subject,
    ':content' => $content,
    ':file' => $filename,
];

$rs = $stmt->execute($arr);

if ($rs) {
    myAlert('글 등록이 성공적으로 이뤄졌습니다.', 'list.php');
} else {
    myAlert('글 등록할때 오류가 발생했습니다.', 'list.php');
}