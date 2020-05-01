<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
                .proj{
                    //margin-top:2%;
                    width:100%;
                    height:350px;
                    //box-shadow: 0 0px 5px rgba(0,0,0,0.30);
                    padding:1%; 
                }
                .title{
                    width:100%;
                    font-size:18pt;
                    overflow:hidden;
                }
                h2,h3{
                    font-weight:normal;
                }
                h3{
                    font-size:18pt;
                }
                .cover_img,.contentb{
                    width:48%;
                    float:left;
                    display:inline;
                }
                .cover_img img{
                    width:90%;
                    height: 300px;
                    float:right;
                    cursor:pointer;
                }
                .contentb{
                    padding-left:1%;
                    padding-right:1%;
                }
                .contentb .blurb{
                    width:100%;
                    font-size:14pt; 
                    height:250px;
                    overflow:hidden;
                    font-weight:bold;
                    color:#43A047;
                }

                .progress{
                    margin-top:1%;
                    width:80%;
                    //background-color: yellow;
                    display:inline;
                    float:left;
                }
                progress{
                    -webkit-appearance: none;
                    width:98%;
                }
                .likes img{
                    width:50px;
                    height:50px;
                }
                .likes .like{
                    font-weight:bold;
                    padding-left:10%;
                    font-size:16pt;
                }
                .likes{
                    margin-top:1%;
                    width:20%;
                    //background-color: red;
                    display:inline;
                    float:left;
                }
        </style>
        <script src="script/jquery-2.1.4.js"></script>
        <script>

            $('.likes img').click(function(){
                    var id = $('#hidden').val();
                    //alert(id);
                    $.ajax({
                    type: 'GET',
                    data: { 'pid': id } ,
                    url: 'likeincrement.php',
                    success: function(data) {
                        $('.likes span').html(parseInt($('.likes span').html())+1);
                        //alert($('.likes span').html());
                    }
                    });


            });
        </script>
    </head>
    <body onload="load()">
            <?php           
                include 'sqlconnect.php';
                $category=$_GET['category'];
                $qry='select * from project where category='.$category. 'and likes >= (select max(likes) from project where category='.$category.')';
                //echo mysql_errno();
                $result=mysql_query($qry,$con);
                
                if(mysql_num_rows($result)==0){
                    echo 'Sorry...<br>No projects are available for category '.$category.'<br>You may start one...';
                }
                else{
                //echo '<span class="head">Projects for '.$category.'...</span>';
                    
                    $row=  mysql_fetch_assoc($result);
                    $id=$row['id'];
                    $title=$row['title'];
                    $likes=$row['likes'];
                    
                    $qry2="select * from project_desc where id='$id'";
                    $result2=mysql_query($qry2,$con);
                    //echo mysql_errno();
                    $row2=  mysql_fetch_assoc($result2);
                    $proj_image='upload_images/'.$row2['proj_image'];
                    $blurb=$row2['blurb'];
                    
                    $qry3="select (sum(qty_m)/sum(qty_n))*100 as per_complete from proj_team where id='$id'";
                    $result3=mysql_query($qry3,$con);
                    $row3=  mysql_fetch_assoc($result3);
                    $per=$row3['per_complete'];
                    
                    $qry4="select * from proj_team where qty_m <> qty_n and id='$id'";
                    $result4=mysql_query($qry4,$con);
                    
                    $memtitle=array();
                    for($j=0;$j<mysql_num_rows($result4);$j++){
                        $row4=  mysql_fetch_assoc($result4);
                        $memtitle[$j]=$row4['memtitle'];
                        //echo $memtitle;
                    }
                                 
            ?>
            <input type="hidden" id="hidden" value="<?php echo $id?>" />
             <div class="proj">
                <div class="title">
                    <h2><?=$title?></h2>
                </div>
                <div class="cover_img">
                    <img src="<?=$proj_image?>" />
                </div>
                <div class="contentb">
                    <div class="blurb"><?=$blurb?></div>
                    
                    <div class="progress">
                        Current Progress in team built...
                        <progress value=<?=$per?> max="100"></progress>
                    </div>
                    
                    <div class="likes">
                        <img src="images/l2.gif"><span class="like"><?=$likes?></span>
                    </div>    
                </div>    
            </div>
            <?php
                } 
            ?>      

    </body>
</html>
