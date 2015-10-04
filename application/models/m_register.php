<?php
	class M_register extends CI_Model{
	
		function saveRegisterToDB($en,$full_name,$department,$cost_center,$login_id,$manager,$ext){
			$data = array(
				"EN" => $en,
				"Full_Name" => $full_name,
				"Department" => $department,
				"Dept_code" => $cost_center,
				"Login_ID" => $login_id,
				"Manager" => $manager,
				"Ext" => $ext
			);
			$result = $this->db->insert('member',$data);
			return $result;
		}
		function getMemberShow($per_page, $uri){
			$this->db-> select('*');
			$this->db->from('member');
			$this->db->order_by('Full_Name','asc');
			$this->db->limit($per_page, $uri);
			$query = $this -> db -> get();
			return $query->result();
		}
		function getSearchUser($input){
			$this->db->select('*');
			$this->db->from('member');
			$this->db->like('EN', $input);
			$this->db->or_like('Full_Name',$input);
                        $this->db->order_by('Full_Name','asc');
			$this->db->limit(10);
			$query = $this -> db -> get();
			return $query->result();
		}
		function getSearchUserList($input){
			$this->db->select('*');
			$this->db->from('member');
			$this->db->where('EN', $input);
			$query = $this -> db -> get();
			return $query->result();
		}
		function getEditDataUser($en){
			$this->db->select('*');
			$this->db->from('member');
			$this->db->where('EN', $en);
			$query = $this -> db -> get();
			return $query->result();
		}
		function updateEditUserToDB($en,$full_name,$department,$cost_center,$login_id,$manager,$ext,$enOld){
			$data = array(
				"EN" => $en,
				"Full_Name" => $full_name,
				"Department" => $department,
				"Dept_code" => $cost_center,
				"Login_ID" => $login_id,
				"Manager" => $manager,
				"Ext" => $ext
			);
			$this->db->where('EN', $enOld);
			$result = $this->db->update('member', $data); 
			return $result;
		}
		function setDeleteDataUser($words){
			$this->db->where('EN', $words);
			$result = $this->db->delete('member');
			return $result;
		}
                function getCopierReport($per_page,$uri){
                    $this->db-> select('*');
                    $this->db->from('copy');
                    $this->db->order_by('date','desc');
                    $this->db->limit($per_page, $uri);
                    $query = $this -> db -> get();
                    return $query->result();
                }
                function getSearchUserCopy($input){
                    $this->db->select('*');
			$this->db->from('copy');
			$this->db->like('EN', $input);
			$this->db->or_like('Full_Name',$input);
                        $this->db->order_by('Full_Name','asc');
                        $this->db->group_by('EN');
			$this->db->limit(10);
			$query = $this -> db -> get();
			return $query->result();
                }
                function getSearchUserListCopy($words){
                    $this->db->select('*');
                    $this->db->from('copy');
                    $this->db->where('EN', $words);
                    $this->db->order_by('date','desc');
                    $query = $this -> db -> get();
                    return $query->result();
                }
	}
?>