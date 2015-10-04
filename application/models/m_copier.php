<?php
	class M_copier extends CI_Model{
		function getDBFromMemberTable($barCode){
			$this->db-> select('*');
			$this->db->from('member');
			$this->db->where('EN',$barCode);
			$query = $this -> db -> get();
			return $query->result();
		}
                function saveCopier($en,$full_name,$department,$cost_center,$login_id,$manager,$ext,$activity,$amount,$date){
                    $data = array(
				"EN" => $en,
				"Full_Name" => $full_name,
				"Department" => $department,
				"Dept_Code" => $cost_center,
				"Login_ID" => $login_id,
				"Manager" => $manager,
				"Ext" => $ext,
                                "Activity" => $activity,
                                "amount" => $amount,
                                "date" => $date
                    );
                    $result = $this->db->insert('copy',$data);
                    return $result;
                }
	}
        
?>