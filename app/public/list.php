<?php
require 'inc/connect.php';
require 'inc/function.php';

$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$baseUrl = 'list.php';

$sql = "SELECT COUNT(*) cnt FROM step5";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $row['cnt']; // total 글 수
$limit = 5; // 페이지당 글 수
$totalPages = ceil($total / $limit) ; // 올림함수 ceil(), 내림함수 floor()

$paging = paginate($totalPages, $currentPage, $baseUrl);

$sql = "SELECT idx, name, subject, rdatetime FROM step5 ORDER BY idx DESC LIMIT 100";
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
    <h1>글목록</h1>
    <a href="write.php">글쓰기</a>
    <table border="1">
        <tr>
            <th>번호</th>    
            <th>제목</th>    
            <th>이름</th>    
            <th>날짜</th>    
            <th>처리</th>    
        </tr>
<?php
    foreach($rs AS $row) :
?>
        <tr>
            <td><?= $row['idx'] ?></td>
            <td><?= $row['subject'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= substr($row['rdatetime'],0, 16) ?></td>
            <td>삭제</td>
        </tr>
<?php        
    endforeach; 
?>
    </table>
<?php
    echo $paging;
?>

</body>
</html>
