<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['id'])){
    
    $id=$_POST['id'];
    include 'sqlconnect.php';
    
    $qry="select * from proj_team where qty_n <> qty_m and id='$id'";
    $result= mysql_query($qry,$con);
    
    $mem=array();
    for($i=0;$i<mysql_num_rows($result);$i++){
        $row=  mysql_fetch_assoc($result);
        $mem[$i]=$row['memtitle'];
        
    }
    echo json_encode($mem);
    
}
?>
