<?php
class Scrum_model extends CI_Model {

        private $board_id;
		
        public function __construct()
        {
                //$this->load->database();
                //$this->load->library('session');
                //$ci=&get_instance();
                //$db =$ci->load->database('pm',true);
                $this->load->model('Log_model');
				date_default_timezone_set("Asia/Calcutta");

        }
		
		
		/*function add_task(){
	     
		     $sql_query = 'insert into table_name(new_card_id, task_name, assign_to, task_desc, pri_task) values(?,?,?,?,?)';
		      $this->db->query($sql_query,array($this->new_card_id, $this->task_name, $this->assign_to, $this->task_desc,$this->pri_task));
		    return ($this->db->affected_rows() != 1) ? false : true;	
		}*/
		
		
		function move_task(){
	       
		     $sql_query = 'insert into table_name(task_id, new_user_name, card_id) values(?,?,?)';
		      $this->db->query($sql_query,array($this->task_id, $this->new_user_name, $this->card_id));
		    return ($this->db->affected_rows() != 1) ? false : true;	
		
		
		}
		
		
		
		function add_task(){
	         $ip = $this->input->ip_address();
		     $sql_query = 'insert into project_details(proj_name, uid, project_team, dept, start_date, deadline, ip, added_by) values(?,?,?,?,?,?,?,?)';
		      $this->db->query($sql_query,array($this->proj_name, $this->uid, $this->project_team, $this->dept,$this->start_date, $this->deadline, $ip, $this->added_by));
		    return ($this->db->affected_rows() != 1) ? false : true;	
		}
		
		
		

}



