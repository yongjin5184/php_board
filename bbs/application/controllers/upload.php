<?php
class Upload extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model('board_m');
		$this->load->helper ( array ('form','url' ));
	}
	function index() {
		$this->load->view('upload_form', array ('error' => ' '));
	}
	function do_upload() {
		$config ['upload_path'] = './uploads/';
		$config ['allowed_types'] = 'gif|jpg|png|jpeg';
		$config ['max_size'] = '10000';
		$config ['max_width'] = '1280';
		$config ['max_height'] = '800';
		
		$this->load->library ( 'upload', $config );
		
		if (! $this->upload->do_upload ()) {
			$error = array (
					'error' => $this->upload->display_errors () 
			);
			
			echo "error";
			exit;
		} else {
			$data = array (
					'file_name' => $this->upload->data()['file_name'],
					'users_id' => $this->input->post('userid' , TRUE)
			);
			$file_name = $data['file_name'];
			$users_id = $this->input->post('userid' , TRUE);
			$result = $this->board_m->insert_users_profile_path($data);
			echo
  			"<script>
				alert('입력되었습니다.');
				location.href = 'http://localhost:8080/php_board/bbs/board/lists/board/';</script>"; 
  			exit;
		}
	}
}
?>