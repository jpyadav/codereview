<?php

class Scrum_model extends CI_Model {

private $board_id;
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
                $ci=&get_instance();
        $db =$ci->load->database('pm',true);
          $this->load->model('Log_model');

        }
function add_board($board_name,$board_team,$cur_board_id){

 $ci=&get_instance();
        $db =$ci->load->database('pm',true);
        //echo $cur_board_id;
        //die;
        $query1=$db->query("select * from project_board where board_id=".$cur_board_id)->row();

        if(isset($query1))
        {
          $proj_id=$query1->project_id;
        }
// $this->session->userdata('proj_id');
$user_id=$this->session->userdata('USER_ID');
if($board_team!='')
$team=$user_id.",".$board_team;
else
$team=$user_id;
date_default_timezone_set("Asia/Calcutta");
$date       = date("Y-m-d");

    $data = array(
   'board_name' => $board_name ,
   'project_id' => $proj_id ,
        'start_date' => $date,
        'added_by' =>$user_id,
        'board_team'=>$team


);

if($db->insert('project_board', $data))
{
    $board_id=$db->insert_id();
return $board_id;
}
else
return $cur_board_id."failure".$proj_id.$query1; 

}
}
?> 