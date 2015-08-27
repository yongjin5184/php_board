/**
 * 
 */

$(document).ready(function() {
	/*
	 * tab click 
	 */
	$(".tab_content").hide();
//	$("ul.tab li:first").addClass("active").show();
	$("#tab1").show();
	$("ul.tab li").click(function() {
		$("ul.tab li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});
	$("#search_btn").click(function() {
		if ($("#question").val() == '') {
			alert("검색어를 입력하세요");
			return false;
		} else {
			alert(("#question").val());
		}
	});

	$("#re_write_btn").click(function() {
		console.log("re_write_btn");
	});
	/*
	 * login button click ajax
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
			url : 'http://localhost:8080/php_board/bbs/board/auth',
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
		window.location.href = "http://localhost:8080/php_board/bbs/board/logout/";
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
	
	$(".btn-green").click(function(){
		console.log("!");
//		console.log($(this).parent().find("input").attr("value"));
		$prev_span = $(this).parent().prev().find("span").eq(0);
		$modify_val = $(this).parent().find("input").attr("value");
		$users_id = $(".users_info").find("input").eq(1).attr("value");
		
		$.ajax({
			type : 'POST',
			data : {modify_val:$modify_val, users_id:$users_id},
			url : 'http://localhost:8080/php_board/bbs/board/modify_where',
			success : function(data) {
				console.log("성공");
			},
			error : function(data){
				console.log("실패!");
			}
		});
		
	});
});

/*
 * search button click
 */

$('#question').bind('keypress', function(e) {
	if(e.keyCode==13){
		$("#search_btn").click();
	}
});
/*
 * subject click
 */
function click_subject(logged_check, index){
	if(logged_check == 1){
		document.getElementsByName('content_form')[index].submit();
	}else{
		alert('로그인이 필요합니다.');
	}
}
/*
 * pre_picture
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#prev_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

