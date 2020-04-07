var word_list=[];
function arr(){
			var start = document.getElementById("src").value;
			var end = document.getElementById("des").value;
			word_list.push(start);
			word_list.push(end);

}


function check_if_present()
{
	
	
	//alert(src);
	//alert(dest);
	if(word_graph[word_list[word_list.length-2]].indexOf(document.getElementById('inter').value)!=-1)//do true vaildation
	{//insert inbetween
		word_list.splice(word_list.length-1, 0,document.getElementById('inter').value);
		
	}
	else
	{
		alert("invalid word");
		return -1;
	}	
}

function checkIfEqual(arr1, arr2) {
  if (arr1.length != arr2.length) {
    return false;
  }
  //sort them first, then join them and just compare the strings
  return arr1.sort().join() == arr2.sort().join();
}


function showDifficulty()
{

	var len=transformWord(word_graph,document.getElementById('src').value,document.getElementById('des').value).length;
	if(len==0){
		document.getElementById("difficulty").innerHTML="NO PATH EXISTS..!!";
		return;
		}
	if(len==2)
	{
		document.getElementById("difficulty").innerHTML="NO POINT IN PLAYING THE GAME!!!!";
	}
	else
	{
	if(len>2&&len<5)
			{				
				document.getElementById("difficulty").innerHTML="EASY!!";
		document.getElementById("rate").innerHTML="🌑 🌕 🌕 🌕 🌕";	

			}
			else if(len>=5&&len<10)
			{
					
					document.getElementById("difficulty").innerHTML="MODERATE";
					document.getElementById("rate").innerHTML="⚫️ ⚫️ ⚪️ ⚪️ ⚪️ ";					
					
			}
			else if(len>=11&&len<15)
			{
					
					document.getElementById("difficulty").innerHTML="DIFFICULT";
					document.getElementById("rate").innerHTML="⚫️ ⚫️ ⚫️ ⚪️ ⚪️ ";
			}
			else 
			{
					
					document.getElementById("difficulty").innerHTML="SUPER DIFFICULT";
					document.getElementById("rate").innerHTML="⚫️ ⚫️ ⚫️ ⚫️ ⚪️ ";

			}
			
	}
}