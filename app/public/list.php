<?php
require 'connect.php';

$sql = "SELECT idx, name, subject, hit, rdatetime 
    FROM step2 
    
    ORDER BY idx DESC LIMIT 5, 5
    ";

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
    <table border="1">
        <tr>
            <th>글번호</th>
            <th>글제목</th>
            <th>이름</th>
            <th>조회 수</th>
            <th>날짜</th>
        </tr>
<?php
foreach($rs AS $row) {
    echo '
        <tr>
            <td>'.$row['idx'].'</td>
            <td>'.$row['subject'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['hit'].'</td>
            <td>'.$row['rdatetime'].'</td>
        </tr>
    ';
}
?>
    </table>
</body>
</html>