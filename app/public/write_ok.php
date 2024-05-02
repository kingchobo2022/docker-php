<?php
require "connect.php";

if ( isset($_FILES['file']['tmp_name']) 
    && $_FILES['file']['tmp_name'] != ''
    && is_uploaded_file($_FILES['file']['tmp_name']) ) {

    move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $_FILES['file']['name']);

}


print_r($_FILES);

print_r($_POST);
