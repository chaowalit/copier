<?php
	class M_report extends CI_Model{
                function getDataSearchExport($start_date, $end_date){
                    $this->db->select('*');
			$this->db->from('copy');
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=',$end_date);
                        $this->db->order_by('Department','asc');
			$query = $this -> db -> get();
			return $query->result();
                }
                function setDeleteDataActivity($id){
                    $this->db->where('ID', $id);
                    $result = $this->db->delete('copy');
                    return $result;
                }
	}
        
?>