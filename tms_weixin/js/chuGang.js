/*出港*/
$(".chuGang_list").on("click",function(){
	window.location.href="chuGang_xiang.html?chuGang="+$(this).find("p:nth-of-type(1) span").html();
});
/*出港详情*/
$(".chuGang").on("click",function(){
	window.location.href="chuGang_tongZhi.html"
})
/*出港通知*/
$(".xiang_baoCun").on("click",function(){
	window.location.href="chugang.html"
})
