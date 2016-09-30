<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scrum extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				
				//$this->load->model('comment_model');
                // $ci=&get_instance();                            
                // $db =$ci->load->database('pm',true);              // put this code in autoload.php  
                // $this->load->helper('url');                       // put this code in autoload.php
			    // $this->load->library('session');                 Put this code in autoload.php // $autoload['libraries']=array('database','session','url','form_validation');
                 
                
				$this->load->model('scrum_model');
                $this->load->model('note_model');
				$this->load->model('module_model');
                
                $user_right=$this->common_model->get_module_access_rights(6,$this->session->userdata('USER_ID'));

               if(empty($user_right)){
               $this->session->set_flashdata('ERR','you don\'t have sufficient permission to access this module');
               redirect(base_url());  // Redirect to base url
               exit(0);
               }
               $this->crud_right=explode(',',$user_right['access']);

              }

      public function add_task()
        {
			
			if(!empty($this->input->post('new_card_id')) && !empty($this->input->post('new_card_id')) )
		    {
			// Server side validation  
			$this->form_validation->set_rules('new_card_id', 'new card id', 'trim|required|xss_clean|htmlspecialchars');
			$this->form_validation->set_rules('task_name', 'task name', 'trim|required|xss_clean|htmlspecialchars|min_length[10]|max_length[100]');
			$this->form_validation->set_rules('assign_to', 'assign to', 'trim|required|xss_clean|htmlspecialchars');
			$this->form_validation->set_rules('task_desc', 'task description', 'trim|required|xss_clean|htmlspecialchars|min_length[10]|max_length[250]');
			$this->form_validation->set_rules('pri_task', 'pri task', 'trim|required|xss_clean|htmlspecialchars');
			
			if ($this->form_validation->run() == FALSE){
			    
				$data = array();
				$data['title'] = 'Scrum';
				$this->load->view('views/front/header', $data);
				$this->load->view('views/front/pm_final', $data);
				$this->load->view('views/front/footer', $data);
			
			} else {
			
					$this->Scrum_model->new_card_id   = $this->input->post('new_card_id');
					$this->Scrum_model->task_name     = $this->input->post('task_name');
					$this->Scrum_model->assign_to     = $this->input->post('assign_to');
					$this->Scrum_model->task_desc     = $this->input->post('task_desc');
					$this->Scrum_model->pri_task      = $this->input->post('pri_task');
					
					$this->Scrum_model->add_task(); 
					redirect("scrum/".$board_id);
			}
		 
		  }else {
		
		    $data['title'] = 'Scrum';
			$this->load->view('views/front/header', $data);
			$this->load->view('views/front/pm_final', $data);
			$this->load->view('views/front/footer', $data);
		}	
			
      }  

        

     public function move_task(){
		       
		   if(!empty($this->input->post('task_id')) && !empty($this->input->post('new_user_name')))
		   {
		   $this->Scrum_model->task_id         = $this->input->post('task_id');
		   $this->Scrum_model->new_user_name   = $this->input->post('new_user_name');
		   $this->Scrum_model->card_id         = $this->input->post('card_id');
		   $board_id                           = $this->scrum_model->move_task();
		   
		   if($board_id){
		    redirect("scrum/".$board_id);
		   }
		   
		   } 
         }
        
		
     public function add(){
	    $data = array();
        if(in_array('C',$this->crud_right)){
        $data['modules']=$this->module_model->getAll();
        $data['user_name'] = $this->Scrum_model->get_all_user_name();
        $data['dept_name'] = $this->Scrum_model->get_all_dept();
        $this->load->view('front/pm_final/add-scrum',$data);
       
	   }else{
        $this->session->set_flashdata('ERR','you don\'t have sufficient permission to access this module');
        redirect(base_url());
        exit(0);
       }
    }
	
    
	 public function add_action(){
	 
	 if(!empty($this->input->post('proj_name')) && !empty($this->input->post('proj_team')) )
		    {
			// Server side validation  
			$this->form_validation->set_rules('proj_name', 'project name', 'trim|required|xss_clean|htmlspecialchars|min_length[10]|max_length[70]');
			$this->form_validation->set_rules('proj_desc', 'project desc', 'trim|required|xss_clean|htmlspecialchars|min_length[10]|max_length[70]');
			$this->form_validation->set_rules('proj_team', 'project team', 'trim|required|xss_clean|htmlspecialchars');
			$this->form_validation->set_rules('dept', 'task department', 'trim|required|xss_clean|htmlspecialchars|min_length[10]|max_length[70]');
			$this->form_validation->set_rules('pri_task', 'pri task', 'trim|required|xss_clean|htmlspecialchars');
			
			if ($this->form_validation->run() == FALSE){
			
				$data = array();
				$data['title'] = 'Scrum';
				$this->load->view('views/front/header', $data);
				$this->load->view('views/front/pm_final', $data);
				$this->load->view('views/front/footer', $data);
			
			} else {
			        $uid                              = $this->session->userdata('USER_ID');
					$project_team                     = $uid.','.implode(',',$this->input->post('proj_team'));
					$this->scrum_model->proj_name     = $this->input->post('proj_name');
					$this->scrum_model->uid           = $uid;
					$this->scrum_model->project_team  = $project_team;
					$this->scrum_model->dept          = $this->input->post('dept');
					$this->scrum_model->start_date    = $this->input->post('start_date');
					$this->scrum_model->deadline      = $this->input->post('deadline');
					$this->scrum_model->added_by      = $uid;
					
					$this->scrum_model->add_task();
					redirect("scrum/".$board_id);
			}
		 
		  }else {
		    
			$data['title'] = 'Scrum';
			$this->load->view('views/front/header', $data);
			$this->load->view('views/front/pm_final', $data);
			$this->load->view('views/front/footer', $data);
		}	
	 
	 }
	
	
	 
}



