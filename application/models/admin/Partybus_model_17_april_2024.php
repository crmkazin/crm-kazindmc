<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partybus_model extends CI_Model{	

    public function get_rows(){
        
        $this->db->select('party_bus.*, packages.package');
        $this->db->join('packages', 'packages.id = party_bus.package', 'left');
        $this->db->where('party_bus.status', 1);
        $result = $this->db->get('party_bus');
        return $result = $result->result();
    }
    


    public function add_bus(){	
        
        $data = array(
            'file_Number'      =>$this->input->post('file_number'),
            'date_of_booking'     =>$this->input->post('date_of_booking'),
            'time_slot'  =>$this->input->post('time_slot'),
            'reporting_location'    =>$this->input->post('reporting_location'),
            'end_location'      =>$this->input->post('end_location'),
            'package'    =>$this->input->post('package'),
            'number_of_passengers'      =>$this->input->post('passengers'),
            'currency'      =>$this->input->post('currency'),
            'package_price'      =>$this->input->post('package_price'),
            'payment_recieved'      =>$this->input->post('payment_recieved'),
            'balance'      =>$this->input->post('balance'),
            'status'    => '1'
	    );
        
        $bus_add = $this->db->insert('party_bus',$data);  
        if(!empty($bus_add)){
            return true;
        }else{
            return false;
        }
    }

    public function delete_bus(){
        
        $this->db->select('party_bus.*');
        $this->db->where('party_bus.id',$this->uri->segment(1));
        $result = $this->db->get('party_bus');
        $result = $result->result();
        

        $data = array(            
            'status' => 0           
	    ); 
        
        $this->db->where('id',$this->uri->segment(1));
        $this->db->update('party_bus',$data); 
    
	    if($this->db->affected_rows() > 0){
            return true;
      	}else{ 
            return false;
	    }   
    }
}
?>