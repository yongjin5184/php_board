<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
class Board_m extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_list($table='board', $type='', $offset='', $limit='', $search_word='') {
// 		$sword= ' WHERE 1=1 '; //항상 참인 조건
 		$sword= '';
		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword = ' WHERE board_subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
     	}

    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit; //$offset번 데이터 부터 $limit개를 가져온다.
     	}
		//select (@rownum:=@rownum+1) rownum ,user_name, subject, contents,hits, reg_date from ci_board ,(select @rownum:=0) TMP;
// 		echo "옵셋 : " . $offset;
    	$sql = "select board_id as id, (@rownum:=@rownum+1) as rownum ,board_user_name as user_name, board_subject as subject, board_contents as contents, board_hits as hits, board_reg_date as reg_date FROM ".$table.",(select @rownum:='".$offset."') TMP ".$sword." ORDER BY id desc, rownum desc ".$limit_query;
   		$query = $this->db->query($sql);
   		
		if ( $type == 'count' )
     	{
     		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
	    	$result = $query->num_rows();
// 	    	echo "전체 수 : " . $result;
	    	//$this->db->count_all($table);
     	}
     	else
     	{
     		//게시물 리스트 반환
	    	$result = $query->result();
     	}

    	return $result;
	}
	function get_view($table, $id, $table_comment='') {
		$sql_array = array();
		// 조회수 증가
		$sql0 = "UPDATE " . $table . " SET board_hits=board_hits+1 WHERE board_id='" . $id . "'";
		$this->db->query ( $sql0 );
// 		$sql = "SELECT (@rownum:=@rownum+1) rownum, user_name, subject, contents,hits, reg_date FROM " . $table . ",(select @rownum:=0) TMP WHERE board_id='" . $id . "'";
		$sql = "SELECT * FROM " . $table . " WHERE board_id='" . $id . "'";
		$query = $this->db->query ( $sql );
		// 게시물 내용 반환
		$result = $query->row();
		$sql_array[0] = $result;
		if($table_comment != ''){ // $table_comment 변수가 있을 때만 실행
			$sql1 = "SELECT * FROM " . $table_comment . " WHERE board_id=" . $id ." order by board_id desc";
			$query1 = $this->db->query ( $sql1 );
			$result1 = $query1->result();
			$sql_array[1] = $result1;
		}
// 		var_dump($result1);
		return $sql_array;
	}
	
	function insert_board($arrays){
		$insert_array = array(
				'board_pid' => 0,
				'user_id' => 'advisor',
				'user_name' => '김용진',
				'subject' => $arrays['subject'],
				'contents' => $arrays['contents'],
				'reg_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert($arrays['table'], $insert_array);
		return $result;
	}
	
	function insert_reply_board($arrays){
		$insert_array = array(
				'board_id' => $arrays['board_id'],
				're_user_id' =>  $arrays['id'],
				're_contents' => $arrays['contents'],
				're_reg_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert('board_comment', $insert_array);
		return $result;
	}
	
	function modify_board($arrays){
		$modify_array = array(
				'subject' => $arrays['subject'],
				'contents' =>$arrays['contents']
		);
		
		$where = array(
			'board_id' => $arrays['board_id']	
		);
		
		$result = $this->db->update($arrays['table'], $modify_array, $where);
		
		return $result;
	}
	
	function delete_board($table, $id) {
		$delete_array = array(
			'board_id' => $id	
		);
		
		$result = $this->db->delete($table, $delete_array);
		
		return $result;
	}
	
	function select_users($arrays){
		// 여기서 데이터베이스 처리하고 다시 뷰로 넘겨줘야함.
		$query = $this->db->get_where('users', $arrays);
		$result = $query->result();
 		$t = $this-> db ->last_query();
		if(!empty($result)){
			foreach ($result as $row){
				$data = array(
					'name' => $row-> users_name,
					'email' => $row->users_email
				);
				return $data;
			}
		}else{
			return null;
		}
	}
	
}