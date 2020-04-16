<?php

class Teacher_ques extends CI_Controller{
	 function __construct() {
        parent::__construct();
        $this->load->model('Model_final_quiz'); 
    }
	public function index(){
		$this->load->model('Model_final_quiz');
		$result['result'] = $this->Model_final_quiz->teacher_questions();
		//$this->load->view('Teacher_view',$result);
		$this->load->view('report_sub_quiz',$result);
	}
	public function open_ans(){
		if(isset($_POST['submit'])){

		$q_id = $this->input->post("hidden_id");
		$this->load->model('Model_final_quiz');
		$output['output']=$this->Model_final_quiz->show_ans($q_id);
		$this->load->view('Add_score',$output);

		

	}

	}
	public function store_score(){
		if(isset($_POST['submit'])){
			$count  = count($_POST['score']);
			$score = 0;
			//$itemValues=0;
			for($i=0;$i<$count;$i++) {
				if(!empty($_POST["score"][$i])){
					$score = $score + $_POST["score"][$i];
					//$itemValues++;
				}

			}
			//$score = $_POST['score'];
			$q_id = $this->input->post("hidden_id");
			$this->load->model('Model_final_quiz');
			$this->Model_final_quiz->save_score($q_id,$score);
			echo "Score saved";
		}
	}
	
}


?>