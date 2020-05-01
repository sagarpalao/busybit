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

$qry="insert into proj_team_assign values('$proj','$pos','$usr') ";
$result=mysql_query($qry);

$qry="update proj_team set qty_m=qty_m+1 where id='$proj' and memtitle='$pos'  ";
$result=mysql_query($qry);

?>
