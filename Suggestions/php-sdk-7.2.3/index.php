<!--<form id="myForm" enctype="multipart/form-data">-->
<!--    <input name="token" type="hidden" value="KXg05-xfaxEg5AOqCMkKDCr6C4Spix4F_D6rXvSg:zh0Wv6n6p65El8i-otnAN85kULU=:eyJyZXR1cm5Cb2R5Ijoie1wia2V5XCI6XCIkKGtleSlcIixcImhhc2hcIjpcIiQoZXRhZylcIixcImZzaXplXCI6JChmc2l6ZSksXCJidWNrZXRcIjpcIiQoYnVja2V0KVwiLFwibmFtZVwiOlwiJCh4Om5hbWUpXCJ9Iiwic2NvcGUiOiJ6amx5dG1zIiwiZGVhZGxpbmUiOjE1MjE3MDgxMzN9">-->
<!--    <input name="file" type="file" id="file" />-->
<!--    <input type="submit" value="上传"/>-->
<!--</form>-->


<form id="jvForm" action="" method="post" enctype="multipart/form-data">
    <input name="token" type="hidden" value="KXg05-xfaxEg5AOqCMkKDCr6C4Spix4F_D6rXvSg:_xeALUOAXS-tJQw0qoiZF0NCHHo=:eyJyZXR1cm5Cb2R5Ijoie1wia2V5XCI6XCIkKGtleSlcIixcImhhc2hcIjpcIiQoZXRhZylcIixcImZzaXplXCI6JChmc2l6ZSksXCJidWNrZXRcIjpcIiQoYnVja2V0KVwiLFwibmFtZVwiOlwiJCh4Om5hbWUpXCJ9Iiwic2NvcGUiOiJ6amx5dG1zIiwiZGVhZGxpbmUiOjE1MjE3MTQ2MDd9"/>
    <table>
        <tbody>
        <tr>
            <td width="20%">
                <span>*</span>
                上传图片(90x150尺寸):</td>
            <td width="80%">
                注:该尺寸图片必须为90x150。
            </td>
        </tr>
        <tr>
            <td width="20%"></td>
            <td width="80%">
                <img width="100" height="100" id="allUrl"/>
                <!-- 在选择图片的时候添加事件，触发Ajax异步上传 -->
                <input name="pic" type="file" id="file" onchange="uploadPic()"/>
            </td>
        </tr>
        </tbody>
    </table>
</form>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<!--<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>-->
<script>
	$(document).ready(function(){
			$.ajax({
			url: 'http://www.ccsc58.cc/weixinnew/Suggestions/php-sdk-7.2.3/getToken.php',
			type: 'POST',
			dataType: 'JSONP',
			jsonp: 'callback',
			jsonpCallback: 'data',
			success: function(res) {
				$('input[name=token]').val(res.list);
			}
		})
	})
   	
    function uploadPic() {
        var fileM=document.querySelector("#file");
        var fileObj=fileM.files[0];
        var formData=new FormData();
        formData.append('file',fileObj);
        console.log(fileObj);
        formData.append('token',$("input[name=token]").val());
        //创建ajax对象
        var ajax=new XMLHttpRequest();
        //发送POST请求
        ajax.open("POST","http://up-z1.qiniup.com",true);
        ajax.send(formData);
        ajax.onreadystatechange=function(){
            if (ajax.readyState == 4) {
                if (ajax.status>=200 &&ajax.status<300||ajax.status==304) {
                     var obj=JSON.parse(ajax.responseText);
                     $("#allUrl").attr('src','http://qiniu.ccsc58.com/'+obj.key)
                }else{
                    alert(ajax.responseText);
                }
            }
        };
    }
</script>