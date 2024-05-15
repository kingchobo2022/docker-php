<?php
include 'inc/config.php';
include 'inc/function.php';

$code = getGet('code');

include 'inc/session.php';

$board_title = getBoardName($code);

if($board_title == '') {
    exit('올바른 게시판 코드가 아닙니다. <a href="index.php">처음으로</a>');
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
<?php
    echo  '['.$ses_id.'] 님이 로그인 하셨습니다. <a href="logout.php">로그아웃</a> ';
?>
<hr>
    <?php include 'inc/menu.php'; ?>
<hr>


    <h1><?= $board_title ?></h1>
    <form method="post" enctype="multipart/form-data" action="write_ok.php" autocomplete="off">
        <input type="hidden" name="code" value="<?= $code ?>">
        제목 : <input type="text" name="subject" size="80"> <br>
        본문 : <br>
        <textarea name="content" cols="100" rows="15"></textarea><br>
        파일첨부 <br>
        <input type="file" name="file"><br>
        <button>확인</button>
    </form>
</body>
</html>