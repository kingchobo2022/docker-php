<?php

require 'inc/connect.php';
require 'inc/function.php';

$idx = getPost('idx');

if ($idx == '') {
    $arr = ['result' => 'empty_idx'];
    exit(json_encode($arr));
}

$sql = "DELETE FROM step7 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$rs = $stmt->execute([':idx' => $idx]);
if ($rs) {
    $arr = ['result' => 'success'];
} else {
    $arr = ['result' => 'fail'];
}

exit(json_encode($arr));