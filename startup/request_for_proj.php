<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$pid=$_GET['pid'];
$rid=$_GET['rid'];
$memtitle=$_GET['memtitle'];

include 'sqlconnect.php';

$qry="insert into proj_req values('$rid','$pid','$memtitle','unknown')";
$result=mysql_query($qry);
//echo mysql_errno();
?>
