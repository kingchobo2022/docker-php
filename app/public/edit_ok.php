<?php
include 'inc/config.php';
include 'inc/connect.php';
include 'inc/function.php';

$code = getPost('code');
if ($code == '') {
    exit('게시물 코드가 빠졌습니다. <a href="index.php">처음으로</a>');
}

$idx = getPost('idx');
if ($idx == '') {
    exit('게시물 번호가 빠졌습니다. <a href="list.php?code='.$code.'">목록으로</a>');
}

$subject = getPost('subject');
if ($subject == '') {
    exit('제목이 비어있습니다. <a href="edit.php?code='.$code.'&idx='.$idx.'">게시물로 이동</a>');
}

$name = getPost('name');
if ($name == '') {
    exit('이름이 비어있습니다. <a href="edit.php?code='.$code.'&idx='.$idx.'">게시물로 이동</a>');
}

$content = getPost('content');
if ($content == '') {
    exit('본문이 비어있습니다. <a href="edit.php?code='.$code.'&idx='.$idx.'">게시물로 이동</a>');
}

$passwd = getPost('passwd');

$file_upload = (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') ? 1 : 0;

// 파일 삭제
$filedel = getPost('filedel');

if ($filedel || $file_upload) {
    $sql = "SELECT file FROM step3 WHERE idx=:idx AND code=:code";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':idx' => $idx, ':code' => $code]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['file'] != '') {
        list($file_src, $file_name, $file_hit) = explode('|', $row['file']);

        if (file_exists("data/". $file_src)) {
            unlink("data/". $file_src);
        }
    }
}

// 파일 업로드
$filename = '';
if ($file_upload) {
    if ( is_uploaded_file($_FILES['file']['tmp_name']) ) {
       $newfilename = makeFileName($_FILES['file']['name']); 
       move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $newfilename);

       $filename = $newfilename .'|'. $_FILES['file']['name'] .'|0';
    }
}

// 파일의 변경이 발생하지 않은 경우
if (!$file_upload && $filedel == '') {
    // $sql = "SELECT file FROM step3 WHERE idx=:idx";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute([':idx' => $idx]);
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // $filename = $row['file'];

    $filename = getPost('old_file');
}


$sql = "UPDATE step3 SET name=:name, subject=:subject, passwd=:passwd, 
content=:content, file=:file, edatetime=NOW() WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);

$arr = [
    ':name' => $name,
    ':subject' => $subject,
    ':passwd' => $passwd,
    ':content' => $content,
    ':file' => $filename,
    ':idx' => $idx,
    ':code' => $code
];

$rs = $stmt->execute($arr);

if ($rs) {
    exit('정상적으로 수정이 되었습니다. <a href="list.php?code='.$code.'">목록으로 </a>');
} else {
    exit('글 수정시 오류가 발생했습니다. <a href="list.php?code='.$code.'">목록으로 </a>');
}