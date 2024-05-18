<?php
require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$code = getGet('code');
require 'inc/session.php';

$board_title = getBoardName($code);


if ($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

$idx = getGet('idx');

if ($idx == '') {
    exit('게시물 번호가 비어 있습니다. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로</a>');
}

$sql = "SELECT * FROM step4 WHERE code=:code AND idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':code' => $code , ':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// 조회 수 증가
if ($row['last_viewer'] != $ses_id) {
    $sql = "UPDATE step4 SET hit=hit+1, last_viewer=:last_viewer WHERE code=:code AND idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':code' => $code , ':idx' => $idx, ':last_viewer' => $ses_id]);
}


if (!$row) {
    exit('해당 게시물이 존재하지 않습니다.. <a href="list.php?code='.$code.'">'.$board_title.' 목록으로</a>');
}

$img_tag = '';
if ($row['file']) {
    list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
    $img_tag = '<img src="data/'.$file_src.'" width="350">';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['subject'] ?></title>
</head>
<body>
    <table border="1" width="500">
        <tr>
            <td width="100">제목</td>
            <td width="400" colspan="3"><?= $row['subject'] ?></td>
        </tr>
        <tr>
            <td>조회 수</td>
            <td width="100"><?= $row['hit'] ?></td>
            <td width="100">등록일시</td>
            <td width="200"><?= $row['rdatetime'] ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding:20px;">
                <?= nl2br($row['content']) . $img_tag ?>
            </td>
        </tr>
        <?php if($row['file']) { ?>
        <tr>
            <td>파일</td>
            <td colspan="3"><a href="download.php?idx=<?= $row['idx'] ?>"><?= $file_name ?></a> (다운로드 <?= $file_hit ?> 회)</td>
        </tr>
        <?php            
        }
        ?>
    </table>    
</body>
</html>
