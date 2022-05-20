<?php
require_once("../../config.php");

echo  "Hello";
global $DB;
echo $course = $DB->get_record('course', array('id'=>1), '*', MUST_EXIST);;
echo "<script>console.log('test')</script>";