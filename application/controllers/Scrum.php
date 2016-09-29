<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scrum extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                                $this->load->library('session');
                $this->load->model('Scrum_model');
                $this->load->model('Note_model');
                //$this->load->model('comment_model');
                $ci=&get_instance();
        $db =$ci->load->database('pm',true);
                $this->load->helper('url');
             $user_right=$this->common_model->get_module_access_rights(6,$this->session->userdata('USER_ID'));

            if(empty($user_right))

            {

              $this->session->set_flashdata('ERR','you don\'t have sufficient permission to access this module');

              redirect(base_url());

              exit(0);

  }



  $this->crud_right=explode(',',$user_right['access']);

        }

      public function add_task()
        {
                 $card_id  =$this->input->post('new_card_id');        
                $task_name=$this->input->post('task_name');
                $assign_to  =$this->input->post('assign_to');
                $task_desc  =$this->input->post('task_desc');
                $task_pri  =$this->input->post('pri_task');
               /* $start_date  =$this->input->post('st_date');
                $deadline  =$this->input->post('dead_line');*/

$board_id = $this->Scrum_model->add_task($card_id,$task_name,$assign_to,$task_desc,$task_pri);
//echo $board_id;
       redirect("Scrum/view_board/".$board_id);
       


        }

        

          public function move_task()
        {
            
                 $task_id  =$this->input->post('task_id');        
              
               $assign_to  =$this->input->post('new_user_name'); 
               $card_id=$this->input->post('card_id');

               $board_id = $this->Scrum_model->move_task($task_id,$assign_to,$card_id);

              //echo $board_id;

       redirect("Scrum/view_board/".$board_id);

        }
        function add()

    {

      if(in_array('C',$this->crud_right))

      {

        $this->load->library('form_validation');

        $this->load->model('module_model');

        $data['modules']=$this->module_model->getAll();

        $data['user_name'] = $this->Scrum_model->get_all_user_name();

        $data['dept_name'] = $this->Scrum_model->get_all_dept();

        $this->load->view('front/pm_final/add-scrum',$data);

      }

      else

      {

        $this->session->set_flashdata('ERR','you don\'t have sufficient permission to access this module');

        redirect(base_url());

        exit(0);

      }

    }
    function add_action()
    {

      if(in_array('C',$this->crud_right))

      {

$uid=$this->session->userdata('USER_ID');

    $data['project_name']  = $this->input->post('proj_name');

    $data['project_head']  = $uid;
    $data['project_desc']    = $this->input->post('proj_desc');
    $data['project_team']       = $uid.','.implode(',',$this->input->post('proj_team'));
      $data['dept_assigned']       = $this->input->post('dept');
      $data['project_start']       = $this->input->post('start_date');
      $data['project_deadline']       = $this->input->post('deadline');
      $data['added_by']       = $uid;
      $date       = date("Y-m-d");
      $data['insert_date']=$date;
  
    
    
    
    //moving the uploaded file to destination folder
        $ci=&get_instance();
        $db =$ci->load->database('pm',true);
        if (!$db->insert('project_details',$data)) {

          die('Error: ' . mysqli_error($con));
      } 
       $this->session->set_flashdata('SUCCESS','<div class="uk-alert uk-alert-success" data-uk-alert=""><a href="#" class="uk-alert-close uk-close"></a>1 record added</div>');
          redirect('Scrum/add');  
        
    

      }

      else

      {

        $this->session->set_flashdata('ERR','you don\'t have sufficient permission to access this module');

        redirect(base_url());

        exit(0);

      }



    }
}
?>