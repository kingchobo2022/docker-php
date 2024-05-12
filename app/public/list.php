<?php


require 'inc/config.php';
require 'inc/connect.php';
require 'inc/function.php';

$code = getGet('code');
$sn = getGet('sn');
$sf = getGet('sf');
$board_title = getBoardName($code);

if($board_title == '') {
    exit('올바르지 않은 게시판 코드입니다. <a href="index.php">처음으로</a>');
}

$where_str = 'WHERE code=:code';
$marr = [':code' => $code];
if ($sn != '' && $sf != '') {
    $marr[':sf'] = $sf;
    switch($sn) {
        case 'name' : $where_str .= ' AND name=:sf'; break;
        case 'subject': $where_str .= " AND subject LIKE CONCAT('%',:sf,'%')"; break;
        case 'content': $where_str .= " AND content LIKE CONCAT('%',:sf,'%')"; break;
    }

}

$currentPage = getGet('page');
$currentPage = $currentPage ? $currentPage : 1;
$baseUrl = 'list.php';

$sql = "SELECT COUNT(*) cnt FROM step3 ".$where_str;

$stmt = $conn->prepare($sql);
$stmt->execute($marr);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $row['cnt']; // total 글 수
$limit = 5; // 페이지당 글 수

$totalPages = ceil($total / $limit);

$paging = paginate($totalPages, $currentPage, $baseUrl, $code);

$sql = "SELECT idx, name, subject, hit, rdatetime, file 
        FROM step3 ".$where_str." ORDER BY idx DESC 
        LIMIT ".($currentPage - 1) * $limit .", ".$limit;

$stmt = $conn->prepare($sql);
$stmt->execute($marr);
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $board_title; ?></title>
</head>
<body>

<?php include 'inc/menu.php'; ?>

    <h1><?= $board_title; ?></h1>

<form method="get" name="search_form" action="list.php">
    <input type="hidden" name="code" value="<?= $code; ?>">
    <select name="sn">
        <option value="subject" <?= ($sn == 'subject') ? 'selected' : '' ?>>제목</option>
        <option value="name" <?= ($sn == 'name') ? 'selected': ''; ?>>이름</option>
        <option value="content" <?= ($sn == 'content') ? 'selected': ''; ?>>본문내용</option>
    </select>
    <input type="text" name="sf" value="<?= $sf; ?>"> <button>검색</button>
</form>

    <a href="write.php?code=<?= $code; ?>">글쓰기</a>
    <table border="1">
        <tr>
            <th>글번호</th>
            <th>글제목</th>
            <th>파일</th>
            <th>이름</th>
            <th>조회 수</th>
            <th>날짜</th>
        </tr>
<?php
    foreach($rs AS $row) {

        $img = getFileIcon($row['file']);
        echo '
        <tr>
            <td>'.$row['idx'].'</td>
            <td><a href="view.php?idx='.$row['idx'].'&code='.$code.'">'.$row['subject'] .'</a></td>
            <th>'.$img.'</td>
            <td>'.$row['name'] .'</td>
            <td>'.$row['hit'] .'</td>
            <td>'.substr($row['rdatetime'], 0, 16) .'</td>
        </tr>
        ';
    }
?>
    </table>

    <p>
        
<?php
    echo $paging;
?>    
    </p>
</body>
</html>