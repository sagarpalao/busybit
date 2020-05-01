/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var imgcount=0;
var arr;
function loadsignin(){
    //alert("Working.");
                document.getElementById("signin").className='active';
                document.getElementById("login").className='';
                document.getElementById("explore").className='';
                document.getElementById("start").className='';
                //alert("Working.");
                load();
}
function loadlogin(){
    alert("Working.");
                document.getElementById("signin").className='';
                document.getElementById("login").className='active';
                document.getElementById("explore").className='';
                document.getElementById("start").className='';
                //alert("Working.");
                
}
function load(){        
        var total=6;
        arr=new Array(6);
        for(i=0;i<6;i++){
                arr[i]=document.getElementById("img"+(i+1));
        }
        arr[0].style.visibility="visible";
}

function slide(x){
        imgcount=imgcount+x;
        if(imgcount > 5){imgcount=0;}
        if(imgcount < 0){imgcount=5;}
        for(i=0;i<6;i++){
                arr[i].style.opacity="0";
                arr[i].style.visibility="hidden";
        }
        arr[imgcount].style.visibility="visible";
        arr[imgcount].style.opacity="1";
}

window.setInterval(function slideA(){
        imgcount=imgcount+1;
        if(imgcount > 5){imgcount=0;}
        if(imgcount < 0){imgcount=5;}
        for(i=0;i<6;i++){
                arr[i].style.opacity="0";
                arr[i].style.visibility="hidden";
        }
        arr[imgcount].style.visibility="visible";
        arr[imgcount].style.opacity="1";
},4000);


