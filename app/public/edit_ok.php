<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$code = getPost('code');
if ($code == '') {
    exit('게시물 코드가 빠졌습니다. <a href="index.php">처음으로</a>');
}

require 'inc/session.php';

$idx = getPost('idx');
if ($idx == '') {
    exit('게시물 번호가 비어 있습니다. <a href="list.php?code='.$code.'">처음으로</a>');
}
$subject = getPost('subject');
if ($subject == '') {
    exit('제목이 비어 있습니다. <a href="edit.php?code='.$code.'&idx='.$idx.'">처음으로</a>');
}
$content = getPost('content');
if ($content == '') {
    exit('본문이 비어 있습니다. <a href="edit.php?code='.$code.'&idx='.$idx.'">처음으로</a>');
}

$sql = "SELECT member_id, file FROM step4 WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':code' => $code]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$old_file = $row['file']; // 기존 정보 보관

if ($row['member_id'] != $ses_id) {
    exit('본인이 작성한 글만 수정이 가능합니다. <a href="edit.php?code='.$code.'&idx='.$idx.'">게시물로 이동</a>');    
}


// 파일 업로드
$file_upload = (isset($_FILES['file']['tmp_name']) && $_FILES['file']['name'] != '') ? 1 : 0;

// 파일 삭제
$filedel = getPost('filedel');

if ($filedel || $file_upload) {
    if (!empty($row['file'])) {
        list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
        $file_fullpath = "data/". $file_src;
        if (file_exists($file_fullpath)) {
            unlink($file_fullpath);
        }
    }
}

// 파일 업로드
$filename = '';
if ($file_upload) {
    if ( is_uploaded_file($_FILES['file']['tmp_name'])) {
        $newfilename = makeFileName($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $newfilename);
        $filename = $newfilename .'|'. $_FILES['file']['name'] .'|0';
    }
}

// 파일 정보의 변경이 발생하지 않는 경우
if (!$file_upload && $filedel == '') {
    $filename = $old_file;
}

$sql = "UPDATE step4 SET subject=:subject, content=:content, file=:file, 
        edatetime=NOW() WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);

$arr = [
    ':subject' => $subject,
    ':content' => $content,
    ':file' => $filename,
    ':idx' => $idx,
    ':code' => $code
];

$rs = $stmt->execute($arr);

if ($rs) {
    exit('정상적으로 수정이 되었습니다. <a href="list.php?code='.$code.'">목록으로</a>');
} else {
    exit('글 수정시 오류가 발생했습니다. <a href="list.php?code='.$code.'">목록으로</a>');
}
