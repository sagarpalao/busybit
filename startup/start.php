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
        <link rel="stylesheet" href="style/common.css" />
        <link rel="stylesheet" href="style/start_create.css" />
        <script>
            var cnt=2;
            function load(){
                document.getElementById("signin").className='';
                document.getElementById("login").className='';
                document.getElementById("explore").className='';
                document.getElementById("start").className='active';
                document.getElementById("search").className='';
            }
            function getFile(){
                document.getElementById("img_cover").click();
            }
            function getFile2(i){
                document.getElementById("card"+i+"_image").click();
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
            function readURL2(input,i) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('prevImage'+i).src=e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                    document.getElementsByName('txt_c'+i+'_desc')[0].focus();
                }
            } 
            function getcnt(){
                document.getElementById('hid').value=cnt;
                return true;
            }
        </script>
        <link rel="stylesheet" href="script/jquery-ui-1.11.4/jquery-ui.css">
        
        
        <script src="script/jquery-2.1.4.js"></script>
        <script src="script/jquery-ui-1.11.4/jquery-ui.js"></script>
        <script>
        
        $(function() {
            $( "#accordion" ).accordion({
            heightStyle: "content"
            });
        });
        
        $('document').ready(function(){
        $('.addcard').click( function() {
            var newDiv = '<h3>Card '+cnt+'</h3>'+
                        '<div>'+
                           ' <div class="entity">'+
                           '     <div class="label">'+
                           '         <label for="txt_c'+cnt+'_title">Card Title<span class="compulsary">*</span></label>'+
                           '     </div>'+
                           '     <div class="ele">'+
                           '         <input type="text" name="txt_c'+cnt+'_title" placeholder="Your Card Title" required />'+
                           '     </div>'+
                           ' </div>'+
                           ' <div class="entity-1">'+
                           '     <div class="label">'+
                           '         <label for="img_proj">Card Image</label>'+
                           '     </div>'+
                           '     <div class="ele">'+
                           '         <button class="upload-btn" onclick="getFile2('+cnt+');">Upload Image</button>'+
                           '         <div style="height: 0px;width: 0px; overflow:hidden;"><input id="card'+cnt+'_image" name="card'+cnt+'_image" type="file" accept="image/*" onchange="readURL2(this,'+cnt+');" required  /></div>'+
                           '         <img id="prevImage'+cnt+'" class="prevImage2">'+
                           '         </img>'+
                           '     </div>'+
                           ' </div>'+
                           ' <div class="entity-2">'+
                                '<div class="label">'+
                                    '<label for="txt_c'+cnt+'_desc">Description<span class="compulsary">*</span></label>'+
                                '</div>'+
                                '<div class="ele">'+
                                    '<textarea name="txt_c'+cnt+'_desc" placeholder="Your Card Description" rows="15" required /></textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $('#accordion').append(newDiv);
            $('#accordion').accordion("refresh");
            $('.container').height($('.container').height()+100);
            cnt++;
        });
        });
  </script>
  
  <link rel="stylesheet" type="text/css" href="script/jquery.appendGrid-1.6.0.css" />
  <script type="text/javascript" src="script/jquery.appendGrid-1.6.0.js"></script>
      
<script id="jsSource" type="text/javascript">
$(function () {
    // Initialize appendGrid
    $('#tblAppendGrid').appendGrid({
        caption: 'My Team...',
        initRows: 1,
        columns: [
            { name: 'member', display: 'Member Title', type: 'text', ctrlAttr: { maxlength: 100,required:'required' }, ctrlCss: { width: '98%'} },
            { name: 'qty', display: 'No. of Members', type: 'number', ctrlCss: { width: '98%',required:'required'} },
            { name: 'desc', display: 'Description', type: 'textarea', ctrlAttr: { rows:5,required:'required' }, ctrlCss: { width: '98%'} },
            { name: 'RecordId', type: 'hidden', value: 0 }
        ]
    });
});
    

