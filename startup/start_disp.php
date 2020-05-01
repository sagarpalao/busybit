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
        <title>Start</title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/start_disp.css" /> 
        <script src="script/jquery-2.1.4.js" ></script>
        <script>
            
            function load(){
                document.getElementById("signin").className='';
                document.getElementById("login").className='';
                document.getElementById("explore").className='';
                document.getElementById("start").className='active';
                document.getElementById("search").className='';
            }
        </script>
    </head>
    <body onload="load();"> 
        <?php
            include 'header.php';
        ?>
        
        <div class="wrapper">
            <span class="head">My Projects...</span>
        <?php
            
            include 'sqlconnect.php';
                $creator=$_SESSION['creator'];
                $qry="select * from project where creator='$creator'";
                $result=mysql_query($qry,$con);
                $projcnt=mysql_num_rows($result);
                
                for($i=0;$i<$projcnt;$i++){
                    
                    $row=  mysql_fetch_assoc($result);
                    $id=$row['id'];
                    $title=$row['title'];
                    $likes=$row['likes'];
                    
                    $qry2="select * from project_desc where id='$id'";
                    $result2=mysql_query($qry2,$con);
                    //echo mysql_errno();
                    $row2=  mysql_fetch_assoc($result2);
                    $proj_image='./upload_images/'.$row2['proj_image'];
                    $blurb=$row2['blurb'];
                    
                    $qry3="select (sum(qty_m)/sum(qty_n))*100 as per_complete from proj_team where id='$id'";
                    $result3=mysql_query($qry3,$con);
                    $row3=  mysql_fetch_assoc($result3);
                    $per=$row3['per_complete'];
                    
                    $qry4="select * from proj_team where qty_m <> qty_n and id='$id'";
                    $result4=mysql_query($qry4,$con);
                    
                    for($j=0;$j<mysql_num_rows($result4);$j++){
                        $row4=  mysql_fetch_assoc($result4);
                        $memtitle=$row4['memtitle'];
                        //echo $memtitle;
                    }
                    
                    $qry5="select * from proj_req where id='$id' and status='unknown'";
                    $result5=mysql_query($qry5,$con);
                    $reqlist=array();
                    
                    for($j=0;$j<mysql_num_rows($result5);$j++){
                        $row5=  mysql_fetch_assoc($result5);
                        $reqlist[$j]=$row5['for'];
                    }
                    
                    
                    /*echo 'title'.$title;
                    echo '<br>blurb'.$blurb;
                    echo '<br>per'.$per;
                    for($j=0;$j<mysql_num_rows($result5);$j++){
                        echo $reqlist[$j];
                    }
                    echo '<a href="start_edit.php?pid='.$id.'">go</a>';
                    echo '<br><br><br>';*/
        ?>
            
            <div class="proj">
                <div class="title">
                    <h2><?=$title?></h2>
                </div>
                <div class="cover_img">
                    <a href="start_edit.php?pid=<?=$id?>" ><img src="<?=$proj_image?>" /></a>
                </div>
                <div class="content">
                    <div class="blurb"><?=$blurb?></div>
                    <div class="request">
                    <h3>Request for</h3>
                    <?php
                        if(mysql_num_rows($result5)==0){
                            echo 'No new request...';
                        }
                        else{
                            echo '<ul class="list">';
                            for($j=0;$j<mysql_num_rows($result5);$j++){
                                echo '<li class="req-list">'.$reqlist[$j].'</li>';
                            }
                            echo '</ul>';
                        }  
                    ?>
                    </div>
                    <div class="progress">
                        Current Progress in team built...
                        <progress value=<?=$per?> max="100"></progress>
                    </div>
                    
                    <div class="likes">
                        <img id="img" src="images/l2.gif"  alt=<?=$id?> /> <span class="like" id="l"><?=$likes?></span>
                    </div>      
                </div>    
            </div>
                    
        <?php            
                    
                }
        ?>
            
        <div class="entity">
                <div class="ele">
                    <div class="addproj"><a href="start.php"><span class="plus">+</span></a></div>
                </div>
        </div> 
        </div>    
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
