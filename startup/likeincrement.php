<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_GET['pid'])){
    $pid=$_GET['pid'];
    include 'sqlconnect.php';
    $qry="update project set likes=likes+1 where id='$pid'";
    $result= mysql_query($qry,$con);
}
?>
