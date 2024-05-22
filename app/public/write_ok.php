<?php
require 'inc/function.php';
require 'inc/connect.php';

$name = getPost('name');
$passwd = getPost('passwd');
$subject = getPost('subject');
$content = getPost('content');

checkEmptygoBack($name, '이름');
checkEmptygoBack($passwd, '비밀번호');
checkEmptygoBack($subject, '제목');
checkEmptygoBack($content, '본문');

$sql = "INSERT INTO step5 SET name=:name, passwd=:passwd, subject=:subject, content=:content, rdatetime=NOW()";
$stmt = $conn->prepare($sql);
$arr = [
    ':name' => $name,
    ':passwd' => $passwd,
    ':content' => $content,
    ':subject' => $subject
];

$rs = $stmt->execute($arr);
if ($rs) {
    echo "<script>alert('성공적으로 저장이 되었습니다.');
    self.location.href='list.php';
    </script>
    ";
} else {
    echo "<script>alert('글 저장에 실패했습니다.');
    self.location.href='list.php';
    </script>
    ";
}
