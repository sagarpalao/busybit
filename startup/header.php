<header>
            <div class="logo">
                <a href="index.php"><img src="images/busybit.jpg" /></a>
            </div>
            <div class="navigate">
                <nav>
                    <ul>
                        <?php 
                            if(isset($_SESSION['loggedin'])){
                                include 'sqlconnect.php';
                                $usrid=$_SESSION['creator'];
                                $qrya="select * from profile where user_id='$usrid'";
                                $resulta=mysql_query($qrya,$con);
                                $rowa=  mysql_fetch_assoc($resulta);
                                $name=$rowa['name'];
                                $photo=$rowa['photo'];
                            ?>
                            <li><a href="profile_show.php?usrid=<?=$usrid?>" ><img id="profile" src="upload_images/<?=$photo?>" /></a></li>
                           <?php } ?>
                        <li><a id="login" href="login.php">
                            <?php

                            if(isset($_SESSION['loggedin'])){
                                if($_SESSION['loggedin']==true){
                                    echo 'Log Out';
                                }
                                else{
                                    echo 'Log In';
                                }
                            }
                            else{
                                echo 'Log In';
                            }
                            ?>
                        </a></li>
                        <li><a id="signin" href="signin.php">Sign Up</a></li>
                        <li><a id="start" href="start_disp.php">Start</a></li>
                        <li><a id="explore" onclick="submenu();" href="#">Explore</a>
                            <ul id="sub-menu">
                            <li><a href="explore.php?category=computer">Computer</a></li>
                            <li><a href="explore.php?category=electronics">Electronics</a></li>
                            <li><a href="explore.php?category=iot">IoT</a></li>
                            <li><a href="explore.php?category=robotics">Robotics</a></li>
                            <li><a href="explore.php?category=ai">Artificial Intelligence</a></li>
                            <li><a href="explore.php?category=others">Others</a></li>
                            </ul>
                        </li>    
                        <li><a id="search" href="search.php">Search Team</a></li>
                        <?php 
                            if(isset($_SESSION['loggedin'])){
                                /*include 'sqlconnect.php';
                                $usrid=$_SESSION['creator'];
                                $qry="select * from profile where user_id='$usrid'";
                                $result=mysql_query($qry,$con);
                                $row=  mysql_fetch_assoc($result);
                                $name=$row['name'];
                                $photo=$row['photo'];*/
                                $cnt=0;
                                $qryb="select * from prof_req where usrid='$usrid'";
                                $resultb=mysql_query($qryb,$con);
                                $cnt=$cnt+mysql_num_rows($resultb);
                                //echo $cnt;
                                
                                $qryc="select * from proj_req where id='$usrid' and status<>'unknown'";
                                $resultc=mysql_query($qryc,$con);
                                $cnt=$cnt+mysql_num_rows($resultc);
                                //echo $cnt;
                                               
                                $qryd="select * from project where creator='$usrid'";
                                $resultd=mysql_query($qryd,$con);


                                $projlist=null;
                                for($i=0;$i<mysql_num_rows($resultd);$i++){
                                    $rowd=  mysql_fetch_assoc($resultd);
                                    $proj=$rowd['id'];
                                    $projlist=$projlist.'\''.$proj.'\'';
                                    if($i<mysql_num_rows($resultd)-1){
                                        $projlist=$projlist.',';
                                    }
                                }
                                //echo $projlist;
                                $qrye="select * from proj_req where req in ($projlist) and status='unknown'";
                                $resulte=mysql_query($qrye,$con);
                                $cnt=$cnt+mysql_num_rows($resulte);
                                //echo $cnt;
                                
                                if($cnt>0){
                            ?>
                            <li><a id="notify" href="notify.php"><img src="images/notify3v.jpg" id="notifyimg" /></a></li>
                                <?php }else{ ?>
                            <li><a id="notify" href="notify.php"><img src="images/notify3.png" id="notifyimg" /></a></li>
                                <?php }} ?>
                        
                        
                    </ul>
                </nav>
            </div>
</header>
<script>
        function submenu(){
            
            if(document.getElementById('sub-menu').style.display==="block"){
                //alert('no');
                document.getElementById('sub-menu').style.display="none";
            }
            else{
                //alert('hi');
                document.getElementById('sub-menu').style.display="block";
            }
        }
</script>
