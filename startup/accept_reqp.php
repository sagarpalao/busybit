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

$qry="update proj_req set status='accepted' where id='$usr' and req='$proj' and forr='$pos' ";
$result=mysql_query($qry);
echo mysql_errno();

$qry="insert into proj_team_assign values('$proj','$pos','$usr') ";
$result=mysql_query($qry);

$qry="update proj_team set qty_m=qty_m+1 where id='$proj' and memtitle='$pos'  ";
$result=mysql_query($qry);



?>
