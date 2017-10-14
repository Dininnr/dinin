<?php
	
	require APPPATH . '/libraries/REST_Controller.php';

	class Book Extends REST_Controller{

    	function __construct($config = 'rest') {
        	parent::__construct($config);
        	//$this->load->library(array('database'));
		}


		//Untuk Menampilkan Data
		function index_get(){
			$data = $this->db->get('books')->result();
			return $this -> response($data,200);
		}

		//Untuk Mengirim Data
		function index_post(){
			$ISBN = $this->post('ISBN');
			$title = $this->post('title');
			$writer = $this->post('writer');
			$description = $this->post('description');

			$book = array(
				'title' 	 => $title,
				'ISBN' 		 => $ISBN,
				'writer'	 => $writer,
				'description'=> $description
			);

			//Masukan data (post)di body x-wwww key harus sama dengan array
			$insert = $this->db->insert('books',$book);

			if($insert){
				$this->response($book,200);
			}else{
				$data = array('status' => 'Gagal Insert Data');
				$this->response($data,502);
			}
		}
	}
?>