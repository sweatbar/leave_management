<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class leaveGrid extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('leaveApiModel');
    }

    function index()
	{
		//assume a user is logged in
        $_SESSION['employee_id'] = 1;

        $_SESSION['employee_name'] = $this->leaveApiModel->fetch_employee_name($_SESSION['employee_id']);

        //fetch leave types
        $data['leave_types'] = $this->leaveApiModel->fetch_leave_types();

        $this->load->view('leave_grid', $data);
        
    }
    
    public function fetchEmployeeLeave() {

        //pass user id through login session
        $api_url = USER_LEAVE_API_URL . $_SESSION['employee_id'];

        /*$arr = array(
            'url' => $api_url
        );
        echo json_encode($arr);*/

        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);

        $data['result'] = json_decode($response);
        $this->load->view('leave_data', $data);
       
    }

    function addEditLeave() {

        if($this->input->post('data_action')) {

            $data_action = $this->input->post('data_action');

            if($data_action == 'insert') {

                $api_url = INSERT_LEAVE_API_URL;

                $form_data = [
                    'employee_name' => $this->input->post('employee_name'),
                    'employee_id' => $this->input->post('employee_id'),
                    'leave_date' => $this->input->post('leave_date'),
                    'leave_type_id' => $this->input->post('leave_type_id'),
                    'leave_reason' => $this->input->post('leave_reason'),
                ];

                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_POST, true);
                curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);

                echo $response;
            }

            if($data_action == 'update') {

                $api_url = UPDATE_LEAVE_API_URL;

                $form_data = [
                    'leave_id' => $this->input->post('leave_id'),
                    'employee_name' => $this->input->post('employee_name'),
                    'employee_id' => $this->input->post('employee_id'),
                    'leave_date' => $this->input->post('leave_date'),
                    'leave_type_id' => $this->input->post('leave_type_id'),
                    'leave_reason' => $this->input->post('leave_reason'),
                ];

                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_POST, true);
                curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);

                echo $response;
            } 
        }
    }

    function fetchLeave() {

        $api_url = FETCH_LEAVE_API_URL . $this->input->post('leave_id');
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);

        echo $response;
    }

    function deleteLeave(){

        $api_url = DELETE_LEAVE_API_URL . $this->input->post('leave_id');
        $arr = array(
            'url' => $api_url,
            'leave_id' => $this->input->post('leave_id'),
            'data_action' => $this->input->post('data_action'),
        );
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);

        echo $response;

    }
}