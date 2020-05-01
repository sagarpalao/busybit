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
<?php
            $design=$_GET['mem'];
            $title=$_GET['title'];
            $creator=$_SESSION['creator'];
            include 'sqlconnect.php';
            
            $qry="select * from profile_keystone where keystone='$design' and user_id<>'$creator'";
            $result=  mysql_query($qry,$con);
            
            $usrid=array();
            for($i=0;$i<mysql_num_rows($result);$i++){
                $row=  mysql_fetch_assoc($result);
                $usrid[$i]=$row['user_id'];
            }
            
            
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="script/jquery-2.1.4.js"></script>
        <script>
            $(document).ready(function(){
                $('.reqbtn').click(function(){
                    var design='<?php echo $design; ?>';
                    var title='<?php echo $title; ?>';
                    var usrid=$(this).attr('id');
                    
                    $.ajax({
                      method:'POST',
                      data:{'design':design,
                            'title':title,
                            'usrid':usrid
                            },
                      url:'addusrreq.php',
                      success:function(data){
                          //alert(data);
                          $('#'+usrid).attr('disabled','disabled');
                          $('#'+usrid).next().html('Request Sent !');
                          $('#'+usrid).css({
                                                "background-color":"#616161",                                                
                           });
                           $('#'+usrid).removeClass('hoverbtn');
                      }                     
                  });
                });
            });
        </script>
        <style>
            .mem{
                width:100%;
                padding:2%;
            }
            .mem1{
                background-color:#EEEEEE;
                border-left: 5px solid #e74c3c;
            }
            .mem0{
                background-color: #bdc3c7;
                border-left: 5px solid #8e44ad;
            }
            .usrid{
                width: 60%;
                display:inline-block;
                font-size:20pt;
                 //outline: 5px red solid;
            }
            .usrid a{
                text-decoration: none;
                color:#000000;
            }
            .request{
                width:38%;
                display:inline-block;
                //outline: 5px red solid;
            }
            .reqbtn{
                //float:right;
                width:200px;
                height: 50px;
                margin-top:2%;
                margin-bottom:2%;
                background-color: #43A047;
                color:white;
                font-size: 20pt;
                margin-right:5%;
            }
            .hoverbtn:hover{
                transform: scale(0.98);
                transition: scale 0.1s ease;
            }
            .msgsent{
                font-size:18pt;
                font-weight:bold;
                color:#43A047;
                //outline: 1px red solid;
            }
        </style>
    </head>
    <body>
        
        <?php for($i=0;$i<mysql_num_rows($result);$i++){?> 
        <div class="mem mem<?=$i%2?>">
            <div class="usrid">
                <a href="profile_show.php?usrid=<?=$usrid[$i]?>" target="_blank"><?=$usrid[$i]?></a>
            </div>
            <div class="request">
                <button class="reqbtn hoverbtn" id="<?=$usrid[$i]?>" >Send Request</button>
                <span class="msgsent"></span>
            </div>
        </div>
        <?php } ?>
    </body>
</html>
