<?php

require 'inc/connect.php';
require 'inc/function.php';

$rsArr = checkMultiPost(['title','name','email','password','content', 'idx']);

$sql = "UPDATE step7 set name=:name, 
passwd=:password, subject=:title, 
email=:email, content=:content
WHERE idx=:idx";

$arr = [
    ':name' => $rsArr['name'],
    ':password' => $rsArr['password'],
    ':title' => $rsArr['title'],
    ':email' => $rsArr['email'],
    ':content' => $rsArr['content'],
    ':idx' => $rsArr['idx']
];

$stmt = $conn->prepare($sql);
$rs = $stmt->execute($arr);

if ($rs) {
    $arr = ['result' => 'success'];
} else {
    $arr = ['result' => 'fail'];
}

$json = json_encode($arr); 
exit($json);


