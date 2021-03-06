<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
class Board_m extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_list($table='board', $type='', $offset='', $limit='', $search_word='') {
 		$sword= " where board_is_del IN ('N')";
		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword = $sword. ' and (board_subject like "%'.$search_word.'%" or board_contents like "%'.$search_word.'%")';
     	}

    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit; //$offset번 데이터 부터 $limit개를 가져온다.
     	}
		//select (@rownum:=@rownum+1) rownum ,user_name, subject, contents,hits, reg_date from ci_board ,(select @rownum:=0) TMP;
    	$sql = "select board_id as id, (@rownum:=@rownum+1) as rownum, users_id, board_subject as subject, board_contents as contents, board_hits as hits, board_is_del, board_reg_date as reg_date FROM ".$table.",(select @rownum:='".$offset."') TMP ".$sword." ORDER BY id desc, rownum desc ".$limit_query;
   		$query = $this->db->query($sql);
   		
		if ( $type == 'count' )
     	{
     		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
	    	$result = $query->num_rows();
     	}
     	else
     	{
     		//게시물 리스트 반환
	    	$result = $query->result();
     	}

    	return $result;
	}
	/*
	 * $table : 게시판 , $table_comment : 게시판 댓글 
	 */
	function get_view($table, $id, $table_comment='') { 
		$sql_array = array();
		// 		join table;
		$this->db->select('*');
		$this->db->from('board as b');
		$this->db->join('users as u', 'b.users_id = u.users_id');
		$this->db->where('b.board_id', $id);
		$query = $this->db->get();
		$result = $query->row();
		// 게시물에 달린 댓글 조회
		$sql_array[0] = $result;
		
		if($table_comment != ''){ // $table_comment 변수가 있을 때만 실행
// 			$sql2 = "SELECT * FROM " .$table_comment. " WHERE board_id=". $id ." order by board_id desc";
			$this->db->select('*');
			$this->db->from($table_comment);
			$this->db->join('users as u', 'board_comment.users_id = u.users_id');
			$this->db->where('board_comment.board_id', $id);
			$this->db->order_by('board_comment.board_id', 'desc');
			$query1 = $this->db->get();
			$result1 = $query1->result();
			$sql_array[1] = $result1;
		}
		
 		return $sql_array;
	}
	
	function update_hits($id){
		// 조회수 증가
		// 		$sql0 = "UPDATE " . $table . " SET board_hits = board_hits+1 WHERE board_id='" . $id . "'";
		$data = array(
				'board_hits' => 'board_hits + 1'
		);
		$this->db->where('board_id', $id);
		$this->db->set('board_hits', 'board_hits+1', FALSE);
		$this->db->update('board');
	}
	
	function insert_board($arrays){
		$insert_array = array(
				'users_id' => $arrays['id'],
				'board_subject' => $arrays['subject'],
				'board_contents' => $arrays['contents'],
				'board_reg_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert($arrays['table'], $insert_array);
		return $result;
	}
	
	function insert_reply_board($arrays){
		$insert_array = array(
				'board_id' => $arrays['board_id'],
				'users_id' =>  $arrays['id'],
				'bc_contents' => $arrays['contents'],
				'bc_reg_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert('board_comment', $insert_array);
		return $result;
	}
	
	function modify_board($arrays){
		$modify_array = array(
				'board_subject' => $arrays['board_subject'],
				'board_contents' =>$arrays['board_contents']
		);
		
		$where = array(
			'board_id' => $arrays['board_id']	
		);
		
		$result = $this->db->update($arrays['table'], $modify_array, $where);
		
		return $result;
	}
	
	function delete_board($table, $id) {
		$delete_array = array(
			'board_is_del' => 'Y'	
		);
		
		$where = array(
			'board_id' => $id
		);
		$result = $this->db->update($table, $delete_array, $where);
		
		return $result;
	}
	function select_users($users_id = null , $users_password = null){
		// 여기서 데이터베이스 처리하고 다시 뷰로 넘겨줘야함.
		$this->db->select('*');
		$this->db->where('users_id', $users_id);
// 		$this->db->where('users_password', $users_password);
		$query = $this->db->get("users");
		$result = $query->row_array();
		
		if($users_password == $this->encrypt->decode($result['users_password'])){
			return $result;
		}else{
			return null;			
		}
	}
	function insert_users_profile_path($arrays){
		$data = array(
				'users_profile_path' => "/php_board/bbs/uploads/".$arrays['file_name']
		);
		
		$where = array(
				'users_id' => $arrays['users_id']
		);
		
		$result = $this->db->update('users', $data, $where);
		return $result;
	}
	
	function update_users($arrays) {
		$modify_array = array(
				'users_name' => $arrays['modify_val']
		);
		
		$where = array(
				'users_id' =>$arrays['users_id']
		);
		$result = $this->db->update("users", $modify_array, $where);
		return $result;
	}
	
	function get_users(){
		$this->db->select('*');
		$query = $this->db->get("users");
		$result = $query->result();
		return $result;
	}
	
	function insert_users($arrays){
		$insert_array = array(
				'users_id' => $arrays['users_id'],
				'users_password' => $arrays['users_password'],
				'users_name' =>  $arrays['users_name'],
				'users_email' => $arrays['users_email'],
				'users_level' => $arrays['users_level'],
				'users_reg_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert('users', $insert_array);
		echo $this->db->last_query();
		exit;
		return $result;
	}
}