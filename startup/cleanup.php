<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$usr=$_GET['usr'];

include 'sqlconnect.php';

$qry="delete from proj_req where id='$usr' and status<>'unknown' ";
$result=mysql_query($qry);
echo mysql_errno();


?>
