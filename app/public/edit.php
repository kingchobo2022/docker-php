<?php
session_start();
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
if ($idx == '') {
    $msg = '게시물 번호가 빠졌습니다.';
    $where = 'list.php';
    myAlert($msg, $where);
}


// 게시물 데이터 가져오기
$row = getBoardView($idx, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/edit.js"></script>
</head>
<body>
    <form method="post" name="edit_form" enctype="multipart/form-data" action="edit_ok.php">
        <input type="hidden" name="idx" value="<?= $idx ?>">
        이름 : <input type="text" name="name" value="<?= $row['name'] ?>"> <br>
        비밀번호 : <input type="password" name="passwd" value="<?= $row['passwd'] ?>"><br>
        제목 : <input type="text" name="subject" value="<?= $row['subject'] ?>"><br>
        글 본문 : <br>
        <textarea name="content" cols="32" rows="10"><?= $row['content'] ?></textarea><br>
        파일첨부 : <input type="file" name="file"><br>
<?php
    if ($row['file'] != '') {
        list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
        echo '<input type="checkbox" name="filedel" value="1"> '.$file_name.' 삭제<br>';
    }
?>

        <button type="button" id="btn_submit">글 수정확인</button>

    </form>

</body>
</html>