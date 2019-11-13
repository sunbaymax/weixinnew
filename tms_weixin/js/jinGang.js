/*出港*/
$(".jinGang_list").on("click",function(){
	window.location.href="jinGang_xiang.html?chuGang="+$(this).find("p:nth-of-type(1) span").html();
});
/*出港详情*/
$(".jinGang").on("click",function(){
	window.location.href="jinGang_tongZhi.html"
})
/*出港通知*/
$(".xiang_baoCun").on("click",function(){
	window.location.href="jingang.html"
})

