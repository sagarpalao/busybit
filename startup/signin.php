<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign In - Startup</title>
        <link rel="stylesheet" type="text/css" href="style/common.css" />
        <link rel="stylesheet" type="text/css" href="style/signin.css" />
        <script type="text/javascript" src="script/slider.js">            
        </script>
        <script>
            function formvalidate(){
                //alert("Working");
                var i;
                var n=document.frmsignin.keystone.length;
                for(i=0;i<n;i++){
                    if(document.frmsignin.keystone[i].checked){
                        break;
                    }
                }
                if(i==n){
                    alert("Select atleast one keystone");
                    return false;
                }
                var pattern=/^\d{10}$/;
                if(!pattern.test(document.frmsignin.txtcontact.value)){
                    alert("Invalid Contact No.");
                    document.frmsignin.txtcontact.focus();
                    return false;
                }
            }
            function getFile(){
                document.getElementById("fileimg").click();
            }
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('prevImage').src=e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <style>
            .container{
                width: 40%;
                margin-left:0px;
                float:left;
                display:inline;
            }
            footer{
                margin-top:5px;
            }
        </style>
    </head>
    
    <?php
        session_start();
        if(isset($_POST['submit'])){            
            $txtemail=  addslashes($_POST['txtemail']);
            $txtname=$_POST['txtname'];
            $contact=$_POST['txtcontact'];
            $usrid=$_POST['txtusrid'];
            $pass=$_POST['txtpass'];
            $keystone=$_POST['keystone'];
            $profimg=$_FILES['fileimg'];
            $resume=$_FILES['filepdf'];
            $skills=$_POST['skills'];
            
            include('sqlconnect.php');
            if(!empty($_FILES['fileimg']['tmp_name'])){
                
                $uploadDir="./upload_images/";
                $_FILES['fileimg']['name']='profile_'.$usrid.'.'.(explode('.',$_FILES['fileimg']['name'])[1]);
                move_uploaded_file($_FILES['fileimg']['tmp_name'], $uploadDir.$_FILES['fileimg']['name']);
                $image='profile_'.$usrid.'.'.(explode('.',$_FILES['fileimg']['name'])[1]);
                
                $uploadDir="./upload_resumes/";
                $_FILES['filepdf']['name']='resume_'.$usrid.'.'.(explode('.',$_FILES['filepdf']['name'])[1]);
                move_uploaded_file($_FILES['filepdf']['tmp_name'], $uploadDir.$_FILES['filepdf']['name']);
                $file='resume_'.$usrid.'.'.(explode('.',$_FILES['filepdf']['name'])[1]);
                     
                $skills_set=explode(PHP_EOL,$skills);

                for($i=0;$i<count($skills_set);$i++){
                    $qry="insert into profile_skills values('$usrid','$skills_set[$i]')";
                    $result=mysql_query($qry,$con);
                }
               
                foreach($keystone as $val){
                    $qry="insert into profile_keystone values('$usrid','$val')";
                    $result=mysql_query($qry,$con);
                }
                
                $qry="insert into profile values('$usrid','$image','$txtemail','$contact','$file','$txtname','$pass')";
                $result=mysql_query($qry,$con);  
            }
            else{         
                $skills_set=explode(PHP_EOL,$skills);

                for($i=0;$i<count($skills_set);$i++){
                    $qry="insert into profile_skills values('$usrid','$skills_set[$i]')";
                    @$result=mysql_query($qry,$con);
                }
                
                foreach($keystone as $val){
                    $qry="insert into profile_keystone values('$usrid','$val')";
                    @$result=mysql_query($qry,$con);
                }
                             
                @$qry="insert into profile values('$usrid',null,'$txtemail','$contact','$file','$txtname','$pass')";
                @$result=mysql_query($qry,$con);
            }
        }
    ?>
    
    <body onload="loadsignin();">
       
        <?php
            include 'header.php';
        ?>
        <div class="wrapper">
        <div class="container">
                <div class="image">
                    <img src="images/img7.jpg" id="img1">
                    <img src="images/img2.jpg" id="img2">
                    <img src="images/img8.jpg" id="img3">
                    <img src="images/img6.jpg" id="img4">
                    <img src="images/img5.jpg" id="img5">
                    <img src="images/img3.jpg" id="img6">
                </div>
        </div>
        
        <div class="signin-form">
            <h1>Sign Up</h1>
            <form name="frmsignin" method="post" enctype="multipart/form-data" action="signin.php" onsubmit="return(formvalidate());">
                
                <div class="label">
                    <label for="txtname">Name<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="text" name="txtname" id="txtname" placeholder="First Name Last Name" required />
                </div>
                
                <div class="label">
                    <label for="fileimg">Profile Picture</label>
                </div>
                <div class="ele">
                    <button class="upload-btn" onclick="getFile()">Upload Image</button>
                    <div style="height: 0px;width: 0px; overflow:hidden;"><input id="fileimg" name="fileimg" type="file" accept="image/*" onchange="readURL(this);" /></div>
                    <div class="get-height">
                        <img id="prevImage" src="images/no-user.png" >
                    </img></div>
                </div>
                
                <div class="label">
                    <label for="txtemail">Email Id<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="email" name="txtemail" id="txtemail" required/>
                </div>
                
                <div class="label">
                    <label for="txtcontact">Contact No.<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="text" name="txtcontact" id="txtcontact" required/>
                </div>
                
                <div class="label">
                    <label for="filepdf">Resume<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="file" name="filepdf" id="filepdf" accept="application/pdf" required />
                </div>
                
                <div class="label">
                    <label for="txtname">Key Stone<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="checkbox" value="leader" name="keystone[]" id="keystone">Leader</input><br />
                    <input type="checkbox" value="developer" name="keystone[]" id="keystone">Developer</input><br />
                    <input type="checkbox" value="tester" name="keystone[]" id="keystone" >Tester</input><br />
                    <input type="checkbox" value="funder" name="keystone[]" id="keystone">Funder</input><br />
                    <input type="checkbox" value="analyst" name="keystone[]" id="keystone" >Analyst</input><br />
                    <input type="checkbox" value="designer" name="keystone[]" id="keystone" >Designer</input><br />
                </div>
                
                <div class="label">
                    <label for="txtname">Skills Set</label>
                </div>
                <div class="ele">
                    <textarea rows="5" placeholder="Enter each new skill in a new line" name="skills" id="skills"></textarea>
                </div>
                
                <div class="label">
                    <label for="txtusrid">User Id<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="text" name="txtusrid" id="txtusrid" required/>
                </div>
                
                <div class="label">
                    <label for="txtpass">Password<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="password" name="txtpass" id="txtpass" required/>
                </div>
                
                <div class="label">
                    
                </div>
                <div class="ele">
                    <input type="submit" class="submit" value="Sign Up" name="submit"/>
                </div>
            </form>
        </div>
        </div>
        <?php
            include('footer.php');
        ?>
        
    </body>
</html>
