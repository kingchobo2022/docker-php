<?php
include 'inc/config.php';
include 'inc/connect.php';
include 'inc/function.php';

$code = getGet('code');

include 'inc/session.php';

$board_title = getBoardName($code);

if ($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

$sql = "SELECT * FROM step4";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

| <a href="write.php?code=<?= $code ?>">글쓰기</a>

  <table border="1">
    <tr>
        <th>글번호</th>
        <th>글제목</th>
        <th>아이디</th>
        <th>조회 수</th>
        <th>날짜</th>
    </tr>
<?php
    foreach($rs AS $row) {

        $rdatetime = $row['rdatetime'] ? substr($row['rdatetime'], 0, 16) : '';

        echo '
        <tr>
            <td>'. $row['idx'] .'</td>
            <td>'. $row['subject'] .'</td>
            <td>'. $row['member_id'] .'</td>
            <td>'. $row['hit'] .'</td>
            <td>'. $rdatetime .'</td>
        </tr>
        ';
    }
?>    
  </table>  


</body>
</html>