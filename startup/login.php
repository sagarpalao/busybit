<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Start Up | Login</title>
        <link rel="stylesheet" href="style/common.css" type="text/css" />
        <link rel="stylesheet" href="style/login.css" type="text/css" />
        <script type="text/javascript">
            function loadlogin(){
                //alert("Working.");
                document.getElementById("signin").className='';
                document.getElementById("login").className='active';
                document.getElementById("explore").className='';
                document.getElementById("start").className='';
                document.getElementById("search").className='';
                //alert("Working.");     
            }
        </script>
    </head>
    <?php
        session_start();
        
        if(isset($_SESSION['loggedin'])){
            unset($_SESSION['loggedin']);
            unset($_SESSION['creator']);
            header("location: index.php");
        }
        $showerror=0;          
        if(isset($_POST['submit'])){
            $usrid=$_POST['txtusrid'];
            $pass=$_POST['txtpass'];
            
            include('sqlconnect.php');
            $qry="select * from profile where user_id='$usrid' and password='$pass'";
            @$result=mysql_query($qry,$con);
            $numres=  mysql_num_rows($result);
            
            if($numres!=1){
                $showerror=1;
            }
            else{
                $showerror=0;
                $_SESSION['loggedin']=true;
                $_SESSION['creator']=$usrid;
                header("location: index.php");
            }
        }
    ?>
    <body onload="loadlogin();">
        <?php
            include('header.php');
        ?>
        <div class="login">
            <div class="login-frm">
                <h1>Login...</h1>
                <form name="frmlogin" method="post" action="login.php">
                    <div class="label">
                        <label for="txtusrid">User ID</label>
                    </div>
                    <div class="ele">
                        <input type="text" name="txtusrid" id="txtusrid"></input>
                    </div>
                    <div class="label">
                        <label for="txtpass">Password</label>
                    </div>
                    <div class="ele">
                        <input type="password" name="txtpass" id="txtpass"></input>
                    </div>
                    <div class="error">
                        <span class="errormsg">
                            <?php
                                if($showerror==1){
                                    echo 'Invalid User ID or Psssword !';
                                }
                            ?>
                        </span>
                    </div>
                    <div class="ele">
                        <input type="submit" name="submit" id="submit" value="Login..."></input>
                    </div>
                </form>
            </div>
        </div>
        <?php
            include('footer.php');
        ?>
    </body>
</html>
