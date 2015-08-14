
<article id="tab_container">
	<div id="tab2" class="tab_content" style="display: none;">
		<header>
			<h1>Todo 목록</h1>
		</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">내용</th>
					<th scope="col">시작일</th>
					<th scope="col">종료일</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ( $list as $lt ) {
	?>
				<tr>
					<th scope="row">
						<?php echo $lt->id;?>
					</th>
					<td><a rel="external"
						href="/todo/index.php/main/view/<?php echo $lt->id;?>"><?php echo $lt->content;?></a></td>
					<td><time
							datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->created_on));?>"><?php echo $lt->created_on;?></time></td>
					<td><time
							datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->due_date));?>"><?php echo $lt->due_date;?></time></td>
				</tr>
<?php
}
?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="4"><a href="/todo/index.php/main/write/"
						class="btn btn-success">쓰기</a></th>
				</tr>
			</tfoot>
		</table>
		<div>
			<p></p>
		</div>
	</div>
</article>

