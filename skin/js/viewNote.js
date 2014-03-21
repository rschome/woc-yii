

    function opacity(id, opacStart, opacEnd, millisec) {
  //speed for each frame
  var speed = Math.round(millisec / 100);
  var timer = 0;
  //determine the direction for the blending, if start and end are the same nothing happens
  if(opacStart > opacEnd) {
  for(i = opacStart; i >= opacEnd; i--) {
  setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
  timer++;
  }
  } else if(opacStart < opacEnd) {
  for(i = opacStart; i <= opacEnd; i++)
  {
  setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
  timer++;
  }
  }
}
//change the opacity for different browsers
function changeOpac(opacity, id) {
    var obj = document.getElementById(id);
    if (obj) {
        var s = obj.style;
        s.opacity = (opacity / 100);
        s.MozOpacity = (opacity / 100);
        s.KhtmlOpacity = (opacity / 100);
        s.filter = "alpha(opacity=" + opacity + ")";
        s = null;
    }
}
function shiftOpacity(id, millisec) {
  //if an element is invisible, make it visible, else make it ivisible
  if(document.getElementById(id).style.opacity == 0) {
  opacity(id, 0, 100, millisec);
  } else {
  opacity(id, 100, 0, millisec);
  }
}
function blendimage(divid, imageid, imagefile, millisec) {
  var speed = Math.round(millisec / 100);
  var timer = 0;
  //set the current image as background
  document.getElementById(divid).style.backgroundImage = "url(" + document.getElementById(imageid).src + ")";
  //make image transparent
  changeOpac(0, imageid);
  //make new image
  document.getElementById(imageid).src = imagefile;
  //fade in image
  for(i = 0; i <= 100; i++) {
  setTimeout("changeOpac(" + i + ",'" + imageid + "')",(timer * speed));
  timer++;
  }
}
function currentOpac(id, opacEnd, millisec) {
  //standard opacity is 100
  var currentOpac = 100;
  //if the element has an opacity set, get it
  if(document.getElementById(id).style.opacity < 100) {
  currentOpac = document.getElementById(id).style.opacity * 100;
  }
  //call for the function that changes the opacity
  opacity(id, currentOpac, opacEnd, millisec)
}



var handleSuccess = function(o,i){

	
    if(o.responseText !== undefined){ 

    	var messages = [];
    	
    		try{
    		
    			messages = YAHOO.lang.JSON.parse(o.responseText);
    	
    		}catch(x){
    		 
    			return;
    		}
    
    		var html = "";
    		$.each(messages,function(key,value){
    			$("#content"+o.argument[0]).html(value);
    		});
    }
}

var handleSuccessx = function(o){
	/*
	$("#_site").empty();
	
    if(o.responseText !== undefined){ 

    	var messages = [];
    	
    		try{
    		
    			messages = YAHOO.lang.JSON.parse(o.responseText);
    	
    		}catch(x){
    		 
    			return;
    		}
    	
    		var html = "";
    		$.each(messages[1],function(key,value){
    		/*
    			if(value.sid== messages[0]){
    				$("<option value="+value.sid+" selected>"+value.name+"</option>").appendTo($("#_site"));
    			}else{
    				$("<option value="+value.sid+">"+value.name+"</option>").appendTo($("#_site"));
    			}
    			html = html + "<a href='/ajaxnote/reflush/g_product/"+value.pname+"/g_site/"+value.sid+"'>"+value.name+"</a>";
    			$("#_x").html(html);
    			
    		});
    }*/
}


	 
	var transactionObject = { 

	 
	    success:function(type, args){ 
	
	         

	        if(args[0].responseText !== undefined){ 
	        	
	        	
	        	var messages = [];
	        	
	        		try{
	        		
	        			messages = YAHOO.lang.JSON.parse(args[0].responseText);
	        	
	        		}catch(x){
	        		 
	        			return;
	        		}
	        		var datum = "";
	        		//document.write(”<br><b>还原到原始日期为</b>: “+datum.toLocaleString());
	        		var html = "";
	        		var sTime = "";
	        		var i = 0;
	        		html= '<div style="border:4px solid gray;"><table border="0" width="100px" >';
	        		$.each(messages,function(key,value){

	        			if(i < 2){
	        				sTime = value['created']+"000";
	        				datum = new Date(parseInt(sTime));
	        				html= html+'<tr><td colspan="2"><b>'+datum.toLocaleString()+'&nbsp;|&nbsp;'+value['tname']+'&nbsp;|&nbsp;'+value['uname']+'</b></td></tr><tr><td colspan="2">'+value['descrption']+'</td></tr></table></td></tr>';
	        			}
	        			i++;
	        		
	        			
	        		});
	        		html = html+'</table></div>';
	        		 
	        		var str = "";
	        		str = "#content"+args[0].argument[0];
	        
	        		$(str).html(html);
	        		
	        		
	        		
	        	}	        	
				 
	        } 
	      
	   
	};
var handleFailure = function(o){
	$("#viewNote").html("");
}


function check (url,i){


	var sUrl = url;
	var callback = 
	{
		success: handleSuccess,
		failure: handleFailure,
		customevents:{ 

		onSuccess:transactionObject.success

		}, 
		argument:[i] 
	}

	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
	
}

function addAddress(sUrl){
	
	var data = "?oid="+$('#oid').val()+"&customer_address="+$('#customer_address').val();
	var sUrl = sUrl+data;

	var callback = 
	{
		startEvent:function(){alert(1);},
		complete: addressComplete,
		success: addressSuccess,
		failure: handleFailure
	}
	
	var request = YAHOO.util.Connect.asyncRequest( 'GET', sUrl, callback); 
}

function changeProduct(url){

	var sUrl = url;
	var callBack = 
	{
		success: handleSuccessx,
		failure: handleFailure
	}

	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callBack);
	//window.location="/order/list";

	//$("#changeProduct").submit();
}

function showAdd(id,id1){
	
	document.getElementById(id).style.display="block";
	//document.getElementById(id1).style.display="none";
}

function showEmail(id,id1){
	document.getElementById(id1).style.display="none";
	//document.getElementById(id).style.display="block";
}
var handleSuccessModify = function(o){
	
	if(o.responseText != undefined){
		
		var pay_email = [];
		try{
			pay_email = YAHOO.lang.JSON.parse(o.responseText);
		}catch(e){
			return;
		}
		
		
		$("#email"+pay_email['oid']).html(pay_email['other_email']);
	}
}

function modify(url){

	var sUrl = url;
	var callBack =
	{
		success:handleSuccessModify,
		failure: handleFailure
	}
	
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callBack);
}

var handleSuccessDelete = function(o){
	
	if(o.responseText != undefined){
		
		var s_message = "";
		try{
			s_message = YAHOO.lang.JSON.parse(o.responseText);
		
		}catch(e){
			
			return;
		}
		
		alert(s_message);
		

	}	
	
}
function deleteProduct(url){
	
	var sUrl = url;
	var callBack = 
	{
			success:handleSuccessDelete,
			failure: handleFailure
	}
	
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callBack);
}
