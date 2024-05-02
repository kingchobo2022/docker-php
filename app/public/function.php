<?php


function makeFileName($file) {
    $tmpArr = explode('.', $file);    // aaaa.bbb.jpg ---> ['aaa','bbb','jpg']  
    $ext = strtolower(end($tmpArr));

    // 년월일시분초 .'_'. rand(1000, 9999) .'.'. $ext;
    // 240503111111
    return date('ymdHis') .'_'. rand(1000, 9999) .'.'. $ext;
}

// $name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';

function getPost($var) {
    return (isset($_POST[$var]) && $_POST[$var] != '') ? $_POST[$var] : '';
}