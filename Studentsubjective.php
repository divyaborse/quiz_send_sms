<?php

class Studentsubjective extends CI_Controller{

    public function index() {
        $this->load->model('Model_final_quiz');

 $query['query']= $this->Model_final_quiz->display_subquiz_score();
 $data['page_title'] = 'Quiz Summary';
 $this->load->view('accounthquiz', $data);
       $this->load->view('Subjective_quiz_summary',$query);

        //$this->load->view('accountfooter');

    }
    public function summary($q_id){
        $this->load->model('Model_final_quiz');
            $data['page_title'] = 'Quiz Summary';
            $summary['summary'] = $this->Model_final_quiz->show_summary($q_id);
            
            $this->load->view('accounthquiz', $data);
            $this->load->view('Subjective_summary', $summary);
            $this->load->view('accountfooter');
    }

    

}


?>