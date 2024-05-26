<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getPost('idx');
$name = getPost('name');
$subject = getPost('subject');
$content = getPost('content');
$passwd = getPost('passwd');
$filedel = getPost('filedel');

if ($idx == '') {
    checkEmptygoBack($idx, '게시물 번호');
}
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

// 파일 삭제
if ($filedel || $filename) {
    $row = getBoardView($idx, $conn, 'file');
    if ($row['file'] != '') {
        list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
        if(file_exists('data/'. $file_src)) {
            unlink('data/'. $file_src);
        }
    }
}

if ($filedel == '' && $filename == '') {
    $sql = "UPDATE step6 SET name=:name, passwd=:passwd, 
    subject=:subject, content=:content WHERE idx=:idx";

    $arr = [
        ':subject' => $subject,
        ':name' => $name,
        ':passwd' => $passwd,
        ':content' => $content,
        ':idx' => $idx
    ];

} else {
    $sql = "UPDATE step6 SET name=:name, passwd=:passwd, 
    subject=:subject, content=:content, file=:file WHERE idx=:idx";

    $arr = [
        ':subject' => $subject,
        ':name' => $name,
        ':passwd' => $passwd,
        ':content' => $content,
        ':idx' => $idx,
        ':file' => $filename
    ];
}

$stmt = $conn->prepare($sql);
$rs = $stmt->execute($arr);

if($rs) {
    $msg = '게시물이 정상적으로 수정되었습니다.';
    $where = 'list.php';
    myAlert($msg, $where);
} else {
    $msg = '게시물을 수정하는 과정에서 오류가 발생했습니다.';
    $where = 'list.php';
    myAlert($msg, $where);
}