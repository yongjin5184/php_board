<article id="tab_container">
	<div id="tab1" class="tab_content" style="display: block;">
		<header>
			<h1></h1>
		</header>
		<table id="view_table" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><?=$result[0]->board_subject;?></th>
					<th scope="col">이름 : <?=$result[0]->board_user_name;?></th>
					<th scope="col">조회수 : <?=$result[0]->board_hits;?></th>
					<th scope="col">등록일 : <?=$result[0]->board_reg_date;?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="4">
					<?=$result[0]->board_contents;?>
					</th>
				</tr>
			</tbody>
			
			<table id="comment_table">
				<thead>
					<tr>
						<td>
						<hr/>
						<!-- board id를 hidden 으로 넘김. -->
							<form class="form-horizontal" method="post" action="" id="write_action">
								<input type="text" class="form-control" name ="id" placeholder="아이디" >&nbsp;&nbsp;
								<input type="text" class="form-control" placeholder="내용" name="contents" style="width:400px">
								<input type="hidden" name="board_id" value= "<?=$this->uri->segment(5);?>">
								<button type="submit" class="btn btn-primary" id="re_write_btn">작성</button>
							</form>
						</td>
					</tr> 
				</thead>
				<tbody>
				    <?php 
				    if($result[1] != null){
//         			for ($i = 0; $i < sizeof($result[1]); $i++){
        			foreach ($result[1] as $rs)	{
        			?>
					<tr>
						<td>
						<hr style="border-top: dotted 2px black;"/>
						<img src="/php_board/bbs/include/images/smiley.gif" alt="Smiley face" width="42" height="42" alt="smile">
						<span><?=$rs->bc_user_id;?></span> &nbsp <span><?=$rs->bc_reg_date;?></span> 
						<br/>
						<span><?=$rs->bc_contents;?></span>
						<hr style="border-top: dotted 2px black;"/>
						</td>
					</tr>
					<?php }}?>
				</tbody>
				<tfoot align="left">
					<tr>
					<!-- rownum을 넘겨서 게시판으로 넘어갈 때 페이징된 곳으로 넘어갈 수 있도록 함
						(전체  - rownum) / 5 + 1 
					 -->
						<th><a
							href="/php_board/bbs/board/lists/<?=$this->uri->segment(3)?><?php if($my_page != 0){ echo "/page/".$my_page; };  ?>"
							class="btn btn-primary">목록</a> <a
							href="/php_board/bbs/board/modify/<?=$this->uri->segment(3)?>/board_id/<?=$this->uri->segment(5);?>/page/<?=$this->uri->segment(7);?>"
							class="btn btn-warning">수정</a> <a
							href="/php_board/bbs/board/delete/<?=$this->uri->segment(3)?>/board_id/<?=$this->uri->segment(5);?>/page/<?=$this->uri->segment(7);?>"
							class="btn btn-danger">삭제</a> 
							<!-- <a
							href="/bbs/board/write/<?=$this->uri->segment(3)?>/board_id/<?=$this->uri->segment(5);?>/page/<?=$this->uri->segment(7);?>"
							class="btn btn-success">쓰기</a>-->
						</th>
					</tr>
				</tfoot>
			</table>
		</table>
	</div>
</article>