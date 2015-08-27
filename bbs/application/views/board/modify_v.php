<article id="tab_container">
	<div id="tab1" class="tab_content" style="display: block;">
		<header>
			<h1></h1>
		</header>
		<form class="form-horizontal" method="post" action=""
			id="write_action">
			<fieldset>
				<legend>게시물 수정</legend>
				<div class="control-group">
					<label class="control-label" for="input01">제목</label>
					<div class="controls">
						<input type="text" id="input_subject"
							name="board_subject" value="<?php echo $views[0]->board_subject;?>">
						<p class="help-block"></p>
					</div>
					<label class="control-label" for="input02">내용</label>
					<div class="controls">
						<textarea id="input02" class="text_area" name="board_contents"
							cols="150" rows="20"><?php echo $views[0]->board_contents;?></textarea>
						<p class="help-block"></p>
					</div>
					<div class="form-actions">
						<button type="submit" id="write_btn">수정</button>
						<button class="btn" onclick="document.location.reload()">취소</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</article>