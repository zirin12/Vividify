
function i(){
	document.getElementById("change").className = document.getElementById("change").className.replace( /(?:^|\s)idle(?!\S)/g , '' );	
    document.getElementById("c").className = document.getElementById("c").className.replace( /(?:^|\s)idle(?!\S)/g , '' );
	document.getElementById("change").className = document.getElementById("change").className.replace( /(?:^|\s)working(?!\S)/g , '' );	
    document.getElementById("c").className = document.getElementById("c").className.replace( /(?:^|\s)working(?!\S)/g , '' );
	document.getElementById("change").className = document.getElementById("change").className.replace( /(?:^|\s)loading(?!\S)/g , '' );	
    document.getElementById("c").className = document.getElementById("c").className.replace( /(?:^|\s)loading(?!\S)/g , '' );

	document.getElementById("change").className += " listening";
	document.getElementById("c").className += " listening";
}
/*
if(str!=' ')*/{
	 function li(){
	document.getElementById("change").className = document.getElementById("change").className.replace( /(?:^|\s)listening(?!\S)/g , '' );	
    document.getElementById("c").className = document.getElementById("c").className.replace( /(?:^|\s)listening(?!\S)/g , '' );
	document.getElementById("change").className = document.getElementById("change").className.replace( /(?:^|\s)idle(?!\S)/g , '' );	
    document.getElementById("c").className = document.getElementById("c").className.replace( /(?:^|\s)idle(?!\S)/g , '' );
	document.getElementById("change").className = document.getElementById("change").className.replace( /(?:^|\s)working(?!\S)/g , '' );	
    document.getElementById("c").className = document.getElementById("c").className.replace( /(?:^|\s)working(?!\S)/g , '' );

	document.getElementById("change").className += " loading";
	document.getElementById("c").className += " loading";
}
 }