
    var personArray = new Array;
//  var _data='';
//  $.ajax({
//  	type:"post",
//  	url:"http://www.zjcoldcloud.com/weixin/weixin_select_usersinfo.php",
//  	async:false,
//  	data:_data,
//  	dataType:"JSON",
//  	success:function(res){
//  		jQuery.each(res.list, function(i, val) {  
//			    //console.log("Key:" + i + ", Value:" + val.headimgurl); 
////			    console.log(val);return false;
//			    personArray.push({
//			            id: val.id,
//			            image:val.headimgurl,
//			            thumb_image:val.headimgurl,
//			            name: val.nickname
//			        });
//			});  
//  	},
//  	error:function(err){
//  		console.log(err)
//  	}
//  });
    
       

$.ajaxSettings.async = false;
$.post("http://www.zjcoldcloud.com/weixin_lucky/site_list.php",{draw:"三等奖"},function(res){
    var data = res.data;
    if(data.length==0){
      $(".loader_file").text("抽奖时间未开始,请联系管理员核实");    	
    }
    for(var i = 0;i<data.length;i++){
        if(data[i].headimgurl == ''){
            data[i].headimgurl = 'https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=1405405591,839252436&fm=58';
        }
        if(data[i].nickname == ''){
            data[i].nickname = '微信';
        }
        var obj = {};
        obj.image = data[i].headimgurl;
        obj.id = data[i].id;
        obj.thumb_image = data[i].headimgurl;
        obj.name = data[i].nickname;
        personArray.push(obj);
    }
$(".lucky_number").text(data.length);
},"JSON")
$.ajaxSettings.async = true;
    


    


