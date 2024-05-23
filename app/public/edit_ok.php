<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getPost('idx');
$subject = getPost('subject');
$name = getPost('name');
$passwd = getPost('passwd');
$content = getPost('content');

if ($idx == '') {
    myAlert('게시물 번호가 비었습니다.', 'list.php');
}
if ($subject == '') {
    myAlert('게시물 제목이 비었습니다.', 'edit.php?idx='. $idx);
}
if ($name == '') {
    myAlert('게시물 이름이 비었습니다.', 'edit.php?idx='. $idx);
}
if ($content == '') {
    myAlert('게시물 내용이 비었습니다.', 'edit.php?idx='. $idx);
}

$sql = "UPDATE step5 SET name=:name, passwd=:passwd, subject=:subject, content=:content WHERE idx=:idx";
$stmt = $conn->prepare($sql);

$arr = [
    ':idx' => $idx,
    ':name' => $name,
    ':passwd' => $passwd,
    ':subject' => $subject,
    ':content' => $content
];

$rs = $stmt->execute($arr);

if ($rs) {
    myAlert('정상적으로 수정이 되었습니다.', 'list.php');
} else {
    myAlert('게시물 수정을 실패했습니다.', 'list.php');
}