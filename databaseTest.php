<?php
require_once("../../config.php");

echo  "Hello";
global $DB;
$course = $DB->get_record('course', array('id'=>1), '*', MUST_EXIST);;
var_dump($course);
echo "<script>console.log('test')</script>";