<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Board extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('board_m');
    $this->load->library('encrypt');
    $this->load->library('session');
    $this->load->helper(array('url','date'));
    $this->load->helper('form');
    $this->load->helper('url');
  }

  public function index(){
    $this->lists();
  }

  /**
   * 사이트 헤더, 푸터를 자동으로 추가해준다.
   *
   */
  public function _remap($method)
  {
  	$exe = array('auth');
  	if(!in_array($method, $exe)){
	    //헤더 include
	    $this->load->view('header_v');
	
	    if( method_exists($this, $method) )
	    {
	      $this->{"{$method}"}();
	    }
	    //푸터 include
	    $this->load->view('footer_v');
  	}else{
  		if(method_exists($this, $method)){
  			$this->{"{$method}"}();
  		}
  	}
  }

  public function lists($search_word = ""){
	$table_name = $this->uri->segment(3);
  	//페이지네이션 라이브러리 로딩 추가
  	$this->load->library('pagination');
  	//페이지네이션 설정
  	$config['base_url'] = '/php_board/bbs/board/lists/board/page'; //페이징 주소
  	$config['total_rows'] = $this->board_m->get_list($table_name, 'count'); //전체 로우 수
  	$total_rows = $config['total_rows']; // 전체 로우 수 변수
  	$config['per_page'] = 5; //한 페이지에 표시할 게시물 수 
  	$config['per_segment'] = 5; // 다섯 번째 세그먼트를 페이지 변수로 사용하겠다는 뜻.
    $data['list'] = $this->board_m->get_list($table_name);//페이지네이션 초기화
    $this->pagination->initialize($config);//페이징 링크를 생성하여 view에서 사용할 변수에 할당
    $data['pagination'] = $this->pagination->create_links(); //data에 담아 pagination view로 보냄
    
    $page = $this->uri->segment(5, 1);
//     echo "페이지: " . $page; // 1, 5, 10, 15
    
    if( $page > 1){
    	$start = (ceil($page/$config['per_page'])) * $config['per_page']; 
    }else{
    	$start = ($page - 1) *$config['per_page'];  
    }
//     echo "스타트: " . $start; // 0, 5, 10, 15
    
    //1.페이징 변수를 넘겨서 
    if($page > 1){
    	$my_page = $page / 5; // pagination 넘버 
    }else{
    	$my_page = 0; 
    }
//     echo "마이페이지: " . $my_page; // 0, 1, 2, 3
    
    $limit = $config['per_page'];
    $data['list'] = $this->board_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
    $data['total_rows'] = $total_rows;
    $data['page'] = $my_page; //2.페이징 변수를 넘겨서 게시판 자동 넘버 처리
    $this->load->view('board/list_v', $data);
  }
  
