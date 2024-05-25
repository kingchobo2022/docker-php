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

// 게시물 조회 수 카운팅
if (!isset($_SESSION['last_idx']) || $_SESSION['last_idx'] != $idx) {
    updateBoardHit($idx, $conn);
    $_SESSION['last_idx'] = $idx;
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
    <script src="js/view.js"></script>
</head>
<body>
    <h1>제목 : <?= $row['subject'] ?></h1>
    <h2>조회 수 : <?= $row['hit'] ?></h2>
    <h3>글쓴이 : <?= $row['name'] ?></h3>
    <h3>글작성일시 : <?= $row['rdatetime'] ?></h3>
    <h3>
        <button id="btn_list">목록으로</button>
        <button id="btn_edit">수정하기</button>
        <button id="btn_delete">삭제하기</button>
    </h3>
    <div>
        <?= nl2br($row['content']) ?>
    </div>

    <?php
    if($row['file']  != '') {
        list($file_src, $file_name, $file_hit) = explode('|', $row['file']);
        echo '첨부파일 : <a href="download.php?idx='.$row['idx'].'">'. 
        $file_name .'</a> (Download '. $file_hit .'회)';
    }
    ?>


</body>
</html>