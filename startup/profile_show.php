<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $_GET['usrid'];?></title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/profile_show.css" />
    </head>
    <body>
        <?php
            include 'header.php';
        ?>
        <div class="wrapper">
        <?php
           include 'sqlconnect.php';
                
                $usrid=$_GET['usrid'];
                $qry="select * from profile where user_id='$usrid'";
                $result=mysql_query($qry,$con);
                
                $qry2="select * from profile_keystone where user_id='$usrid'";
                $result2=mysql_query($qry2,$con);
                
                $qry3="select * from profile_skills where user_id='$usrid'";
                $result3=mysql_query($qry3,$con);
                
                $row=  mysql_fetch_assoc($result);
                $name=$row['name'];
                $photo=$row['photo'];
                $emailid=$row['email_id'];
                $contact=$row['contactno'];
                $resume=$row['resume'];
                $keystone=array();
                $skills=array();
                          
                for($i=0;$i<mysql_num_rows($result2);$i++){
                    $row2=mysql_fetch_assoc($result2);
                    $keystone[$i]=$row2['keystone'];
                }
                
                for($i=0;$i<mysql_num_rows($result3);$i++){
                    $row3=mysql_fetch_assoc($result3);
                    $skills[$i]=$row3['skills'];
                }
                
                //echo $name.$emailid.$contact.'<br>';
                
                for($i=0;$i<mysql_num_rows($result2);$i++){
                    //echo $keystone[$i].'<br>';
                }
                for($i=0;$i<mysql_num_rows($result3);$i++){
                    //echo $skills[$i].'<br>';
                }
                
                //echo '<img height="300" width="300" src="tmp/tmpfile">';
                //echo '<a href="data:application;base64,'.$resume.'">resume</a>';
       ?>
           
            <div class="photo"><img src="upload_images/<?=$photo?>" /></div>
            
            <div class="name"><?=$name?></div>
            
            <div class="email"><h2>Email ID : </h2><a href="mailto:<?=$emailid?>" ><?=$emailid?></a></div>
            
            <div class="contact"><h2>Contact No.: </h2><?=$contact?></div>
            
            <div class="keystone">
             <div class="keytitle">Keystones</div><p>
            <?php for($i=0;$i<mysql_num_rows($result2);$i++){ 
                echo $keystone[$i].'<br>';
            }?></p>
            </div>
            
            <?php if(mysql_num_rows($result3)>0){ ?>
            <div class="skillset"> 
             <div class="skilltitle">Skills Set</div><p>
            <?php for($i=0;$i<mysql_num_rows($result3);$i++){ 
                echo $skills[$i].'<br>';
             }?></p><?php } ?>
            </div>
            
            <div class="resume">
                <a href="upload_resumes/<?=$resume?>" target="_blank"><p>Click to view <b>Resume</b></p></a>
            </div>
            
        </div>
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
