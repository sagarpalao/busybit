<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$usr=$_GET['usr'];
$proj=$_GET['proj'];
$pos=$_GET['pos'];

include 'sqlconnect.php';

$qry="update proj_req set status='rejected' where id='$usr' and req='$proj' and forr='$pos' ";
$result=mysql_query($qry);
echo mysql_errno();

?>
