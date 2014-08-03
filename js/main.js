
var _URL = window.URL || window.webkitURL;
function validateform(){
var x = document.forms["commentform"]["comment"].value;
    if (x == null || x.trim() == "") {
       $('.errmsgcaption').html("Kindly enter Caption");
        return false;
    }
	else{
		$('#opaque').show();
	}
}
function validatephotoform(){
var x = document.forms["photoform"]["file"].value;
    if (x == null || x == "") {
        $('.errormsg').html("Select the selfie to be uploaded");
        return false;
    }
	else{
		$('.errmsgcaption').html('');
		$('#opaque').show();
		
	}
}
function fileonchange(obj){
document.getElementById('file_url').innerHTML = '';
var k =[];
if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(obj.value)){	
		k=obj.value;
		
		document.getElementById('file_url').innerHTML = obj.value;
}
else{

obj.value = '';
alert("Kindly upload only gif,jpg,jpeg,png file");
}
}


$("#id_file").change(function(e) {
    var file, img;
	k=this.value.split("\\");
		document.getElementById('file_url').innerHTML = k[k.length-1];
		$('.errormsg').html('');
	

    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
		
			if( this.width < 500 || this.height < 500 ){
               $('.errormsg').html("Please upload image of higher dimension");
			   document.getElementById('file_url').innerHTML='';
			   $('#id_file').val('');
			   return false;
			}
			else if(file.size > 3145728){
				 $('.errormsg').html("Please upload image less than 3MB");
				document.getElementById('file_url').innerHTML='';
				$('#id_file').val('');				   
				return false;
			}
			/*if(Math.abs(this.width-this.height)>10 ){
				alert("Please upload a square image");
				document.getElementById('file_url').innerHTML='';
				$('#id_file').val('');
				return false;
			}*/
        };
        img.onerror = function() {
            $('.errormsg').html( "not a valid file: " + file.type);
				document.getElementById('file_url').innerHTML='';
				$('#id_file').val('');
				return false;
        };
        img.src = _URL.createObjectURL(file);
		

    }
	$('.errormsg').html('');
});


$('.popup').on('click',function(){

$( "#"+$(this).data('href')).dialog({ width: '800',height:'450', resizable: false,

modal: true });

});

$(document).ready(function(){
try{$("html, body").animate({scrollTop:0},1000);}catch(ex){}

});

$(document).on('click','.cls_share',function(){
	var o = {};
		o.feedObj = {
			message: $('#id_msg').val(),
			name: '#ATableFor',
			link: SC.CANVASURL+"vote.php?pk="+$('#id_msg').data('pk'),
			picture: 'https:'+SC.BASEURL+$('#id_msg').data('img'),
			caption: "#ATableFor "+$('#id_msg').data('cmt'),		
			description: "'#ATableFor' is a unique contest by American Express. Check out your friend's entry, vote for it, and make it win"
		};
		o.path = '/me/feed/';
		$('#thanku').dialog({modal:true,close: function(ev, ui) { $('#thanku').html('Processing...'); }});
		//$('#opaque').show();
		FB.api(o.path,'POST',o.feedObj,function(response){
			
			try{
				if (!response || response.error) {
					$('#thanku').html('Oops some Error occured. Kindly try again later');
				} else {
					$('#thanku').html('We have shared your entry on your timeline. All the best!');
				}
				
				
			}catch(ee){
				
			}
			
			/*
			
				//console.log(arguments);
				//$('#opaque').hide();
				alert('We have shared your entry on your timeline. All the best!');
			
			if(r != void 0){
				//debug('fbShare'+ o.path , r);
				//cb(r);
			}else{
				//debug(arguments);
			}*/
		});	
});