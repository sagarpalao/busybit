<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id=$_POST['usrid'];
$title=$_POST['title'];
$design=$_POST['design'];

include 'sqlconnect.php';

$qry="insert into prof_req values('$id','$design','$title','unknown')";
$result= mysql_query($qry,$con);
echo mysql_errno();
?>

