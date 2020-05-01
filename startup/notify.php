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
        <title>Your Notifications</title>
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/notify.css" />
        <script src="script/jquery-2.1.4.js"></script>
        <script>
            $(document).ready(function(){
               $('.res').click(function(){
                   var req=$(this).attr('id');
                   var reqs=req.split("_");
                   //alert(reqs[3]);
                   if(reqs[0]==="accept"){
                       var usr=reqs[1];
                       var proj=reqs[2];
                       var pos=reqs[3];
                       
                       $.ajax({
                      type:'GET',
                      data:{
                                'usr' : usr,
                                'proj' : proj,
                                'pos' : pos
                            },
                      url:'accept_req.php',
                      success: function(data){
                           $('#'+req).attr('disabled','disabled');
                           $('#'+req).css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).removeClass('hov');
                           $('#'+req).next().html('Request Accepted!');
                           $('#'+req).parent().next().children().attr('disabled','disabled');
                           $('#'+req).parent().next().children().css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).parent().next().children().removeClass('hov');
                      }    
                  });
                  
                   }
                   else if(reqs[0]==="reject"){
                       var usr=reqs[1];
                       var proj=reqs[2];
                       var pos=reqs[3];
                       
                       $.ajax({
                      type:'GET',
                      data:{
                                'usr' : usr,
                                'proj' : proj,
                                'pos' : pos
                            },
                      url:'reject_req.php',
                      success: function(data){
                           $('#'+req).attr('disabled','disabled');
                           $('#'+req).css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).removeClass('hov');
                           $('#'+req).next().html('Request Rejected!');
                           $('#'+req).parent().prev().children().attr('disabled','disabled');
                           $('#'+req).parent().prev().children().css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).parent().prev().children().removeClass('hov');
                      }    
                  });
                   }
               }); 
               
               
               $('.reqp').click(function(){
                   var req=$(this).attr('id');
                   var reqs=req.split("_");
                   //alert(reqs[3]);
                   if(reqs[0]==="accept"){
                       var usr=reqs[2];
                       var proj=reqs[1];
                       var pos=reqs[3];
                       
                       $.ajax({
                      type:'GET',
                      data:{
                                'usr' : usr,
                                'proj' : proj,
                                'pos' : pos
                            },
                      url:'accept_reqp.php',
                      success: function(data){
                          //alert(data);
                           $('#'+req).attr('disabled','disabled');
                           $('#'+req).css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).removeClass('hov');
                           $('#'+req).next().html('Request Accepted!');
                           $('#'+req).parent().next().children().attr('disabled','disabled');
                           $('#'+req).parent().next().children().css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).parent().next().children().removeClass('hov');
                      }    
                  });
                  
                   }
                   else if(reqs[0]==="reject"){
                       var usr=reqs[2];
                       var proj=reqs[1];
                       var pos=reqs[3];
                       
                       $.ajax({
                      type:'GET',
                      data:{
                                'usr' : usr,
                                'proj' : proj,
                                'pos' : pos
                            },
                      url:'reject_reqp.php',
                      success: function(data){
                          //alert( data);
                           $('#'+req).attr('disabled','disabled');
                           $('#'+req).css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).removeClass('hov');
                           $('#'+req).next().html('Request Rejected!');
                           $('#'+req).parent().prev().children().attr('disabled','disabled');
                           $('#'+req).parent().prev().children().css({
                                                "background-color":"#616161"                                               
                           });
                           $('#'+req).parent().prev().children().removeClass('hov');
                      }    
                  });
                   }
               }); 
               
               
               $('.cleanup').click(function(){
                   var usr=$(this).attr('id');
                       
                       $.ajax({
                      type:'GET',
                      data:{
                                'usr' : usr
                            },
                      url:'cleanup.php',
                      success: function(data){
                          //alert(data);
                           $('#'+usr).parent().parent().fadeOut(2000,function(){
                               $('#'+usr).parent().parent().css({"display":"none"});
                           });
                      }    
                  });
              });
                   
            });
        </script>
        
    </head>
    <body>
        <?php
            include'header.php';
        ?>
        <?php          
            include 'sqlconnect.php';
            
            $usr=$_SESSION['creator'];
            
            $qry="select * from prof_req where usrid='$usr'";
            $result=mysql_query($qry,$con);
            
            $qry1="select * from proj_req where id='$usr' and status<>'unknown'";
            $result1=mysql_query($qry1,$con);
            
            $qry2="select * from project where creator='$usr'";
            $result2=mysql_query($qry2,$con);
            
            
            $projlist=null;
            for($i=0;$i<mysql_num_rows($result2);$i++){
                $row2=  mysql_fetch_assoc($result2);
                $proj=$row2['id'];
                $projlist=$projlist.'\''.$proj.'\'';
                if($i<mysql_num_rows($result2)-1){
                    $projlist=$projlist.',';
                }
            }
            //echo $projlist;
            $qry3="select * from proj_req where req in ($projlist) and status='unknown'";
            $result3=mysql_query($qry3,$con);
            
            //echo 'Reuest for u <br>';
            for($i=0;$i<mysql_num_rows($result);$i++){
                $row=  mysql_fetch_assoc($result);
                //echo $row['id'].'<br>';
            }
            //echo '<br>';
            //echo 'Reuest sent by  u <br>';
            for($i=0;$i<mysql_num_rows($result1);$i++){
                $row1=  mysql_fetch_assoc($result1);
               // echo $row1['req'].'<br>';
            }
           // echo '<br>';
           // echo 'Reuest for my projects <br>';
            for($i=0;$i<mysql_num_rows($result3);$i++){
                $row3=  mysql_fetch_assoc($result3);
               // echo $row3['id'].'<br>';
            }
            
        ?>
        
        
        <div class="wrapper">
                        
            <?php if(mysql_num_rows($result)>0){ ?>
            
            <div class="mereq">
                <div class="title">Requests for you...</div>
                <?php $result=mysql_query($qry,$con);
                for($i=0;$i<mysql_num_rows($result);$i++){
                    
                    $row=  mysql_fetch_assoc($result);?>            
                        <div class="mreq  mereq<?=$i%2?>">
                            <div class="sec1">
                            <div class="projt">
                                <?php
                                    $pid=$row['id'];
                                    $q="select * from project where id='$pid'";
                                    $r=mysql_query($q);
                                    $ro=  mysql_fetch_assoc($r);
                                    $ptitle=$ro['title'];
                                    echo '<a href="explore_show.php?pid='.$pid.'" target="_blank">'.$ptitle.'</a>';
                                ?>
                            </div>
                            <div class="projpos">
                                <?php echo $row['req']; ?>
                            </div>
                            </div>
                            <div class="butt">
                                <div class="accept"><button class="buttons hov acc res" id='accept_<?=$usr?>_<?=$pid?>_<?=$row['req']?>'>Accept</button><span class="accreq"></span></div>
                                <div class="reject"><button class="buttons hov rej res" id='reject_<?=$usr?>_<?=$pid?>_<?=$row['req']?>'>Reject</button><span class="rejreq"></span></div>
                            </div>
                        </div>
             <?php   }?>
            </div>                      
            <?php } ?>
            
            <br><br><br>
            
           <?php if(mysql_num_rows($result3)>0){ ?>
            
            <div class="mereq">
                <div class="title">Requests for your projects...</div>
                <?php $result3=mysql_query($qry3,$con);
                for($i=0;$i<mysql_num_rows($result3);$i++){
                    
                    $row3=  mysql_fetch_assoc($result3);?>            
                        <div class="mreq  mereq<?=$i%2?>">
                            <div class="sec1">
                            <div class="projt">
                                <?php
                                    $pid=$row3['req'];
                                    $q="select * from project where id='$pid'";
                                    $r=mysql_query($q,$con);
                                    $ro=  mysql_fetch_assoc($r);
                                    $ptitle=$ro['title'];
                                    echo $ptitle.' | '.$row3['forr'];
                                ?>
                            </div>
                            <div class="projpos">
                                
                                <?php echo '<a href="profile_show.php?usrid='.$row3['id'].'" target="_blank">'.$row3['id'].'</a>' ;  ?>
                                
                            </div>
                            </div>
                            <div class="butt">
                                <div class="accept"><button class="buttons hov acc reqp" id='accept_<?=$pid?>_<?=$row3['id']?>_<?=$row3['forr']?>'>Accept</button><span class="accreq"></span></div>
                                <div class="reject"><button class="buttons hov rej reqp" id='reject_<?=$pid?>_<?=$row3['id']?>_<?=$row3['forr']?>'>Reject</button><span class="rejreq"></span></div>
                            </div>
                        </div>
             <?php   }?>
            </div>                      
            <?php } ?> 
            
            
            <br><br><br>
            
            <?php if(mysql_num_rows($result1)>0){ ?>
            
            <div class="mereq">
                <div class="title">Requests sent by you...<div class="cleanup" id="<?=$usr?>">Clear</div></div>
                <?php $result1=mysql_query($qry1,$con);
                for($i=0;$i<mysql_num_rows($result1);$i++){
                    
                    $row1=  mysql_fetch_assoc($result1);?>            
                        <div class="mreq  mereq<?=$i%2?>">
                            <div class="sec1">
                            <div class="projt">
                                <?php
                                    $pid=$row1['req'];
                                    $q="select * from project where id='$pid'";
                                    $r=mysql_query($q,$con);
                                    $ro=  mysql_fetch_assoc($r);
                                    $ptitle=$ro['title'];
                                    echo $ptitle;
                                ?>
                            </div>
                            <div class="projpos">
                                <?php echo $row1['forr']; ?>
                            </div>
                            </div>
                            <div class="butt">                               
                                   <?php if($row1['status']=='accepted'){ ?>
                                   <img src="images/accept.png" />
                                   <span class="accepted">Accepted</span>                                          
                                <?php }?>
                                   <?php if($row1['status']=='rejected'){ ?>
                                   <img src="images/reject.png" />
                                   <span class="rejected">Rejected</span>                                          
                                <?php }?>
                            </div>
                        </div>
             <?php   }?>
            </div>                      
            <?php } ?> 
        </div>
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
