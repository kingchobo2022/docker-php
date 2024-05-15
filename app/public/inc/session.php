<?php

session_start();

if (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') {
    $ses_id = $_SESSION['ses_id'];
} else {
    $ses_id = '';
}



if ($ses_id == '') {
    exit('로그인 후 이용해 주시기 바랍니다. <a href="login.php?code='.$code.'">로그인 페이지로 이동</a>');
}
