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
		$sub_add = $("#div_sub_tab").find("ul > li").find("a").eq(2);
		if(activeTab == "#tab3"){
			if ($sub_add.hasClass("none") == true) {
				$(".wrapper_content").empty();
				$sub_add.removeClass("none");
				$sub_add.addClass("inline");
			}
		}else{
			if ($sub_add.hasClass("none") != true) {
				$sub_add.removeClass("inline");
				$sub_add.addClass("none");
			}
		}
		
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
	
	$("#add_admin_content").bind("click",function(){
		console.log("!!");
		$add_content = $(".admin_content").eq(0).clone();
		$new_add_content = $(".wrapper_content").append($add_content);
		$add_content.css("display", "block");
	});
});
/*
 * validation 
 */
function validateion_id(check_value){
	if (check_value == "") {
		return "아이디을 입력하세요!\n";
	}else if(check_value.length < 4){
		return "아이디는 네 글자 이상입니다.\n"
	}else if(/[^a-zA-Z0-9]/.test(check_value)){
		return "아이디에 특수기호 사용은 안됩니다.\n";
	}
		
	return "";
}

function validateion_password(check_value){
	if (check_value == ""){
		return "비밀번호을 입력하세요!\n";
	}else if(check_value.length < 4){
		return "비밀번호는 네 글자 이상입니다.\n"
	}
	
	return "";
}

function validateion_name(check_value){
	if (check_value == ""){
		return "이름을 입력하세요!\n";
	}else if(check_value.length < 2){
		return "이름는 두 글자 이상입니다.\n"
	}else if(/[^ㄱ-ㅎ가-힣a-zA-Z]/.test(check_value)){
		return "이름에 특수기호 사용은 안됩니다.\n";
	}
	
	return "";
}

function validateion_email(check_value){
	if (check_value == ""){
		return "메일을 입력하세요!\n";
	}else if(/[^a-zA-Z0-9.@_-]/.test(check_value)){
		return "메일에 특수기호 사용은 안됩니다.\n";
	}
	
	return "";
}

function validateion_level(check_value){
	if (check_value == "selected") return "권한을 선택하세요!\n";
	else return "";
}

function add_content(obj){
	console.log("insert_btn click!");
	$users_id = $(obj).parent().find("input[name='users_id']").val();
	$users_password = $(obj).parent().find("input[name='users_password']").val();
	$users_name = $(obj).parent().find("input[name='users_name']").val();
	$users_email = $(obj).parent().find("input[name='users_email']").val();
	$users_level = $(obj).parent().find("select[name ='users_level']").val();
	
	$vali_str = validateion_id($users_id) + validateion_name($users_name) + 
			validateion_email($users_email) + validateion_level($users_level);
	
	if($vali_str == ""){
		$.ajax({
			type : 'POST',
			data : {
				users_id:$users_id, 
				users_password: $users_password, 
				users_name:$users_name,
				users_email:$users_email,
				users_level:$users_level
				},
			url : 'http://localhost:8080/php_board/bbs/board/insert_users',
			success : function(data) {
				console.log("성공");
				alert("사용자가 추가 되었습니다.");
				$(obj).parent().find("input[name='users_id']").val('');
				$(obj).parent().find("input[name='users_password']").val('');
				$(obj).parent().find("input[name='users_name']").val('');
				$(obj).parent().find("input[name='users_email']").val('');
				$(obj).parent().find("select[name ='users_level']").val('selected');
			},
			error : function(data){
				console.log("실패!");
			}
		});
	}else{
		alert($vali_str);
	}
}	

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



