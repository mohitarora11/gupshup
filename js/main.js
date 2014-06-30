
var _URL = window.URL || window.webkitURL;
function validateform(){
var x = document.forms["commentform"]["comment"].value;
    if (x == null || x == "") {
        alert("Kindly enter Caption");
        return false;
    }
}
function validatephotoform(){
var x = document.forms["photoform"]["file"].value;
    if (x == null || x == "") {
        alert("Select the selfie to be uplodaed");
        return false;
    }
}
function fileonchange(obj){
document.getElementById('file_url').innerHTML = '';
if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(obj.value)){	
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
	

    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
		
			if( this.width < 210 || this.height < 210 ){
               alert("Please upload image greater than 210X210");
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
            alert( "not a valid file: " + file.type);
				document.getElementById('file_url').innerHTML='';
				$('#id_file').val('');
				return false;
        };
        img.src = _URL.createObjectURL(file);


    }

});


$('.popup').on('click',function(){

$( "#"+$(this).data('href')).dialog({ width: '650',height:'600', resizable: false,

modal: true });

});

$(document).ready(function(){
try{$("html, body").animate({scrollTop:0},1000);}catch(ex){}

});