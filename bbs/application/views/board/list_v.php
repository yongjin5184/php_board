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
//         		var_dump($list);
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
	              <form id="myForm" action="/php_board/bbs/<?=$board_name;?>/view/<?=$table_name?>/board_id/<?=$lt->id;?>" method="post" name="myForm">
		              <input type="hidden" name="rownum" value="<?=$index_rownum?>"/>
		              <a id="a_tag_sub1" href="javascript: document.getElementById('myForm').submit();"><?=$lt->subject;?></a>
	              </form>
              </td>
              <td><?=$lt->user_name;?></td>
              <td><?=$lt->hits;?></td>
              <td><time datetime="<?=mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?=mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time></td>
          </tr>

          <?php }?>
      </tbody>
      <tfoot>
      	<tr>
      		<th colspan="5"><?=$pagination;?></th>
      	</tr>
      </tfoot>
    </table>
      <!--form id="bd_search" method="post" class="well form-search" -->
        <i class="icon-search"></i> 
        <form action="/bbs/<?=$this->uri->segment(1);?>/search/<?=$this->uri->segment(3);?>" method="post">
        <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
        <input type="submit" value="검색" id="search_btn" class="btn btn-primary" />
  		</form>
  	</div>
  	<div id="tab2" class="tab_content">	
  		<div id="users_info_content">	
	  		<div class="users_info">
				<a>아이디</a>
				<span class="expand">▼expand</span>
			</div>
			<div class="none"><label>이름 : </label><input type="text" name="name" style="width: 200px; height: 35px;"></input>
				<button class="btn-green" style ="height: 35px;">Save</button>
			</div>
			<div class="users_info">
				<a>이메일</a>
				<span class="expand">▼expand</span>
			</div>
			<div class="none"><label>이메일 : </label><input type="text" name="email" style="width: 200px; height: 35px;"></input>
				<button class="btn-green" style ="height: 35px;">Save</button>
			</div>
		</div>
  	</div>
  </div>