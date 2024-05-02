<?php
require "connect.php";
require "function.php";

if ( isset($_FILES['file']['tmp_name']) 
    && $_FILES['file']['tmp_name'] != ''
    && is_uploaded_file($_FILES['file']['tmp_name']) ) {

    $newfilename = makeFileName($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], 'data/'. $newfilename);
}
