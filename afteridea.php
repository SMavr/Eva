<?php

include_once ('evform.php');
$idea= mysql_real_escape_string($_POST['idea']);
header("location:0evaluatormain.php");
?>