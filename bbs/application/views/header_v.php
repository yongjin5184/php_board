<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>CodeIgniter</title>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!-- <link rel='stylesheet' href="/bbs/include/css/bootstrap.css" /> -->
	<link rel='stylesheet' href="../../../include/css/board.css" />
	<script src="../../include/js/board.js"></script>
	
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
            		<span id="show_login" > | 로그인 | </span>
<!--             	<li><span id="show_login" > | 바로가기 | </span></li> -->
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
					<li><a href="/bbs/<?php echo $this->uri->segment(1);?>/lists/<?php echo $this->uri->segment(3);?>">게시판 프로젝트</a>
					<a href="/bbs/board/write/<?php echo $this->uri->segment(3)?>">쓰기</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	
