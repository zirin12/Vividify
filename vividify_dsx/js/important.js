//global varibles
var clue;
var dfh=0;//distance from here varibles

//global varibles end
	function x1(){
	editdistance(word_graph,document.getElementById('inter').value,document.getElementById('des').value);
	}
	function x2()
	{
	if(editdistance(word_graph,document.getElementById('inter').value,document.getElementById('des').value)==1)
	{
	points(word_graph,document.getElementById('src').value,document.getElementById('des').value);
	}
	}
	function x3()
	{
	alert('started');
	nextClue(word_graph,document.getElementById('inter').value,document.getElementById('des').value);
	}
	function x4()
	{
	insert();document.getElementById('inter').value='';
	}
	function x5()
	{
	transformWord(word_graph,document.getElementById('src').value,document.getElementById('des').value);
	}
	function transformWord(word_graph,start,goal)
	{
	
	var paths=[[start]];
	var extended=new Set();
	while(paths.length!=0)
	{
		var currentPath=paths.shift();
		var currentWord=currentPath[currentPath.length-1];
		if(currentWord==goal)
		{
			alert(currentPath);
			return(currentPath);
		}
		else
		{
			if(extended.has(currentWord)==true)
			{
				continue;
			}
		}
		extended.add(currentWord);
		var transforms=word_graph[currentWord];
		//alert("shata");
		//alert(transforms)
		for(word in transforms)
		{
			if(currentPath.indexOf(transforms[word])==-1)
			{
				paths.push(currentPath.slice(0,currentPath.length).concat([transforms[word]]));
			}
		}
	}
	var empty=[];
	alert("no path");
	return(empty);
 }
function nextClue(word_graph,currword,goal)
{
alert("inside!!");
	var nextpath=transformWord(word_graph,currword,goal);
	alert(nextpath[1]);
	clue=nextpath[1];
	return nextpath[1];
}
function showClue(){
	alert(clue);
}

function editdistance(word_graph,currword,goal)
{	
	alert("inside edit distance");
	var nextpath=transformWord(word_graph,currword,goal);
	alert(nextpath.length-1);
	dfh=(nextpath.length-1);
	return(nextpath.length-1);
}
function showED(){
	alert(dfh);
}
//can be used only 5 times on clicking next clue 
//points if timer gets over and he doesnt have the full path then show his answer and expected else show points with this

function points(word_graph,start,goal)
{

var points=0;
var origpath=transformWord(word_graph,start,goal);
if(word_list.length>origpath.length)
{
points+=100*(word_list.length-origpath.length);
}
else
{
points+=200;
}
document.getElementById("points").innerHTML=points;
return points;
}
//for inserting as list
function insert()
{
var sourceli=document.getElementById("1");
var destinationli=document.getElementById("2");
var source=document.getElementById("src");
var destination=document.getElementById("des");
sourceli.innerHTML=source.value;
destinationli.innerHTML=destination.value;
var intervalue=document.getElementById("inter").value;
var item=document.createElement("li");
item.innerHTML=intervalue;
var word_list=document.getElementById("insert");
word_list.appendChild(item);
}