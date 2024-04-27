<?php
require 'connect.php';    

$sql = "SELECT idx, name, subject, rdatetime FROM step1 ORDER BY idx DESC LIMIT 100";
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
        </tr>
<?php
    foreach($rs AS $row) :
?>            
        <tr>
            <td><?= $row['idx'] ?></td>
            <td><a href="view.php?idx=<?= $row['idx'] ?>"><?= $row['subject'] ?></a></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['rdatetime'] ?></td>
        </tr>
<?php
    endforeach;
?>        
    </table>


</body>
</html>