/**
 * 게시물 찾기
 */
  function search(){
  		$search_word = $_POST['search_word'];
  		$this->lists($search_word);
  }
  
  /**
   * 게시물 보기
   */
  function view(){
  	//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
  	$board_name = $this->uri->segment(3);
  	$table_name = $this->uri->segment(5);
  	$visited_page = $this->session->userdata['visited_page'];
  	$rownum = $this->input->post('rownum' , TRUE); //rownum 만 넘어 왔을 때 페이징 처리를 위해
  	if(!in_array($rownum, $visited_page)){
  		array_push($visited_page, $rownum);
  		$result_hit = $this->board_m->update_hits($table_name);
  		$sess_array = array(
  				'visited_page' => $visited_page
  		);
  		$this->session->set_userdata($sess_array);
  	}
  	
  	$total_rows = $this->board_m->get_list($board_name, 'count');
  	$my_page = $total_rows - $rownum;
  	$result = $this->board_m->get_view($board_name, $table_name,'board_comment');
  	
  	$data = array(
  			"result" => $result,
  			"rownum" => $rownum,
  			"my_page" => $my_page
  	);
  	$this->load->view('board/view_v', $data);
  	// id가 null이 아닐때만 댓글 등록 
  	$id = $this->input->post('id', TRUE);
  	if($_POST && $id != ''){
  		$write_data = array(
  				'board_id' => $this->input->post('board_id', TRUE),
				'id' => $this->input->post('id', TRUE),
				'contents' => $this->input->post('contents' , TRUE)
		);
  		$result_ci_re_board = $this->board_m->insert_reply_board($write_data);
  		if($result_ci_re_board){
  			//글 작성 성공시 게시판 목록으로
  			echo
  			"<script>
				alert('입력되었습니다.');
				location.href = '/php_board/bbs/board/view/board/board_id/" .$this->uri->segment(5)."';</script>"; 
  			exit;
  		}else{
  			//글 실패시 게시판 목록으로
  			echo
  			"<script>
				alert('다시 입력해 주세요.');
  				location.href = '/php_board/bbs/board/view/board/board_id/" .$this->uri->segment(5)."';</script>"; 
  			exit;
  		}
  	}
  }
  /**
   * 게시물 쓰기
   */
	function write(){
		echo '<meta http-eqiv="Content-Type" content="text/html; charset="utf-8"/>';
		if($_POST){
			// 글쓰기 POST 전송시
			$write_data = array(
					'id' => $this->input->post('id', TRUE),
					'username' => $this->input->post('username', TRUE),
					'subject' => $this->input->post('subject', TRUE),
					'contents' => $this->input->post('contents' , TRUE),
					'table' => $this->uri->segment(3)
			);
			$result = $this->board_m->insert_board($write_data);
			if($result){
				//글 작성 성공시 게시판 목록으로
				echo
				"<script>
					alert('입력되었습니다.'); 
					location.href = '/php_board/bbs/board/lists/board/board_id/'; 
				</script>";
				exit;
			}else{
				//글 실패시 게시판 목록으로
				echo
				"<script>
					alert('다시 입력해 주세요.');
				</script>";
				exit;
			}
		}else{
			$this->load->view('board/write_v');
		}
	}
	/**
	 * 게시물 수정
	 */
	function modify(){
		echo '<meta http-eqiv="Content-Type" content="text/html; charset="utf-8"/>';
		if($_POST){
			$modify_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'board_id' => $this->uri->segment(5), //게시물 번호
					'board_subject' => $this->input->post('board_subject', TRUE),
					'board_contents' => $this->input->post('board_contents', TRUE),
			);
			
			$result = $this->board_m->modify_board($modify_data);
			
			if($result){
				//글 수정 성공시 게시판 목록으로
				echo
				"<script>
					alert('수정되었습니다.');
					location.href = '/php_board/bbs/board/lists/board/board_id/';
				</script>";
				exit;
			}else{
				//글 수정 실패시 게시판 목록으로
				echo
				"<script>
					alert('다시 입력해 주세요.');
				</script>";
				exit;
			}
		}else{
			$data['views'] = $this->board_m->get_view($this->uri->segment(3), $this->uri->segment(5));
			$this->load->view('board/modify_v', $data);
		}
	}
	
	function delete(){
		$result = $this->board_m->delete_board($this->uri->segment(3), $this->uri->segment(5));
		if($result){
			//글 삭제 성공시 게시판 목록으로
			echo
			"<script>
				alert('삭제되었습니다.');
				location.href = '/php_board/bbs/board/lists/board/board_id/';
			</script>";
			exit;
		}
	}
	/*
	 *  로그인
	 */
	function auth(){
		$users_id =  $this->input->post('id');
		$users_password = $this->input->post('password');
		$data = $this->board_m->select_users($users_id, $users_password);
		$visited_page = array();
		if($data != null){
			$username = $data['users_name'];
			$email = $data['users_email'];
			$level = $data['users_level'];
			$id = $data['users_id'];
			$users_profile_path = $data['users_profile_path'];
			$sess_array = array(
				'username' => $username,
				'email' => $email,
				'level' =>$level,
				'id' => $id,
				'users_profile_path' => $users_profile_path,
				'logged_in' =>TRUE,
				'visited_page' => $visited_page
			);
 			$this->session->set_userdata($sess_array);
			echo json_encode($sess_array);
		}else{
			echo "null";
		}
	}
	/*
	 * 로그아웃
	 */
	function logout(){
		$this->session->sess_destroy();
		echo
		"<script>
				alert ('로그아웃 되었습니다.', '/php_board/bbs/board/lists/board');
				location.href = '/php_board/bbs/board/lists/board/';
		</script>";
		exit;
	}
	
	function modify_where(){
		$modify_val =  $this->input->post('modify_val');
		$users_id = $this->input->post('users_id');
		$modify_data = array(
				'modify_val' => $modify_val,
				'users_id' => $users_id
		);
		$data = $this->board_m->update_users($modify_data);
		echo "성공";		
	}
	
	function get_users(){
		$data = $this->board_m->get_users();
	}
	
	function insert_users(){
		$users_id =  $this->input->post('users_id');
		$users_password = $this->input->post('users_password');
		$en_users_password = $this->encrypt->encode($users_password);
		$users_name = $this->input->post('users_name');
		$users_email = $this->input->post('users_email');
		$users_level = $this->input->post('users_level');
		$insert_data = array(
				'users_id' => $users_id, 
				'users_password' => $en_users_password, 
				'users_name' => $users_name,
				'users_email' => $users_email,
				'users_level' => $users_level
		);
		$data = $this->board_m->insert_users($insert_data);
	}
}
