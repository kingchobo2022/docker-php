<?php

require 'inc/connect.php';
require 'inc/function.php';

$rsArr = checkMultiPost(['title','name','email','password','content']);


$sql = "INSERT INTO step7 set name=:name, 
passwd=:password, subject=:title, 
email=:email, content=:content, rdatetime=:rdatetime";

$arr = [
    ':name' => $rsArr['name'],
    ':password' => $rsArr['password'],
    ':title' => $rsArr['title'],
    ':email' => $rsArr['email'],
    ':content' => $rsArr['content'],
    ':rdatetime' => date('Y-m-d H:i:s')
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


