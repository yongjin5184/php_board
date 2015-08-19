/**
 * 
 */

$(document).ready(function() {
	$(".tab_content").hide();
	$("ul.tab li:first").addClass("active").show();
	$(".tab_content:first").show();
	$("ul.tab li").click(function() {
		$("ul.tab li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});
	$("#search_btn").click(function() {
		if ($("#q").val() == '') {
			alert("검색어를 입력하세요");
			return false;
		} else {
			alert(("#q").val());
		}
	});

	$("#re_write_btn").click(function() {
		console.log("re_write_btn");
	});

	$("#btn_login").click(function() {
		console.log("login");
		console.log("id = " + $("#input_id").val());
		console.log("password = " + $("#input_password").val());
		var $login_obj = {
			'id' : $("#input_id").val(),
			'password' : $("#input_password").val()
		};

		$.ajax({
			type : 'post',
			data : JSON.stringify($login_obj),
			dataType : 'text',
			contentType : 'application/json',
			url : './board',
			success : function(data) {
				alert("성공입니다");
			}
		});
	});

	$("#show_login").click(function() {
		// console.log("show_login");
		var $divLogin = $("#div_login");
		if ($divLogin.hasClass("none") == true) {
			// console.log("있음");
			$divLogin.removeClass("none");
			$divLogin.addClass("inline");
		} else {
			$divLogin.removeClass("inline");
			$divLogin.addClass("none");
		}
	});
});

function board_search_enter(form) {
	var keycode = window.event.keyCode;
	if (keycode == 13)
		$("#search_btn").click();
}