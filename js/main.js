
var _URL = window.URL || window.webkitURL;
function validateform(){
var x = document.forms["commentform"]["comment"].value;
    if (x == null || x == "") {
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
	
		document.getElementById('file_url').innerHTML = this.value;
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

$( "#"+$(this).data('href')).dialog({ width: '550',height:'700', resizable: false,

modal: true });

});

$(document).ready(function(){
try{$("html, body").animate({scrollTop:0},1000);}catch(ex){}

});

$(document).on('click','.cls_share',function(){
	var o = {};
		o.feedObj = {
			message: $('#id_msg').val(),
			name: 'A Table For',
			link: SC.CANVASURL+"vote.php?pk="+$('#id_msg').data('pk'),
			picture: 'https:'+SC.BASEURL+$('#id_msg').data('img'),
			caption: "A Table For "+$('#id_msg').data('cmt'),		
			description: "'A Table For' is a unique contest by American Express. Check out your friend's entry, vote for it, and make it win"
		};
		o.path = '/me/feed/';
		$('#opaque').show();
		FB.api(o.path,'POST',o.feedObj,function(response){
			
			try{
				if (!response || response.error) {
					alert('Oops some Error occured. Kindly try again later');
				} else {
					alert('We have shared your entry on your timeline. All the best!');
				}
				$('#opaque').hide();
			}catch(ee){
				$('#opaque').hide();
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