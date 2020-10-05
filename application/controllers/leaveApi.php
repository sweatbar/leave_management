<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class leaveApi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('leaveApiModel');
        $this->load->library('form_validation');
    }

    function user($employee_id)
	{
        if(!is_null($employee_id)){
            $data = $this->leaveApiModel->fetch_employee_leave($employee_id);
            if($data) {
                echo json_encode($data);
            }
        }
    }
    
    function insert()
	{
        $this->form_validation->set_rules('employee_name', 'Employee name', 'required');
        $this->form_validation->set_rules('leave_date', 'Leave date', 'required');
        $this->form_validation->set_rules('leave_type_id', 'Leave type', 'required');
        
        if($this->form_validation->run()) {

            $data = [
                'employee_id' => $this->input->post('employee_id'),
                'leave_date' => $this->input->post('leave_date'),
                'leave_type_id' => $this->input->post('leave_type_id'),
                'leave_reason' => $this->input->post('leave_reason'),
            ];

            $this->leaveApiModel->insert_leave($data);

            $array = [
                'success' => true,
                'statusCode' => 200,
            ];

        }
        else {
            $array = [
                'error' => true,
                'employee_name_error' => form_error('employee_name'),
                'leave_type_error' => form_error('leave_type_id'),
                'leave_date_error' => form_error('leave_date'),
            ];
        }

        echo json_encode($array);
    }
    
    function leave($leave_id=0)
	{
        if(!is_null($leave_id)) {
           $data = $this->leaveApiModel->fetch_leave_by_id($leave_id); 

           //print_r($data);
           
           foreach ($data as $row) {
               $output['leave_id'] = $leave_id;
               $output['employee_name'] = $row['employee_name'];
               $output['employee_id'] = $row['employee_id'];
               $output['leave_date'] = $row['leave_date'];
               $output['leave_type_id'] = $row['leave_type_id'];
               $output['leave_reason'] = $row['leave_reason'];
           }
           echo json_encode($output);
        }
		
    }
    
    function update()
	{
		if(!is_null($this->input->post('leave_id'))) {

            $this->form_validation->set_rules('employee_name', 'Employee name', 'required');
            $this->form_validation->set_rules('leave_date', 'Leave date', 'required');
            $this->form_validation->set_rules('leave_type_id', 'Leave type', 'required');
            
            if($this->form_validation->run()) {
                $data = [
                    'employee_id' => $this->input->post('employee_id'),
                    'leave_date' => $this->input->post('leave_date'),
                    'leave_type_id' => $this->input->post('leave_type_id'),
                    'leave_reason' => $this->input->post('leave_reason'),
                ];

                $this->leaveApiModel->update_leave($data, $this->input->post('leave_id'));

                $array = [
                    'success' => true,
                    'statusCode' => 202
                ];
            }
            else {
                $array = [
                    'error' => true,
                    'employee_name_error' => form_error('employee_name'),
                    'leave_type_error' => form_error('leave_type_id'),
                    'leave_date_error' => form_error('leave_date'),
                ];
            }
            echo json_encode($array);
        }
    }
    
    function delete($leave_id) 
	{
		if(!is_null($leave_id)) {
           if($this->leaveApiModel->delete_leave($leave_id)) {
                $array = array(
                    'success' => true,
                    'statusCode' => 200,
                );
           }
           else{
                $array = array(
                    'error' => true,
                );
           }
           echo json_encode($array); 
           
        }
        
        
	}
}