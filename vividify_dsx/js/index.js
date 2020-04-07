var str='' ;
var temp='';
var output;
function startDictation(){
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
 
      var recognition = new webkitSpeechRecognition();
 
      recognition.continuous = false;
      recognition.interimResults = false;
 
      recognition.lang = "en-US";
      recognition.start();
 
      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
								 str=e.results[0][0].transcript;		  //alert(output);
		temp=str;
		recognition.stop();
      };
      recognition.onerror = function(e) {
        recognition.stop();
      }
    }//window.alert(temp);
	j();
	

  }
//--------------
var inc = 0;
var out = 0;
var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789@$%&';
var t;
function a() {
  inc++;	
  if (inc % 7 === 0 && out < str.length) {
    document.getElementById('anim').appendChild(document.createTextNode(str[out]));
    out++;
  } else if (out >= str.length) {
     document.getElementById('shuffle').innerHTML = '';
    removeInterval(t);
  }
   document.getElementById('shuffle').innerHTML =
    chars[Math.floor(Math.random() * chars.length)];
};
function j(){
t = setInterval(a, 10);}
 //document.getElementById('anim').innerHTML = '';//assume for the next trail
 //------------------------------
function hide() {
    var div = document.getElementById('for');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
var source='';
var dest='';
function feed()
{
var res = temp.split(" ");
var i=(temp.indexOf("convert") !== -1);
if(res[0]=="convert"&&res[2]=="to")
{
	//alert('yes');
	source=res[1];
	dest=res[3];
	//alert(source+">"+dest);
}
else{
	//alert('no');
}
//alert(res);
//alert(i);
document.getElementById('src').value=source.toLowerCase();
document.getElementById('des').value=dest.toLowerCase();
var s_temp=document.getElementById('src').value;
var d_temp=document.getElementById('des').value;
document.getElementById('1').innerHTML=s_temp;
document.getElementById('2').innerHTML=d_temp;
//alert('FEED COMPLETED');
}
//---------------------
//Jessie
//---------------------
  function play1(){
       var audio = document.getElementById("welcome");
       audio.play();
  }
 function play2(){
       var a = document.getElementById("j2");
       a.play();
  }
//---------------------
//levensheit distaNCE
//--------------------
