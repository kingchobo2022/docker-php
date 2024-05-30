<?php
require 'inc/connect.php';
require 'inc/function.php';

$currentPage = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$baseUrl = 'list.php';

$sql = "SELECT COUNT(*) cnt FROM step7";
$total = getBoardCnt($sql, $conn); // total 글 수
$limit = 3; // 페이지당 글 수

$totalPages = ceil($total / $limit);

$paging = paginate($totalPages, $currentPage, $baseUrl);

$sql = "SELECT idx, subject, name, DATE_FORMAT(rdatetime, '%Y-%m-%d') as rdate 
FROM step7 ORDER BY idx DESC LIMIT ".(($currentPage - 1) * $limit) .",". $limit;

$stmt = $conn->prepare($sql);
$stmt->execute();
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
    <link rel="stylesheet" href="css/list.css">
</head>
<body>
    <div class="container">
        <h2>게시판 목록</h2>
        <table>
            <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">작성자</th>
                    <th scope="col">작성일</th>
                </tr>
            </thead>
            <tbody>
<?php
    foreach($rs AS $row): 
?>                
                <tr>
                    <th scope="row"><?= $row['idx'] ?></th>
                    <td><?= $row['subject'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['rdate'] ?></td>
                </tr>
<?php
    endforeach;
?>                
            </tbody>
        </table>
        
<?php 

echo $paging;

?>        
    </div>
</body>
</html>
