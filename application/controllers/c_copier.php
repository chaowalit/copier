<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_copier extends CI_Controller {

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
			$this->load->model('m_copier');
			$this->load->model('m_register');
			$this->load->library('session');
        }
        
	public function index()
	{
		$this->load->view('copier');
	}
        
    public function registerLoadView()
    {
		$this->load->library("pagination");
		$config['base_url'] = base_url()."index.php/c_copier/registerLoadView";
		$config['per_page'] = 10;
		$config['total_rows'] = $this->db->count_all("member");
		$config['full_tag_open'] = '<div class="pagination_list_user">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
		$data['result'] = $this->m_register->getMemberShow($config['per_page'], $this->uri->segment(3));
		
		$this->load->view('register',$data);
    }
	
	public function reportLoadView()
    {
		$this->load->view('report');
    }
	public function getMemberToCopier()
	{
		$barCode = $_POST['barCodeData'];
		$result = $this->m_copier->getDBFromMemberTable($barCode);
		
		$data;
		foreach($result as $row){
			$data = array(
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
        public function saveCopierActivity() {
            $en = $_POST['en'];
            $full_name = $_POST['full_name'];
            $department = $_POST['department'];
            $cost_center = $_POST['cost_center'];
            $login_id = $_POST['login_id'];
            $manager = $_POST['manager'];
            $ext = $_POST['ext'];
            $activity = $_POST['activity'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            
            $result = $this->m_copier->saveCopier($en,$full_name,$department,$cost_center,$login_id,$manager,$ext,$activity,$amount,$date);
            if($result){
                echo "Sava data for Copier successfully...";
            }else{
                echo "can not save data for Copier...";
            } 
            
        }
        public function reportView(){
            $this->load->library("pagination");
            $config['base_url'] = base_url()."index.php/c_copier/reportView";
            $config['per_page'] = 15;
            $config['total_rows'] = $this->db->count_all("copy");
            $config['full_tag_open'] = '<div class="pagination_list_user">';
            $config['full_tag_close'] = '</div>';

            $this->pagination->initialize($config);

            $data['result'] = $this->m_register->getCopierReport($config['per_page'], $this->uri->segment(3));
            $this->load->view('report',$data);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */