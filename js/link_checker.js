// JavaScript Document
var xmlhttp
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	 try {
	  xmlhttp = new XMLHttpRequest();
	 } catch (e) {
	  xmlhttp=false
	 }
	}
	function myXMLHttpRequest() {
	  var xmlhttplocal;
	  try {
	    xmlhttplocal= new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttplocal= new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	    xmlhttplocal=false;
	  }
	 }

	if (!xmlhttplocal && typeof XMLHttpRequest!='undefined') {
	 try {
	  var xmlhttplocal = new XMLHttpRequest();
	 } catch (e) {
	  var xmlhttplocal=false;
	  alert('couldn\'t create xmlhttp object');
	 }
	}
	return(xmlhttplocal);
}

function iRedlofCheckLinks()
{
	var time= new Date();
	var my=document.getElementById("link_mylink").value;
	var others=document.getElementById("link_others").value;
	var wAddress=document.getElementById("wAddress").value;
	
	document.getElementById("link_status").style.color="#000";
	document.getElementById("link_status").innerHTML="<img src='"+wAddress+"/wp-content/plugins/link_checker/images/indicator.gif' alt='' style='vertical-align:middle;' /> Checking Links, Please Wait, It may take some time depending upon your internet speed ...";
	if(my=="" || others=="")
	{
		document.getElementById('link_status').style.color="RED";	  
        document.getElementById('link_status').innerHTML="Empty Fields.";
	}
	else
	{
		
		var params = 'time='+time.getSeconds()+'&link_my='+my+'&link_others='+others+'&wAddress='+wAddress;
		xmlhttp.open('POST', wAddress + '/wp-content/plugins/link_checker/addon.php');
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");  
		xmlhttp.setRequestHeader("Content-length", params.length);  
		xmlhttp.setRequestHeader("Connection", "close");  
    	xmlhttp.onreadystatechange = iRedlofCheckLinksResponce;
    	xmlhttp.send(params);
	}
}

function iRedlofCheckLinksResponce()
{
	if(xmlhttp.readyState == 4)
	{
		if (xmlhttp.status == 200)
		{
          var response = xmlhttp.responseText;
		  var splitData = new Array();
		  splitData=response.split('|');
		  document.getElementById('link_status').innerHTML=response;
		}
	}
}