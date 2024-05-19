<?php
require 'inc/config.php';
require 'inc/function.php';
require 'inc/connect.php';

$code = getGet('code');
if ($code == '') {
    exit('게시판 코드가 비어있습니다. <a href="index.php">처음으로</a>');
}

require 'inc/session.php';
$idx = getGet('idx');
if ($idx == '') {
    exit('게시물 번호가 비어있습니다. <a href="list.php?code='.$code.'">목록으로</a>');
}

$board_title = getBoardName($code);
if ($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

$sql = "SELECT * FROM step4 WHERE idx=:idx AND code=:code";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx, ':code' => $code]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    exit('해당 게시물이 존재하지 않습니다. <a href="list.php?code='.$code.'">목록으로</a>');
}

if ($row['member_id'] != $ses_id) {
    exit('본인 게시물만 삭제가 가능합니다. <a href="view.php?code='.$code.'&idx='.$idx.'">뒤로하기</a>');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'inc/menu.php'; ?>

    <h1><?= $board_title; ?></h1>
    <form method="post" enctype="multipart/form-data" action="edit_ok.php">
        <input type="hidden" name="code" value="<?= $code ?>">
        <input type="hidden" name="idx" value="<?= $idx ?>">
        <table border="1" width="500">
            <tr>
                <td>제목</td>
                <td><input type="text" name="subject" value="<?= $row['subject'] ?>"></td>
            </tr>
            <tr>
                <td>아이디</td>
                <td><?= $row['member_id'] ?></td>
            </tr>
            <tr>
                <td>본문</td>
                <td>
                    <textarea name="content" cols="40" rows="10"><?= $row['content'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td>첨부파일</td>
                <td>
                        <input type="file" name="file"> <br>
<?php 
        if ($row['file']) { 
            list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
            echo '<input type="checkbox" name="filedel" value="1">'. $file_name .' 삭제';
        }  
?>    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button>확인</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
