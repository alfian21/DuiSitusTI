function showInsertDiv() {
	document.getElementById('divInsert').style.display = "block";
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("insert").innerHTML=this.responseText;
		}
	}
	xmlhttp.open("GET","jeroan/d.lulusaninsert.php",true);
	xmlhttp.send();	
}

function hideInsertDiv() {
	document.getElementById('divInsert').style.display = "none";
}
function showUpdateDiv(str) {
	document.getElementById('divUpdate').style.display = "block";
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("update").innerHTML=this.responseText;
		}
	}
	xmlhttp.open("GET","jeroan/d.lulusanedit.php?ID="+str,true);
	xmlhttp.send();
}
function hideUpdateDiv() {
	document.getElementById('divUpdate').style.display = "none";
}

function showDeleteDiv(str) {
	document.getElementById('divDelete').style.display = "block";
		if (str=="") {
		document.getElementById("delete").innerHTML="";
		return;
	} 
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("delete").innerHTML=this.responseText;
		}
	}
	xmlhttp.open("GET","jeroan/d.lulusandelete.php?ID="+str,true);
	xmlhttp.send();
}
function hideDeleteDiv() {
	document.getElementById('divDelete').style.display = "none";
}