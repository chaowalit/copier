<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
        public function __construct() {
            parent::__construct();
			$this->load->model('m_register');
			$this->load->library('session');
        }
        
	public function index()
	{
		
	}
    public function saveRegister()
	{
		$en = $_POST['en'];
		$full_name = $_POST['full_name'];
		$department = $_POST['department'];
		$cost_center = $_POST['cost_center'];
		$login_id = $_POST['login_id'];
		$manager = $_POST['manager'];
		$ext = $_POST['ext'];
		$enOld = $_POST['enOld'];
		$transaction = $_POST['btnCheckButton'];
		
		if($transaction == "register"){
			$result = $this->m_register->saveRegisterToDB($en,$full_name,$department,$cost_center,$login_id,$manager,$ext);
			if($result){
				$this->session->set_flashdata('msg', 'Save User Data Successfully...');
			}else{
				$this->session->set_flashdata('msg', 'Can not Save User Data');
			}
			redirect('c_copier/registerLoadView');
		}else if($transaction == "update"){
			$result = $this->m_register->updateEditUserToDB($en,$full_name,$department,$cost_center,$login_id,$manager,$ext,$enOld);
                        if($result){
				$this->session->set_flashdata('msg', 'Update User Data Successfully...');
			}else{
				$this->session->set_flashdata('msg', 'Can not Save User Data');
			}
			redirect('c_copier/registerLoadView');
		}
		
	}
	public function searchUser(){
		$input = $this->input->post('myInput');
		$result = $this->m_register->getSearchUser($input);
		$myData;
		foreach($result as $row){
			if($row->EN != ""){
				$myData[] = $row->EN." - ".$row->Full_Name;
			}
		}
		if(isset($myData)){
			foreach($myData as $val){
				echo "<div class='toolTip'><a href='#'>".$val."</a></div>";
			}
		}
	}
	public function getResultSearchUser(){
		$input = $this->input->post('keywordSearch');
		
		$words = explode("-", $input); // now split by space
		$words = trim($words[0]);
		$result = $this->m_register->getSearchUserList($words);
		$data;
		foreach($result as $row){
			$data = array(
				"en" => $row->EN,
				"full_name" => $row->Full_Name,
				"department" => $row->Department,
				"cost_center" => $row->Dept_code,
				"login_id" => $row->Login_ID,
				"manager" => $row->Manager,
				"ext" => $row->Ext
			);
		}
		echo json_encode($data);
	}
	public function editUserMember(){
		$input = $this->input->post('keywordSearch');
		$words = trim($input);
		
		$result = $this->m_register->getEditDataUser($words);
		$data;
		foreach($result as $row){
			$data = array(
				"en" => $row->EN,
				"full_name" => $row->Full_Name,
				"department" => $row->Department,
				"cost_center" => $row->Dept_code,
				"login_id" => $row->Login_ID,
				"manager" => $row->Manager,
				"ext" => $row->Ext
			);
		}
		echo json_encode($data);
	}
	public function deleteUserMember(){
		$input = $this->input->post('keywordSearch');
		$words = trim($input);
		
		$result = $this->m_register->setDeleteDataUser($words);
		if($result){
			echo "EN is ".$words."  has been deleted...Successfully !!" ;
		}
	}
        public function searchUserCopy(){
            $input = $this->input->post('myInput');
            $result = $this->m_register->getSearchUserCopy($input);
		$myData;
		foreach($result as $row){
			if($row->EN != ""){
				$myData[] = $row->EN." - ".$row->Full_Name;
			}
		}
		if(isset($myData)){
			foreach($myData as $val){
				echo "<div class='toolTip'><a href='#'>".$val."</a></div>";
			}
		}
        }
        public function getResultSearchUserCopy(){
            $input = $this->input->post('keywordSearch');
		
            $words = explode("-", $input); // now split by space
            $words = trim($words[0]);
            $result = $this->m_register->getSearchUserListCopy($words);
            $data = array();
            foreach($result as $row){
                $row_array["id"] = $row->ID;
                $row_array["en"] = $row->EN;
                $row_array["full_name"] = $row->Full_Name;
                $row_array["department"] = $row->Department;
                $row_array["cost_center"] = $row->Dept_Code;
                $row_array["login_id"] = $row->Login_ID;
                $row_array["manager"] = $row->Manager;
                $row_array["ext"] = $row->Ext;
                $row_array["activity"] = $row->Activity;
                $row_array["amount"] = $row->amount;
                $row_array["date"] = $row->date;
                array_push($data, $row_array);
            }
            echo json_encode($data);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */