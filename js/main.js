var frmonsuibmit = function(o){
	return false;
}

var savacmt = function(){
	var o = {};
	o.id_error = document.getElementById("id_error");
	o.v = document.getElementById('id_cmt').value;
	try{o.v = o.v.trim();}catch(e){}
	if(o.v != ''){
		o.id_error.style.display="none";
		if(!window.oauth){
			FB.login(function(r){
				fetchFBuserInfo(function(){ senduserinfo(); sendcmt(o.v); });
			},{scope: SC.SCOPE});
		}else{
			fetchFBuserInfo(function(){ senduserinfo(); sendcmt(o.v); });
		}
	}else{
		o.id_error.style.display="block";
	}
}

var senduserinfo = function(){
	$.ajax({
		type: "POST",
		url: "userinfo.php",
		data: window.userInfo
	}).done(function( r ) {
		debug(r, arguments);
	});
}


var reply = function(){
	$.ajax({
		type: "POST",
		url: "reply.php",
		data: {'postid':'','msg':''}
	}).done(function( r ) {
		debug(r, arguments);
	});
}


var sendcmt = function(cmt){
	var msg = [
			   "Click here to participate in the challenge and win cool gadgets and promising career with American Express India."
			   ];
	
	var feedObj = {
		message: 'Campus Centurion Challenge 2013',
		name: "Are you hooked on to the Campus Centurion Challenge 2013 yet?",
		link: SC.CANVASURL,
		picture: 'http:'+SC.BASEURL+'img/fb_image1.jpg',
		caption: "Campus Centurion",
		description: msg[0]
	};
	document.getElementById("id_cmt_process").style.display = "block";
	fbFQL({path:'/me/feed',method:'POST',data:feedObj},function(r){
		if(r.id){
			
		}
	});
}

var renderFriendsWithApp = function(){}

//fetch appusers
function fetchFBappUsers(cb){
    cb = cb || function(){};
	var o = {}; 
	
	if(window.appUsers == void 0){
		o.fql = {
            method: "get",
            path: "/fql/",
            data: {
				q: "SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me() ) AND is_app_user = 1"
			}
        };
		
		fbFQL(o.fql,function(r){
	        window.appUsers = r.data;
	        cb(r);
		});
	}else{
		cb(window.appUsers);
	}
}

//userinfo
function fetchFBuserInfo(cb){
    cb = cb || function(){};
	var o = {}; 
	
	if(window.userInfo == void 0){
		/* Name,gender,location,email*/
		o.fql = {
            method: "get",
            path: "/fql/",
            data: {
				q: 'select uid, name, email from user where uid = me()'
			}
        };
		
		fbFQL(o.fql,function(r){
			o.o = r.data[0];
			o.o.name = o.o.name || '';
			o.o.email = o.o.email || '';
	        window.userInfo = r.data[0];
	        cb(r);
		});
	}else{
		cb(window.userInfo);
	}
}


// fbFQL({path:'graph api',method:'GET',data:{limit:3}},function(r){})
function fbFQL(o,cb){
	o = o || {};
	o.method = o.method || 'GET';
	o.data = o.data || {}; //{limit:3};
	cb = cb || function(){};
	if (o.path) {
		try{
			FB.api(o.path, o.method,o.data, function(r){
				debug(o.path,r);
				if (!r || r.error) {
					debug('Error:',r.error);
				}else{
					cb(r);
				}
			});
		}catch(e){cb(e);}
	}else{
		cb('not specify graph api path');
	}
}