<?php

$con = mysqli_connect("localhost","root","") or die("Problemes a login de bd");
mysqli_set_charset($con, "utf8") or die("Problemes amb el cotejamiento de caracteres");
$db = mysqli_select_db($con, "db_mycrag") or die("Problemes a bd");

?>