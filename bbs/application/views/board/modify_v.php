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
						<input type="text" class="input-xlarge" id="input01"
							name="subject" value="<?php echo $views[0]->subject;?>">
						<p class="help-block"></p>
					</div>
					<label class="control-label" for="input02">내용</label>
					<div class="controls">
						<textarea class="input-xlarge" id="input02" name="contents"
							rows="5"><?php echo $views[0]->contents;?></textarea>
						<p class="help-block"></p>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary" id="write_btn">수정</button>
						<button class="btn" onclick="document.location.reload()">취소</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</article>