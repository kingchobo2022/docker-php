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

$sn = getGet('sn'); 
$sf = getGet('sf');

$where_str = ' WHERE code=:code ';
$marr = [':code' => $code];
if ($sn != '' && $sf != '') {
    $marr[':sf'] = $sf;
    switch($sn) {
        case 'member_id' : $where_str .= ' AND member_id=:sf '; break;
        case 'subject' : $where_str .= " AND subject LIKE CONCAT('%', :sf , '%')"; break;
        case 'content' : $where_str .= " AND content LIKE CONCAT('%', :sf , '%')"; break;
        case 'all' : $where_str .= " AND (subject LIKE CONCAT('%', :sf , '%') OR (content LIKE CONCAT('%', :sf , '%')))"; break;
    }
}

$sql = "SELECT COUNT(*) cnt FROM step4 ". $where_str;
$stmt = $conn->prepare($sql);
$stmt->execute($marr);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $row['cnt']; // 11
$limit = 5;  // 1~5, 6~10, 11
$totalPages = ceil($total / $limit);  

$currentPage = getGet('page');
$currentPage = $currentPage ? $currentPage : 1;
$baseUrl = 'list.php';

$paging = paginate($totalPages, $currentPage, $baseUrl, $code) ;

$sql = "SELECT idx, member_id, subject, hit, rdatetime, file 
        FROM step4 {$where_str} ORDER BY idx DESC LIMIT ".($currentPage - 1) * $limit.", {$limit}"; 

$stmt = $conn->prepare($sql);
$stmt->execute($marr);
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

<form method="get" name="search_form" action="list.php">
    <input type="hidden" name="code" value="<?= $code ?>">
    <select name="sn">
        <option value="all" <?= ($sn == 'all') ? 'selected' : ''; ?>>제목+내용</option>
        <option value="subject" <?= ($sn == 'subject') ? 'selected' : ''; ?>>제목</option>
        <option value="member_id" <?= ($sn == 'member_id') ? 'selected' : ''; ?>>아이디</option>
        <option value="content" <?= ($sn == 'content') ? 'selected' : ''; ?>>내용</option>
    </select>
    <input type="text" name="sf" value="<?= $sf ?>"> <button>검색</button>
</form>

총 <?= $total ?>개의 게시물이 있습니다.<br>

| <a href="write.php?code=<?= $code ?>">글쓰기</a>

  <table border="1">
    <tr>
        <th>글번호</th>
        <th>글제목</th>
        <th>파일</th>
        <th>아이디</th>
        <th>조회 수</th>
        <th>날짜</th>
    </tr>
<?php
    foreach($rs AS $row) {

        $rdatetime = $row['rdatetime'] ? substr($row['rdatetime'], 0, 16) : '';
        $img = getFileIcon($row['file']);

        if ($ses_id != '') {
            $link = 'view.php?idx='. $row['idx'].'&code='. $code;
        } else {
            $link = 'login.php';
        }

        echo '
        <tr>
            <td>'. $row['idx'] .'</td>
            <td><a href="'.$link.'">'. $row['subject'] .'</a></td>
            <td>'. $img .'</td>
            <td>'. $row['member_id'] .'</td>
            <td>'. $row['hit'] .'</td>
            <td>'. $rdatetime .'</td>
        </tr>
        ';
    }
?>    
  </table>  
<hr>
<?php echo $paging; ?>  

</body>
</html>