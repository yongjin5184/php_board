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
		var $id = $("#input_id").val();
		var $password = $("#input_password").val();
		$("#input_id").val('');
		$("#input_password").val('')
		$.ajax({
			type : 'POST',
			data : {id:$id, password:$password},
			dataType:'json',
			url : '../../auth',
			success : function(data) {
				console.log("성공입니다");
				if(data != null){
					console.log(data.name + data.email);
					$("#show_login").text("| 로그아웃 |");
					$("#div_login").hide();
					$("#show_login").after("<span style='font-size: 1.1em; color: #ff0000'>" + data.name + "님 반갑습니다." + "</span>"); 
				}else{
					console.log("조회되지않음.");
					alert("아이디를 확인해 주세요");
				}
				
			},
			error : function(data){
				console.log("실패!");
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

//search
function board_search_enter(form) {
	var keycode = window.event.keyCode;
	if (keycode == 13)
		$("#search_btn").click();
}