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

$qry="delete from prof_req where usrid='$usr' and req='$pos' and id='$proj' ";
$result=mysql_query($qry);

?>