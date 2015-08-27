<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CodeIgniter</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!-- <link rel='stylesheet' href="/bbs/include/css/bootstrap.css" /> -->
	<link rel='stylesheet' href="/php_board/bbs/include/css/board.css" />
	<script src="/php_board/bbs/include/js/board.js"></script>
</head>
<body>
	<div id="header">
		<div id="container">
            <ul class="tab">
                <li class="active"><a href="#tab1">게시판</a></li>
                <li><a href="#tab2">회원정보</a></li>
            </ul>
            <ul class="tab_login">
            	<li>
            		<span id="show_login" class="login_span" > | 로그인 | </span>&nbsp;
            	    <span> 
            	    	<?php if(@$this->session->userdata('logged_in') == TRUE){?>
            				<?php echo $this->session->userdata('username')?>
            			 	님 환영합니다. 
            			 <?php echo "<script>
							$('#show_login').text('| 로그아웃 |');
							$('#show_login').removeClass('login_span');
							$('#show_login').addClass('logout_span');
							</script>" ?>
							<?php $userlevel = $this->session->userdata('level');
								if($userlevel == 'A'){
								echo "<script>$('#container .tab li:eq(1)').after('<li><a href=\'#tab3\'>관리자</a></li>');</script>"?>
								<?php }?>
            			 <?php }?>
            		 </span>
<!--             	<li><span id="show_login" > | 쓰기 | </span></li> -->
			 	</li>
				<li id="div_login" class="none" >
			 		<input type="text" class="input" id="input_id" name="id" placeholder="id" />
			 		<input type="password" class="input" id="input_password" name="password" placeholder="password" />
			 		<button id="btn_login" class="btn">로그인</button>
		 		</li>
            </ul>
			<ul >
		 		
	 		</ul>
		</div>
		<div>
			<div id="div_sub_tab">
				<ul>
					<li><a href="/php_board/bbs/<?php echo $this->uri->segment(1);?>/lists/<?php echo $this->uri->segment(3);?>">게시판 프로젝트</a>
					<a href="/php_board/bbs/board/write/<?php echo $this->uri->segment(3)?>">쓰기</a></li>
				</ul>
			</div>
		</div>
		<div id="tab2" class="tab_content">	
  		<div id="users_info_content">
	  		<div class="users_info">
				<span>사진 : </span><span class="expand">▼expand</span>
				<form action="http://localhost:8080/php_board/bbs/upload/do_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<input type="file" name="userfile" onchange="readURL(this);" size="20" />
				<input type="hidden" name="userid" value="<?php echo $this->session->userdata('id')?>"/>
				<input type="submit" value="upload" />
				</form>
			</div>
			<div class="none">
				<img id="prev_img" src="/php_board/bbs/include/images/no_pic.jpg" alt="your image"/>
			</div>
	  		<div class="users_info">
				<a>이름 : </a><span><?php echo $this->session->userdata('username')?></span>
				<span class="expand">▼expand</span>
			</div>
			<div class="none"><label>이름 : </label><input id="input_id" type="text" name="name" ></input>
				<button class="btn-green" style ="height: 35px;">Save</button>
			</div>
			<div class="users_info">
				<a>이메일 : </a><span><?php echo $this->session->userdata('email')?></span>
				<span class="expand">▼expand</span>
			</div>
			<div class="none"><label>이메일 : </label><input id="input_pw"type="text" name="email"></input>
				<button class="btn-green" style ="height: 35px;">Save</button>
			</div>
		</div>
  	</div>
	</div>
	
	
