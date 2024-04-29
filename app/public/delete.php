<?php
require 'connect.php';

$idx = isset($_GET['idx']) && is_numeric($_GET['idx']) ? $_GET['idx'] : '';

if ($idx == '') {
    exit('게시물 번호가 비어 있습니다.');
}

$sql = "DELETE FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$arr = [':idx' => $idx];  // array(':idx' => $idx );
$rs = $stmt->execute($arr);

if($rs) {
    echo "
    <h1>삭제가 되었습니다.</h1>
    <a href='list.php'>목록으로</a>";
    
}else {
    exit('게시물이 삭제시 오류가 발생했습니다.');
}


