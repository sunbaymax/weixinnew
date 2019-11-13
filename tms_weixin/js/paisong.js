/*出港*/
$(".paiSong_list").on("click",function(){
	window.location.href="paiSong_xiang.php?paiSong="+$(this).find("p:nth-of-type(1) span").html();
});
