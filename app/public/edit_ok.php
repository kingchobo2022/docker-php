<?php
require 'connect.php';
require 'function.php';

$idx = getPost('idx');
if ($idx == '') {
    exit('게시물 번호가 누락되었습니다. <a href="list.php">목록으로 이동 </a>');
}

$subject = getPost('subject');
if ($subject == '') {
    exit('게시물 제목이 누락되었습니다. <a href="list.php">목록으로 이동 </a>');
}

$name = getPost('subject');
if ($name == '') {
    exit('이름이 누락되었습니다. <a href="list.php">목록으로 이동 </a>');
}

$passwd = getPost('passwd');
$content = getPost('content');

$file_upload = (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name']  != '') ? 1 : 0;

// 파일 삭제
$filedel = getPost('filedel');
if ($filedel || $file_upload) {
    $sql = "SELECT file FROM step2 WHERE idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':idx' => $idx]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['file'] != '') {

        list($file_src, $file_name) = explode('|', $row['file']);
    
        if (file_exists("data/". $file_src)) {
            unlink("data/". $file_src);
        }
    }
        
}

// 파일 업로드
$filename = '';
if ( $file_upload ) {
    if ( isset($_FILES['file']['tmp_name']) 
        && $_FILES['file']['tmp_name'] != ''
        && is_uploaded_file($_FILES['file']['tmp_name']) ) {

        $newfilename = makeFileName($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $newfilename);

        $filename = $newfilename .'|'. $_FILES['file']['name'];
    }
}

// 파일이 교체된 경우
// 파일이 삭제만 된 경우
// 파일을 삭제하지도 교체하지도 않은 경우
if ($filename == '' && $filedel == 0) {
    $sql = "SELECT file FROM step2 WHERE idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':idx' => $idx]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $filename = $row['file'];
}


$sql = "UPDATE step2 
    SET name=:name, subject=:subject,
        passwd=:passwd, content=:content,
        file=:file,  edatetime=NOW() WHERE idx=:idx";
$stmt = $conn->prepare($sql);

$arr = [
    ':name' => $name,
    ':passwd' => $passwd,
    ':subject' => $subject,
    ':content' => $content,
    ':file' => $filename,
    ':idx' => $idx
];

$rs = $stmt->execute($arr);

if ($rs) {
    exit('정상적으로 수정이 되었습니다. <a href="list.php">목록으로</a>');
} else {
    exit('글 수정시 오류가 발생했습니다. <a href="list.php">목록으로</a>');
}
