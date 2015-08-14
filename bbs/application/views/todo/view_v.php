
<article id="tab_container">
	<div id="tab2" class="tab_content" style="display: none;">
		<header>
			<h1>Todo 조회</h1>
		</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><?php echo $views->id;?> 번 할일</th>
					<th scope="col">시작일 : <?php echo $views->created_on;?></th>
					<th scope="col">종료일 : <?php echo $views->due_date;?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="3">
            <?php echo $views->content;?>
          </th>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4"><a href="/todo/index.php/main/lists/"
						class="btn btn-primary">목록</a> <a
						href="/todo/index.php/main/delete/<?php echo $this->uri->segment(3);?>"
						class="btn btn-danger">삭제</a> <a href="/todo/index.php/main/write"
						class="btn btn-success">쓰기</a></th>
				</tr>
			</tfoot>
		</table>
	</div>
</article>


