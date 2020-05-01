<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    $id=$_GET['pid'];
?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $id; ?></title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/explore_show.css" />
        <script src="script/jquery-2.1.4.js"></script>
        <script>

            $(window).scroll(function(e){
                parallax();
            });
            function parallax(){
                var scrolled = $(window).scrollTop();
                $('.bg').css('top',-(scrolled*0.2)+'px');
                $('.bg2').css('top',-(scrolled*0.1)+'px');
            }
            
             function load(){
                document.getElementById("signin").className='';
                document.getElementById("login").className='';
                document.getElementById("explore").className='active';
                document.getElementById("start").className='';
                document.getElementById("search").className='';
            }
            $(document).ready(function(){
               $('.reqbtn').click(function(){
                  //alert('hi');
                  var pid='<?=$id?>';
                  var rid='<?=$_SESSION['creator']?>';
                  var memtitle=$(this).attr('id');
                  
                  $.ajax({
                      type:'GET',
                      data:{
                                'pid' : pid,
                                'rid' : rid,
                                'memtitle' : memtitle
                            },
                      url:'request_for_proj.php',
                      success: function(data){
                           $('#'+memtitle).attr('disabled','disabled');
                           $('#'+memtitle).css({
                                                "background-color":"#616161",                                                
                           });
                           $('#'+memtitle).removeClass('hoverbtn');
                           $('#'+memtitle).next().html('Request Sent!');
                      }    
                  });
                  
               }); 
               }); 
        </script>
    </head>
    <body onload="load();">
        <?php
            include 'header.php';
        ?>
        <div class="wrapper">
            <div class="bg"></div>
            <div class="bg2"></div>
            <?php
                include 'sqlconnect.php';

                $qry="select * from project where id='$id'";
                $result=mysql_query($qry,$con);
                
                $qry2="select * from project_desc where id='$id'";
                $result2=mysql_query($qry2,$con);
                
                $qry3="select * from proj_cards where id='$id'";
                $result3=mysql_query($qry3,$con);
                
                $qry4="select * from proj_team where id='$id' and qty_m <> qty_n";
                $result4=mysql_query($qry4,$con);
   
                    
                $row=  mysql_fetch_assoc($result);
                $id=$row['id'];
                $title=$row['title'];
                $category=$row['category'];
                $creator=$row['creator'];

                $row2=  mysql_fetch_assoc($result2);
                $proj_image=$row2['proj_image'];
                $blurb=$row2['blurb'];
                $location=$row2['location'];
                $cost=$row2['cost'];
                
                $cardid=array();
                $cardtitle=array();
                $cardblob=array();
                $carddesc=array();
                
                for($i=0;$i<mysql_num_rows($result3);$i++){
                    $row3=mysql_fetch_assoc($result3);
                    $cardid[$i]=$row3['card_id'];
                    $cardtitle[$i]=$row3['card_title'];
                    $cardblob[$i]=$row3['card_blob'];
                    $carddesc[$i]=$row3['card_desc'];
                }
                
                $memtitle=array();
                $memdesc=array();
                $memneed=array();
                
                for($i=0;$i<mysql_num_rows($result4);$i++){
                    $row4=mysql_fetch_assoc($result4);
                    $memtitle[$i]=$row4['memtitle'];
                    $memdesc[$i]=$row4['memdesc'];
                    $memneed[$i]=$row4['qty_n']-$row4['qty_m'];
                }
                
                /*echo 'title'.$title;
                echo '<br>blurb'.$blurb;
                echo '<br>category'.$category;
                echo '<br>creator'.$creator;
                echo '<br>blurb'.$blurb;
                echo '<br>location'.$location;
                echo '<br>cost'.$cost;
                
                for($i=0;$i<mysql_num_rows($result3);$i++){
                    echo '<br>'.$cardid[$i].$cardtitle[$i].$carddesc[$i];
                }
                
                for($i=0;$i<mysql_num_rows($result4);$i++){
                    echo '<br>'.$memtitle[$i].$memdesc[$i].$memneed[$i];
                }*/
            ?>   
                <div class="title1"><?php echo $title;?></div>
                
                <div class="img-cover"><img src="upload_images/<?= $proj_image?>"></div>
                
                <div class="blurb"><?=$blurb?></div>
                
                <div class="general-content">
                    <div class="snerps"><h3>Category :</h3><p><?=$category?></p></div>
                    <div class="snerps"><h3>Creator :</h3><p><?=$creator?></p></div>
                    <div class="snerps"><h3>Estimated Project Cost :</h3><p><?=$cost?></p></div>
                    <div class="snerps"><h3>Location :</h3><p><?=$location?></p></div>
                </div> 
                
                <?php for($i=0;$i<mysql_num_rows($result3);$i++){?>
                <div class="cards">
                    <div class="c-title"><?=$cardtitle[$i]?></div>
                    <div class="c-img"><img src="upload_images/<?=$cardblob[$i]?>"></div>
                    <div class="c-desc"><?=$carddesc[$i]?></div>
                </div>
                <?php }?>
                
                <div class="request">
                    <h2>Request Portal</h2>
                    
                    <?php 
                    
                    if(mysql_num_rows($result4)==0){
                        echo 'The project is all set.<br>Many exciting projects are waiting for you...';
                    }
                    if(!isset($_SESSION['loggedin'])){
                        echo 'You need to be logged in to make a request...';
                    }
                    else{
                    for($i=0;$i<mysql_num_rows($result4);$i++){?>
                    <div class="needs">
                        <div class="n-head"><?=$memtitle[$i]?></div>
                        <div class="n-desc"><?=$memdesc[$i]?></div>
                        <div class="sendr"><button id=<?=$memtitle[$i]?> class="reqbtn hoverbtn">Send Request</button>
                        <span class="reqsent"></span></div>
                    </div>
                    <?php }}?>
                </div>
                
        </div>
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