</script>
        <title>Start</title>
    </head>
    
    <?php  
        include('sqlconnect.php');     
        if(isset($_POST['submit'])){           
            $title=$_POST['txttitle'];
            $blurb=$_POST['txtblurb'];
            $cat=$_POST['cat'];
            $city=$_POST['txtcity'];
            $price=$_POST['txtprice'];
            $creator=$_SESSION['creator']; 
            
            $qry="select * from project where creator='$creator'";
            $result=mysql_query($qry,$con);
            $projcnt=  mysql_num_rows($result)+1;
            $pid=$creator.$projcnt;
            $default=0;
            
            //echo $title.$blurb.$cat.$city.$price.$creator;
            if(!empty($_FILES['img_cover']['tmp_name'])){
                $uploadDir="./upload_images/";
                $_FILES['img_cover']['name']='cover_'.$pid.'.'.(explode('.',$_FILES['img_cover']['name'])[1]);
                move_uploaded_file($_FILES['img_cover']['tmp_name'], $uploadDir.$_FILES['img_cover']['name']);
                $image='cover_'.$pid.'.'.(explode('.',$_FILES['img_cover']['name'])[1]);
            }        
            
            //echo '<br>'.$pid;
            $qry="insert into project values('$pid','$cat','$title','$creator','$default')";
            $result=mysql_query($qry,$con);
            $qry="insert into project_desc values('$pid','$image','$blurb','$city','$price')";
            $result=mysql_query($qry,$con);      
            $cnt=$_POST['cnt']-1;
            //echo $cnt;
            for($i=1;$i<=$cnt;$i++){        
                $ctitle=$_POST['txt_c'.$i.'_title'];
                $cdesc=$_POST['txt_c'.$i.'_desc'];
                
                if(!empty($_FILES['card'.$i.'_image']['tmp_name'])){
                    $uploadDir="./upload_images/";
                    $_FILES['card'.$i.'_image']['name']='card'.$i.$pid.'.'.(explode('.',$_FILES['card'.$i.'_image']['name'])[1]);
                    move_uploaded_file($_FILES['card'.$i.'_image']['tmp_name'], $uploadDir.$_FILES['card'.$i.'_image']['name']);
                    $image1='card'.$i.$pid.'.'.(explode('.',$_FILES['card'.$i.'_image']['name'])[1]);
                    
                    $qry="insert into proj_cards values('$pid','$i','$ctitle','$image1','$cdesc')";
                    $result=mysql_query($qry,$con);
                }
              
            }          
            for($i=1;$i<=25;$i++){ 
                if(isset($_POST['tblAppendGrid_member_'.$i])){
                    $mem=$_POST['tblAppendGrid_member_'.$i];
                    $qty=$_POST['tblAppendGrid_qty_'.$i];
                    $desc=$_POST['tblAppendGrid_desc_'.$i];
                    $default=0;
                    
                    $qry="insert into proj_team values('$pid','$mem','$qty','$desc','$default')";
                    $result=mysql_query($qry,$con);  
                    
                }
            } 
        }
    ?>
      
    <body onload="load();">
        <?php
            include 'header.php';
        ?>
        <div class="container">
        <form action="start.php" enctype="multipart/form-data" method="post" name="frmproj">
            <div class="entity">
                <div class="label">
                    <label for="txttitle">Title<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="text" name="txttitle" id="txtname" placeholder="Your project title" required />
                </div>
            </div>
            <div class="entity">
                <div class="label">
                    <label for="txtblurb">Blurb<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <textarea name="txtblurb" rows="3" placeholder="Abstract about your project" required></textarea>
                </div>
            </div>
            <div class="entity">
                <div class="label">
                    <label for="img_proj">Project Cover Image<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <button class="upload-btn" onclick="getFile()">Upload Image</button>
                    <div style="height: 0px;width: 0px; overflow:hidden;"><input id="img_cover" name="img_cover" type="file" accept="image/*" onchange="readURL(this);" /></div>
                    <div class="get-height">
                    <img id="prevImage" >
                    </img></div>
                </div>
            </div>
            <div class="entity">
                <div class="label">
                    <label for="cat">Category<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <select name="cat" id="cat" placeholder="Your project category" required >
                        <option value="computer">Computer</option>
                        <option value="electronics">Electronics</option>
                        <option value="iot">Internet Of Things</option>
                        <option value="robotics">Robotics</option>
                        <option value="ai">Artificial Intelligence</option>
                        <option value="others" selected="selected">Others</option>
                    </select>    
                </div>
            </div>
            <div class="entity">
                <div class="label">
                    <label for="txtcity">City<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="text" name="txtcity" id="txtcity" placeholder="Your city" required />    
                </div>
            </div>
            <div class="entity">
                <div class="label">
                    <label for="txtprice">Estimated Cost<span class="compulsary">*</span></label>
                </div>
                <div class="ele">
                    <input type="number" name="txtprice" id="txtprice" placeholder="Your project's estimated cost" required />
                </div>
            </div>
            
            <div class="entity">
                <div class="label">
                    <label for="cards">Add Cards to your project<span class="compulsary">*</span></label>
                </div>
                <div class="ele">                  
                    <div id="accordion">
                        <h3>Card 1</h3>
                        <div>
                            <div class="entity">
                                <div class="label">
                                    <label for="txt_c1_title">Card Title<span class="compulsary">*</span></label>
                                </div>
                                <div class="ele">
                                    <input type="text" name="txt_c1_title" placeholder="Your Card Title" required />
                                </div>
                            </div>
                            <div class="entity-1">
                                <div class="label">
                                    <label for="img_proj">Card Image</label>
                                </div>
                                <div class="ele">
                                    <button class="upload-btn" onclick="getFile2(1);">Upload Image</button>
                                    <div style="height: 0px;width: 0px; overflow:hidden;"><input id="card1_image" name="card1_image" type="file" accept="image/*" onchange="readURL2(this,1);" required /></div>
                                    <img id="prevImage1" name="prevImage1" class="prevImage2">
                                    </img>
                                </div>
                            </div>
                            <div class="entity-2">
                                <div class="label">
                                    <label for="txt_c1_desc">Description<span class="compulsary">*</span></label>
                                </div>
                                <div class="ele">
                                    <textarea name="txt_c1_desc" placeholder="Your Card Description" rows="15" required /></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="entity">
                <div class="ele">
                    <div class="addcard"><span class="plus">+</span></div>
                </div>
            </div>
            <div class="entity">
                <div class="label new-line">
                    <label for="team">Your Dream Team...<span class="compulsary">*</span></label>
                </div>
                <div class="ele scrollable">
                    <table  id="tblAppendGrid">
                    </table>
                </div>
            </div>
            <div class="entity">
                <div class="ele">
                    <input type="submit" class="submit" onclick="return(getcnt());" value="Create My Dream Project..." name="submit"/>
                </div>
            </div>
            <input type="hidden" value="" name="cnt" id="hid" />
        </form>
        </div>
        <?php
            include('footer.php');
        ?>
    </body>
</html>
