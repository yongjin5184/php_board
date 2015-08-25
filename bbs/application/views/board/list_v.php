 <div id="tab_container">
  <div id="tab1" class="tab_content">
    <table id= "list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">제목</th>
          <th scope="col">작성자</th>
          <th scope="col">조회수</th>
          <th scope="col">작성일</th>
        </tr>
      </thead>
      <tbody>
        
        <?php 
         
        $j = 0;
        $i = 0;
//      $my_rownum = $list[0]->rownum; // 14
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
				<form id="myForm" action="/php_board/bbs/<?=$board_name;?>/view/<?=$table_name?>/board_id/<?=$lt->id?>" method="post" name="myForm">
	    	          <input type="hidden" name="rownum" value="<?=$index_rownum?>"/>
	        	      <a id="a_tag_sub1" href="javascript:if('<?=@$this->session->userdata['logged_in']?>' == 1)
	        	      										{
	        	      										document.getElementsByName('myForm')[<?php echo $j?>].submit();
	        	      										}else{
	        	      										alert('로그인이 필요합니다.');
	        	      										}"><?=$lt->subject;?></a>
	            </form>
              </td>
              <td><?=$lt->users_id;?></td>
              <td><?=$lt->hits;?></td>
              <td><time datetime="<?=mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?=mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time></td>
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
      <!--form id="bd_search" method="post" class="well form-search" -->
        <i class="icon-search"></i> 
        <form action="/php_board/bbs/<?=$this->uri->segment(1);?>/search/<?=$this->uri->segment(3);?>" method="post">
        <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
        <input type="submit" value="검색" id="search_btn" class="btn btn-primary" />
  		</form>
  	</div>
  </div>