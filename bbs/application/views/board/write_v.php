
<div id="tab1" class="tab_content" style="display: block;">
	<form method="post" action="" id="write_action">
		<fieldset class='field_style'>
			<legend>게시물 쓰기</legend>
			<div class='center'>
				<label>제목</label>
				<div class="controls">
					<input type="text" id="input_subject" name="subject">
					<input type="hidden" name="id" value="<?=$this->session->userdata('id')?>">
					<input type="hidden" name="username" value="<?=$this->session->userdata('username')?>">
				</div>
				<label class="control-label">내용</label>
				
				<div class="controls">
					<textarea id="input02" name="contents"
						cols="150" rows="30"></textarea>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
					<button class="btn" onclick="document.location.reload()">취소</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
