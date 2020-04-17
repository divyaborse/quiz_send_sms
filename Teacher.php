<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Teacher extends CI_Controller {
	public function index() {
		if ($this->session->userdata('teacherlogin')['id']) {

			redirect(base_url() . 'Teacher/dashboard');
		}
		redirect(base_url());
	}
	public function login() {

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$teacher_login = array(
				'email' => htmlspecialchars((strip_tags(trim($this->input->post('t_email'))))),
				'password' => md5(htmlspecialchars(strip_tags(trim($this->input->post('t_password'))))),
			);
			$this->load->model('Model_teacher', 'mt');
			$result_login = $this->mt->login_teacher($teacher_login);

			if ($result_login == true) {
				$resultlogin = $this->mt->getteacherData(htmlspecialchars(strip_tags(trim($this->input->post('t_email')))));
				print_r($resultlogin);
				$session_data = array(
					'id' => $resultlogin[0]['id'],
					'name' => $resultlogin[0]['name'],
					'email' => $resultlogin[0]['email'],
					'contact' => $resultlogin[0]['contact'],
					'gender' => $resultlogin[0]['gender'],
					'type' => $resultlogin[0]['type'],
					'school' => $resultlogin[0]['school'],
				);
				// Add user data in session
				$this->session->set_userdata('teacherlogin', $session_data);
				if ($this->session->userdata('studentlogin')['id']) {
					$this->session->unset_userdata('studentlogin');
				}
				//activity track
				$this->load->model('Model_clientIP');
				date_default_timezone_set('Asia/Kolkata');
				$activity = array(
					'user_id' => $this->session->userdata('teacherlogin')['id'],
					'user_name' => $this->session->userdata('teacherlogin')['name'] . '(' . $this->session->userdata('teacherlogin')['school'] . ')',
					'system_info' => php_uname(),
					'activity_name' => 'school_' . $resultlogin['type'] . '_teacher_login',
					'access_date_time' => date('Y-m-d H:i:s', time()),
				);

				$this->Model_clientIP->user_Activity($activity);
				//actiivty track end
				redirect(base_url() . 'Teacher/dashboard');
			} else {
				$cdata = array(
					'flag' => 40,
				);

				$this->session->set_flashdata('o_register', $cdata);
				redirect(base_url());
			}
		}
	}
	public function dashboard() {
		if (!$this->session->userdata('teacherlogin')['id']) {

			redirect(base_url());
		}

		$data['page_title'] = 'Intelify | Teacher';
		$this->load->model('Model_quiz', 'mq');
		$data['quiz'] = $this->mq->show_quiz($this->session->userdata('teacherlogin')['id']);
		$data['share'] = $this->mq->share($this->session->userdata('teacherlogin')['id']);
		
		$this->load->view('accountheader', $data);
		$this->load->view('teacher_dashboard', $data);
		$this->load->view('accountfooter', $data);

	}
	public function dshboard_sub(){
		if (!$this->session->userdata('teacherlogin')['id']) {

			redirect(base_url());
		}
		$data['page_title'] = 'Intelify | Teacher';
		$this->load->model('Model_final_quiz');
		$data['data']=$this->Model_final_quiz->display_quizname();
		$data['display'] = $this->Model_final_quiz->fetch_student();


		$this->load->view('accounthquiz');
		$this->load->view('Subjective', $data);
		$this->load->view('accountfooter');
	}
	public function add_contact_form() {
		if (!$this->session->userdata('teacherlogin')['id']) {

			redirect(base_url());
		}
		$this->load->model('Model_quiz', 'mq');
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$data1 = array(
				'teacher_id' => $this->session->userdata('teacherlogin')['id'],
				'student_contact_name' => $this->input->post('stdname'),
				'student_contact_number' => $this->input->post('stdcontact'),
				'student_class' => $this->input->post('class'),
			);
			$this->mq->add_contact($data1);
			redirect('Teacher/dashboard');
		}
	}
	public function share_url() {
		if (!$this->session->userdata('teacherlogin')['id']) {

			redirect(base_url());
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$url = $this->input->post('url');
			//	$stdchoosen['choose'] = $this->input->post('stdchoosen');

			$stdchoosen = '91' . implode('", "91', $this->input->post('stdchoosen'));

			// echo "<pre>";
			// print_r($stdchoosen);
			// print_r($url);
			// redirect('Teacher/dashboard',$url);
			if (filter_var($stdchoosen, FILTER_SANITIZE_NUMBER_INT)) {

				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "{ \"sender\": \"INTLFY\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"Your Quiz link is here " . $url . "\", \"to\": [ \"" . $stdchoosen . "\" ] } ] }",
					CURLOPT_SSL_VERIFYHOST => 0,
					CURLOPT_SSL_VERIFYPEER => 0,
					CURLOPT_HTTPHEADER => array(
						"authkey: 307315AL7iQXSUHCz5dea5f24",
						"content-type: application/json",
					),
				));
				if (curl_exec($curl)) {

					$this->session->set_flashdata('loginnotify', 'URL shared successfully');
					curl_close($curl);
					redirect(base_url() . 'Teacher/dashboard');
				} else {
					$this->session->set_flashdata('loginnotify', 'Somthing went wrong');
				}

			} else {
				$this->session->set_flashdata('loginnotify', 'Somthing went wrong');

				// Process your response here

			}

		}

	}
	public function remove_session() {
		if (isset($this->session->userdata('quiz_data')['q_id'])) {
			$this->session->unset_userdata('quiz_data');
		}
		redirect(base_url() . '/teacher/dashboard');
	}
	public function quiz_users() {
		if (!$this->session->userdata('teacherlogin')['id']) {

			redirect(base_url());
		} else {
			$data['page_title'] = 'Intelify | Teacher';
			$this->load->model('Model_quiz', 'mq');
			$data['quiz_users'] = $this->mq->fetch_quiz_users($this->uri->segment(3));
			$this->load->view('accountheader', $data);
			if ($data['quiz_users']) {
				$this->load->view('quiz_user_list');
			} else {
				$this->load->view('quiz_user_list', $data);
			}
			$this->load->view('accountfooter');
		}
	}
	public function logout() {
		if ($this->session->userdata('teacherlogin')) {
			//activity track
			$this->load->model('Model_clientIP');
			date_default_timezone_set('Asia/Kolkata');
			$activity = array(
				'user_id' => $this->session->userdata('teacherlogin')['id'],
				'user_name' => $this->session->userdata('teacherlogin')['name'] . '(' . $this->session->userdata('teacherlogin')['school'] . ')',
				'system_info' => php_uname(),
				'activity_name' => 'school_' . $this->session->userdata('teacherlogin')['type'] . '_teacher_login',
				'access_date_time' => date('Y-m-d H:i:s', time()),
			);

			$this->Model_clientIP->user_Activity($activity);
			//actiivty track end
			$this->session->unset_userdata('teacherlogin');
			redirect(base_url() . 'Teacher');
		} else {
			redirect(base_url());
		}
	}
		public function show(){
		$this->load->model('Model_final_quiz');
	$data['data']=$this->Model_final_quiz->fetch_data($this->input->post("hidden_id"));
	$this->load->view('attempt_quiz',$data);
	
	}
	public function apply(){
		$this->load->model('Model_final_quiz');
		$id = $this->uri->segment(3);
		$data['data']= $this->Model_final_quiz->get_data($id);
		$this->load->view('attempt_quiz',$data);


	}
	
	
	public function contact(){


		if(isset($_POST['submit'])){
			$name = $_POST['Student_name'];
			$number=$_POST['Number'];
			foreach ($_POST['Class'] as $select)
{
$class = $select; // Displaying Selected Value
} 
			
		$this->load->model('Model_final_quiz');
		$this->Model_final_quiz->stu_contact($name,$number,$class);
		

	}
	}	
public function user_list(){
		if (!$this->session->userdata('teacherlogin')['id']) {

			redirect(base_url());
		} else {
			$data['page_title'] = 'Intelify | Teacher';
			$this->load->view('accounthquiz', $data);
		$id = $this->uri->segment(3);
		$this->load->model('Model_final_quiz');
		$data['query']= $this->Model_final_quiz->check_user($id);
		if ($data['query']) {
			$this->load->view('Subquiz_user_list', $data);
				
			} else {
				$this->load->view('Subquiz_user_list');
			}
			
		$this->load->view('accountfooter');
	}
	}
}
?>