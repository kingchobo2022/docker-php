<?php

require 'inc/connect.php';
require 'inc/function.php';

$title = getPost('title');
$name = getPost('name');
$email = getPost('email');
$password = getPost('password');
$content = getPost('content');

if ($title == '') {
    $arr = ['result' => 'empty_title'];
    $json = json_encode($arr); //  {"result" : "empty_title"} 
    exit($json);
}
if ($name == '') {
    $arr = ['result' => 'empty_name'];
    $json = json_encode($arr); //  {"result" : "empty_name"} 
    exit($json);
}

if ($title == '') {
    $arr = ['result' => 'empty_title'];
    $json = json_encode($arr); //  {"result" : "empty_title"} 
    exit($json);
}
if ($password == '') {
    $arr = ['result' => 'empty_password'];
    $json = json_encode($arr); //  {"result" : "empty_password"} 
    exit($json);
}
if ($content == '') {
    $arr = ['result' => 'empty_content'];
    $json = json_encode($arr); //  {"result" : "empty_content"} 
    exit($json);
}

$sql = "INSERT INTO step7 set name=:name, 
passwd=:password, subject=:title, 
email=:email, content=:content, rdatetime=:rdatetime";

$arr = [
    ':name' => $name,
    ':password' => $password,
    ':title' => $title,
    ':email' => $email,
    ':content' => $content,
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


