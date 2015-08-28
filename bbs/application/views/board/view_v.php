<div id="tab_container">
	<div id="tab1" class="tab_content" style="display: block;">
		<header>
			<h1></h1>
		</header>
		<table id="view_table">
			<thead>
				<tr>
					<th>이름 : <?=$result[0]->users_name;?></th>
					<th>조회수 : <?=$result[0]->board_hits;?></th>
					<th>등록일 : <?=$result[0]->board_reg_date;?></th>
					<th>작성자 : <?=$result[0]->users_id?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="5">
						<textarea rows="1" cols="220" readonly="readonly" class="text_area">
							<?=$result[0]->board_subject;?>
						</textarea>
					</th>
				</tr>
				<tr>
					<th colspan="5">
						<textarea rows="20" cols="220" readonly="readonly" class="text_area">
							<?=$result[0]->board_contents;?>
						</textarea>
					</th>
				</tr>
			</tbody>
			
			<table id="comment_table">
				<thead>
					<tr>
						<td>
						<hr/>
						<!-- board id를 hidden 으로 넘김. -->
							<form method="post" action="" id="write_action">
								<input type="hidden" name ="id" value="<?=$this->session->userdata['id']?>" >
								<p>댓글을 입력하세요</p><input type="text" placeholder="내용" name="contents" style="width:400px; height: 20px; ">
								<input type="hidden" name="board_id" value= "<?=$this->uri->segment(5);?>">
								<button type="submit" id="re_write_btn">작성</button>
							</form>
						</td>
					</tr> 
				</thead>
				<tbody>
				    <?php 
				    if($result[1] != null){
        			foreach ($result[1] as $rs)	{
        			?>
					<tr>
						<td>
						<hr style="border-top: dotted 2px black;"/>
						<?php if($rs->users_profile_path != ''){?>
						<img src="<?=$rs->users_profile_path;?>" alt="profile_img" width="42" height="42" alt="smile">
						<span><?=$rs->users_id;?></span> &nbsp <span><?=$rs->bc_reg_date;?></span> 
						<br/>
						<span><?=$rs->bc_contents;?></span>
						<hr style="border-top: dotted 2px black;"/>
						</td>
					</tr>
					<?php }}}?>
				</tbody>
				<tfoot align="left">
					<tr>
						<th><a
							href="/php_board/bbs/board/lists/<?=$this->uri->segment(3)?><?php if($my_page != 0){echo "/page/".$my_page; };?>"
							class="btn btn-primary">목록</a> 
							 
							<?php 
								$session_id = $this->session->userdata['id'];
								$session_level = $this->session->userdata['level'];
								$users_id = $result[0]->users_id;
								if($session_id == $users_id || $session_level == 'A'){
							?>
								<a
								href="/php_board/bbs/board/modify/<?=$this->uri->segment(3)?>/board_id/<?=$this->uri->segment(5);?>/page/<?=$this->uri->segment(7);?>"
								>수정</a>
								<a
								href="/php_board/bbs/board/delete/<?=$this->uri->segment(3)?>/board_id/<?=$this->uri->segment(5);?>/page/<?=$this->uri->segment(7);?>"
								class="btn btn-danger">삭제</a> 
							<?php }?>
						</th>
					</tr>
				</tfoot>
			</table>
		</table>
	</div>
</div>