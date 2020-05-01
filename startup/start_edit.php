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
        <title>Start | Edit</title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/start_edit.css" />
        <script src="script/jquery-2.1.4.js" ></script>
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
                document.getElementById("explore").className='';
                document.getElementById("start").className='active';
                document.getElementById("search").className='';
            }
        </script>
    </head>
    <body onload="load()">
        <?php
            include 'header.php';
        ?>
        <div class="wrapper">
            <div class="bg"></div>
            <div class="bg2"></div>
            <?php
            include 'sqlconnect.php';
                $id=$_GET['pid'];
                $qry="select * from project where id='$id'";
                $result=mysql_query($qry,$con);
                
                $qry2="select * from project_desc where id='$id'";
                $result2=mysql_query($qry2,$con);
                
                $qry3="select * from proj_cards where id='$id'";
                $result3=mysql_query($qry3,$con);
                
                $qry4="select * from proj_team_assign where id='$id' order by design";
                $result4=mysql_query($qry4,$con);
                
                $qry5="select * from proj_req where id='$id'";
                $result5=mysql_query($qry5,$con);
   
                    
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
                
                $design=array();
                $assign=array();
                
                for($i=0;$i<mysql_num_rows($result4);$i++){
                    $row4=mysql_fetch_assoc($result4);
                    $design[$i]=$row4['design'];
                    $assign[$i]=$row4['assigned'];
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
                }
                
                $reqlist=array();
                $reqby=array();
                
                for($i=0;$i<mysql_num_rows($result5);$i++){
                    $row5=mysql_fetch_assoc($result5);
                    $reqlist[$i]=$row5['for'];
                    $reqby[$i]=$row5['req'];
                }
                
                for($i=0;$i<mysql_num_rows($result5);$i++){
                    echo '<br>'.$reqlist[$i].$reqby[$i].' <a href="profile_show.php?usrid='.$reqby[$i].'" target="_blank">'.$reqby[$i].'</a>';
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
                    <h2>Team built till date...</h2>
                    
                    <?php 
                        
                        for($i=0;$i<mysql_num_rows($result4);$i++){?>
                            <div class="teamlist teamlist<?=($i+1)%3?>">
                                <?php $pos=$design[$i]; ?>
                                <div class="postion"><?=$pos?></div>
                                <div class="members">
                                <?php while($design[$i]==$pos){?>
                                <ul><li><a href="profile_show.php?usrid=<?=$assign[$i]?>" ><?=$assign[$i]?></a></li></ul>
                                <?php 
                                    //echo $i;
                                    $i++;
                                    if($i>=mysql_num_rows($result4)){
                                      break;
                                    }
                                }
                                $i--;
                                ?>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
        </div>
        
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
