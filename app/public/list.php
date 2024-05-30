<?php
require 'inc/connect.php';
require 'inc/function.php';

$currentPage = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$baseUrl = 'list.php';

$sql = "SELECT COUNT(*) cnt FROM step7";
$total = getBoardCnt($sql, $conn); // total 글 수
$limit = 2; // 페이지당 글 수

$totalPages = ceil($total / $limit);

$paging = paginate($totalPages, $currentPage, $baseUrl);



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
                <tr>
                    <th scope="row">1</th>
                    <td>게시글 제목 1</td>
                    <td>작성자 1</td>
                    <td>2024-05-31</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>게시글 제목 2</td>
                    <td>작성자 2</td>
                    <td>2024-05-30</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>게시글 제목 3</td>
                    <td>작성자 3</td>
                    <td>2024-05-29</td>
                </tr>
                <!-- 추가된 게시글 -->
                <tr>
                    <th scope="row">4</th>
                    <td>게시글 제목 4</td>
                    <td>작성자 4</td>
                    <td>2024-05-28</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>게시글 제목 5</td>
                    <td>작성자 5</td>
                    <td>2024-05-27</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>게시글 제목 6</td>
                    <td>작성자 6</td>
                    <td>2024-05-26</td>
                </tr>
            </tbody>
        </table>
        
<?php 

echo $paging;

?>        
    </div>
</body>
</html>
