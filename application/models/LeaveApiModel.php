<?php

class leaveApiModel extends CI_Model {

	function fetch_employee_name($employee_id) {
		if(!is_null($employee_id)) {
			$data = $this->db->select('employee_name')
				->from('employee')
				->where('employee_id', $employee_id)
				->get();
				$result =  $data->result_array();
				return $result[0]['employee_name'];
		}
		else {
			return false;
		}
		
		
	}

	function fetch_leave_types() {
		$data = $this->db->select('leave_type_id, leave_type_name')
			->from('leave_type')
			->get();
		return $data->result_array();		
	}

	function fetch_employee_leave($employee_id) {

		if(!is_null($employee_id)) {
			$data = $this->db->select('employee.employee_id, employee_name, leave_id, leave_date, employee_leave.leave_type_id, leave_type_name, leave_reason')
				->from('employee_leave')
				->join('employee', 'employee.employee_id = employee_leave.employee_id')
				->join('leave_type', 'leave_type.leave_type_id = employee_leave.leave_type_id')
				->where('employee.employee_id = ', $employee_id)
				->order_by('leave_date', 'ASC')
				->get();

			return $data->result_array();	
		}
		else {
			return false;
		}
		
	}

	function insert_leave($data) {
		$this->db->insert('employee_leave', $data);
	}

	function fetch_leave_by_id($leave_id) {
		if(!is_null($leave_id)) {
			$data = $this->db->select('employee.employee_id, employee.employee_name, leave_id, leave_date, employee_leave.leave_type_id, leave_reason')
				->from('employee_leave')
				->join('employee', 'employee.employee_id = employee_leave.employee_id')
				->where('leave_id = ', $leave_id)
				->get();

				//print_r($this->db->last_query());
				return $data->result_array();	
		}
		else {
			return false;
		}
		
	}

	function delete_leave($leave_id) {
		if(!is_null($leave_id)) {
			$this->db->where('leave_id', $leave_id);
			$this->db->delete('employee_leave');
			return true;	
		}
		else {
			return false;
		}
	}

	function update_leave($data, $leave_id) {

		$this->db->where('leave_id', $leave_id);
		$this->db->update('employee_leave', $data);
		return true;

	}
	
}
