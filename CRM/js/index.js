toastr.options = {
	timeOut: "3000",
	positionClass: "toast-center-center"
};
//弹出框函数
$("#success_mao .success_box form input").on("click", function() {
	$("#success_mao").css({
		display: "none"
	});
	$("#success_mao .success_box").css({
		display: "none"
	});
})

function myPlay(play) {
	if(play != "") {
		$("#success_mao .success_box .success_information").html(play);
		$("#success_mao").css({
			display: "block"
		});
		$("#success_mao .success_box").show(500);
	}
}