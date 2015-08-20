/**
 * 
 */

$(document).ready(function() {
	/*
	 * tab click 
	 */
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
	/*
	 * login button click
	 */
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
				if(data != null){
					$('#div_login').hide();
					window.location.href = "";
					console.log("성공");
				}else{
					console.log("실패");
				}
			},
			error : function(data){
				console.log("실패!");
			}
		});
	});
	/*
	 * logout span click
	 */
	$(".logout_span").click(function() {
		console.log("로그아웃");
		window.location.href = "../../logout";
	});

	$(".login_span").click(function() {
		// console.log("show_login");
		var $divLogin = $("#div_login");
		if ($divLogin.hasClass("none") == true) {
			 console.log("있음");
			$divLogin.removeClass("none");
			$divLogin.addClass("inline");
		} else {
			$divLogin.removeClass("inline");
			$divLogin.addClass("none");
		}
	});
	/*
	 * expand span click
	 */
	$(".expand").click(function(){
		console.log("expand!!");
		var $div_users_info = $(this).parent();
		var $expand_content = $(this).parent().next();
		if($expand_content.hasClass("none") == true){ //확장
			$expand_content.removeClass("none");
			$expand_content.addClass("block");
			$div_users_info.css("border-bottom", "none");
			$expand_content.css("border-bottom","1px solid black");
			$(this).text("▲close");
		}else{//접기
			$expand_content.removeClass("block");
			$div_users_info.css("border-bottom","1px solid black");
			$expand_content.addClass("none");
			$(this).text("▼expand");
		}
	});
});

/*
 * search button click
 */
function board_search_enter(form) {
	var keycode = window.event.keyCode;
	if (keycode == 13)
		$("#search_btn").click();
}

