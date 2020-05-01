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
        <title>Explore</title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/explore.css" />
        <script src="script/jquery-2.1.4.js"></script>
        <script>
            function load(){
                document.getElementById("signin").className='';
                document.getElementById("login").className='';
                document.getElementById("explore").className='active';
                document.getElementById("start").className='';
                document.getElementById("search").className='';
            }
        $(document).ready(function(){
            //alert("working");
            $('.likes #img').click(function(){
                    var id = $(this).attr('alt');
                    //alert(id);
                    $.ajax({
                    type: 'GET',
                    data: { 'pid': id } ,
                    url: 'likeincrement.php',
                    success: function(data) {
                        $('img[alt='+id+']').next().html(parseInt($('img[alt='+id+']').next().html())+1);
                        //alert('img[alt="'+id+'"]');
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
        
            <?php           
                include 'sqlconnect.php';
                $category=$_GET['category'];
                $qry="select * from project where category='$category'";
                $result=mysql_query($qry,$con);
                $projcnt=mysql_num_rows($result);
                
                echo '<div class="head">' .$category. '</div>';
                echo '<div class="wrapper">';
                if($projcnt==0){
                    echo '<br>No Projets are present for the given category....<br>You may create one';
                    
                }
                else{
                for($i=0;$i<$projcnt;$i++){
                    
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
                    <a href="explore_show.php?pid=<?=$id?>"><img src="<?=$proj_image?>" /></a>
                </div>
                <div class="content">
                    <div class="blurb"><?=$blurb?></div>
                    <div class="request">
                    <h3>Need for</h3>
                    <?php
                        if(mysql_num_rows($result4)==0){
                            echo 'Project is all set...';
                        }
                        else{
                            echo '<ul class="list">';
                            for($j=0;$j<mysql_num_rows($result4);$j++){
                                echo '<li class="req-list">'.$memtitle[$j].'</li>';
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
                }
            ?>
        </div>        
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
