<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
            session_start();
            if(!isset($_SESSION['loggedin'])){
                    header("location: login.php");
            }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search</title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/search.css" />
        
        <script src="script/jquery-2.1.4.js"></script>
        <script>
            function load(){
                document.getElementById("signin").className='';
                document.getElementById("login").className='';
                document.getElementById("explore").className='';
                document.getElementById("start").className='';
               document.getElementById("search").className='active';
            }
            $(document).ready(function(){
                var id=$('#title').val();
                  
                  $.ajax({
                      method:'POST',
                      data:{'id':id},
                      url:'getmem.php',
                      dataType:'json',
                      success:function(data){
                          //alert('okay');
                          $('#mem').removeAttr('disabled');
                          for(var i in data){
                              var mem=data[i];
                              $('#mem').append("<option value=\""+data[i]+"\">"+data[i]+"</option>")
                          }
                      }                     
                  });
                  
               $('#title').change(function(){
                  var id=$('#title').val();
                  
                  $.ajax({
                      method:'POST',
                      data:{'id':id},
                      url:'getmem.php',
                      dataType:'json',
                      success:function(data){
                          //alert('okay');
                          $('#mem').removeAttr('disabled');
                          for(var i in data){
                              var mem=data[i];
                              $('#mem').append("<option value=\""+data[i]+"\">"+data[i]+"</option>")
                          }
                      }                     
                  });
               });
               
               $('#search1').click(function(){
                  var member=$('#mem').val(); 
                  var title=$('#title').val();
                  //alert('getprofile.php?mem='+member+'&title='+title);
                  $('.search-body').load('getprofile.php?mem='+member+'&title='+title); 
               });
            });
        </script>
    </head>
    <?php
        
        include 'sqlconnect.php';
        
        $creator=$_SESSION['creator'];
        //echo $creator;
        $qry="select * from project where creator='$creator'";
        $result=mysql_query($qry,$con);
        //echo mysql_num_rows($result);
        $projlist2=array();
        $idlist=array();
        
        for($i=0;$i<mysql_num_rows($result);$i++){
            $row=mysql_fetch_assoc($result);
            $projlist2[$i]=$row['title'];
            $idlist[$i]=$row['id'];
            //echo $projlist2[$i];
        }
       // echo mysql_num_rows($result);
    ?>
    <body onload="load();">
        <?php
           include 'header.php';
        ?>
        <div class="wrapper">      
             <div class="search-head">
                 <div class="head-title">
                     <h2>Select your project...</h2>
                     <?php $i=0; 
                     //echo  $projlist2[$i]; ?>
                 <select id="title" required>  
                     
                     <?php 
                     $qry="select * from project where creator='$creator'";
        $result=mysql_query($qry,$con);
                     for($i=0;$i<mysql_num_rows($result);$i++){?>
                     <option value="<?=$idlist[$i]?>"> <?=$projlist2[$i]?> </option>
                     
                     <?php }?>
                     
                 </select>
                     
                 </div> 
                 
                 <div class="head-mem">
                     <h2>Select the member you need...</h2>
                 <select id="mem" disabled required>
                     
                 </select>
                 </div>
                 <div class="req">
                 <button id="search1">Search</button>
                 </div>
            </div>
             <div class="search-body">
                 
            </div>
             
             
        </div>      
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
