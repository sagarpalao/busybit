<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Startup India</title>
        <script src="script/slider.js"></script>
        <link rel="stylesheet" href="style/index_css.css" type="text/css" />
        <link rel="stylesheet" href="style/common.css" type="text/css" />
        <script src="script/jquery-2.1.4.js"></script>
        <script>
            $(document).ready(function(){
                $('.display-proj').load('displayProj.php?category="computer"');
                $('#computer').css({color:"#43A047",'font-weight':'bolder'});
                
                $('#computer').click(function(){
                    
                    $('.display-proj').load('displayProj.php?category="computer"');
                    
                    $('.l1').css({color:"black",'font-weight':'normal'});
                    $('#computer').css({color:"#43A047",'font-weight':'bolder'});
                });
                
                $('#electronics').click(function(){
                    
                    $('.display-proj').load('displayProj.php?category="electronics"');
                    
                    $('.l1').css({color:"black",'font-weight':'normal'});
                    $('#electronics').css({color:"#43A047",'font-weight':'bolder'});
                });
                
                $('#ai').click(function(){
                    
                    $('.display-proj').load('displayProj.php?category="ai"');
                    
                    $('.l1').css({color:"black",'font-weight':'normal'});
                    $('#ai').css({color:"#43A047",'font-weight':'bolder'});
                });
                
                $('#iot').click(function(){
                    
                    $('.display-proj').load('displayProj.php?category="iot"');
                    
                    $('.l1').css({color:"black",'font-weight':'normal'});
                    $('#iot').css({color:"#43A047",'font-weight':'bolder'});
                });
                
                $('#robotics').click(function(){
                    
                    $('.display-proj').load('displayProj.php?category="robotics"');
                    
                    $('.l1').css({color:"black",'font-weight':'normal'});
                    $('#robotics').css({color:"#43A047",'font-weight':'bolder'});
                });
                
                $('#others').click(function(){
                    
                    $('.display-proj').load('displayProj.php?category="others"');
                    
                    $('.l1').css({color:"black",'font-weight':'normal'});
                    $('#others').css({color:"#43A047",'font-weight':'bolder'});
                });
                
                
                
                $('div[data-type="background"]').each(function(){
                    var $bgobj = $(this); // assigning the object

                    $(window).scroll(function() {
                        var yPos = -($(window).scrollTop() / $bgobj.data('speed')); 

                        // Put together our final background position
                        var coords = '50% '+ yPos + 'px';

                        // Move the background
                        $bgobj.css({ backgroundPosition: coords});
                    }); 
                }); 
            });
        </script>    
    </head>
    <?php
        session_start();
        //if(isset($_SESSION['loggedin'])){
        //    $_SESSION['loggedin']=false;
        //}
    ?>
    <body onload="load()" >
       
            <?php
                include('header.php');
            ?>      
            <div class="container">
                <div class="image">
                    <img src="images/img1.jpg" id="img1">
                    <img src="images/img2.jpg" id="img2">
                    <img src="images/img9.jpg" id="img3">
                    <img src="images/img3.jpg" id="img4">
                    <img src="images/img5.jpg" id="img5">
                    <img src="images/img6.jpg" id="img6">
                </div>
                <div class="left"><img  onclick="slide(-1)"  src="images/left.png" class="left-img"></div>
                <div class="right"><img onclick="slide(1)"  src="images/right.png" class="right-img"></div>
            </div>
            <div class="wrapper">
            <div class="content">
            <p class="desc-startup">
                Indian Prime Minister Narendra Modi is known for his speeches and the usual announcement of initiatives which become a major part of his addresses to his countrymen. On the occasion of 69th Independence day of India, he highlighted the resolve of 125 crore Indians. He urged the people of India to &lsquo;Start-up&rsquo; and &lsquo;Stand-up&rsquo;. 
            </p>
            <div class="quote">
                Addressing the nation from the ramparts of the Red Fort, the Prime Minister announced the “Start-Up India” initiative, which would encourage entrepreneurship among the youth of India. He said each of the 1.25 lakh bank branches, should encourage at least one Dalit or Adivasi entrepreneur, and at least one woman entrepreneur.
            </div>
            </div>
            </div>
        
        
            <div class="testimonials" data-type="background" data-speed="5">           
                <h1>Testimonials</h1>
                <section>
                    <img src="images/prof.png">
                    <div class="quote test">
                        This is how i started.<br>A great place to start<br>Build your team and get started.
                    </div>
                </section>
                <section>
                    <img src="images/prof.png">
                    <div class="quote test">
                        A place to start up and stand up.<br>I found my dream team here!<br>Learn and explore at its best.
                    </div>
                </section>
                <section>
                    <img src="images/prof.png">
                    <div class="quote test">
                        From a freelance programmer to a full fledged business owner<br>This is where it started
                    </div>
                </section>
            </div>
        
            <div class="wrapper">
            <h1>Most Liked</h1>
            <div class="liked">
                <div class="display-proj">
                    &nbsp;
                </div>
                <div class="categories">
                    <ul>
                        <li class="l1" id="computer">Computers</li>
                        <li class="l1" id="electronics">Electronics</li>
                        <li class="l1" id="iot">Internet Of Things</li>
                        <li class="l1" id="robotics">Robotics</li>
                        <li class="l1" id="ai">Artificial Intelligence</li>
                        <li class="l1" id="others">Others</li>
                    </ul>
                </div>
            </div>
            
         </div>
            
            
        
         <?php
                include('footer.php');
         ?>
        
    </body>
</html>
