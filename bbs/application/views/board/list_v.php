 <div id="tab_container">
  <div id="tab1" class="tab_content">
    <table id= "list_table">
      <thead>
        <tr>
          <th>번호</th>
          <th>제목</th>
          <th>작성자</th>
          <th>조회수</th>
          <th>작성일</th>
        </tr>
      </thead>
      <tbody>
        
        <?php 
         
        $j = 0;
        $i = 0;
        foreach ($list as $lt)
		{
        ?>
          <tr>
              <th scope="row">
              <?php 
              		$index_rownum = $total_rows - ($page * 5) - $i; // 전체 페이지 - (페이지번호 * 5) 에서 하나씩 빼 나간다.
              		echo $index_rownum;
               		$i ++;
               		$board_name = $this->uri->segment(1);
               		$table_name = $this->uri->segment(3);
              	?>
              </th>
             
              <td>
				<form action="/php_board/bbs/<?=$board_name;?>/view/<?=$table_name?>/board_id/<?=$lt->id?>" method="post" name="content_form">
	    	          <input type="hidden" name="rownum" value="<?=$index_rownum?>"/>
	        	      <a href="javascript: click_subject('<?=@$this->session->userdata['logged_in']?>', <?=$j?>);"><?=$lt->subject;?></a>
	            </form>
              </td>
              <td><?=$lt->users_id;?></td>
              <td><?=$lt->hits;?></td>
              <td><?=mdate("%M. %j, %Y", standard_date($lt->reg_date));?></td>
          </tr>

          <?php
         $j++;}
          ?>
      </tbody>
      <tfoot>
      	<tr>
      		<th colspan="5"><?=$pagination;?></th>
      	</tr>
      </tfoot>
    </table>
        <form action="/php_board/bbs/<?=$this->uri->segment(1);?>/search/<?=$this->uri->segment(3);?>" method="post">
        <input type="text" name="search_word" id="question" maxlength="20"/> 
        <input type="submit" value="검색" id="search_btn"/>
  		</form>
  	</div>
  </div>