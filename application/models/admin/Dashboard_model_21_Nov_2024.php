<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	public function count_organization(){
	    
	$this->db->join('branch','branch.company_id = company.company_id');
	$this->db->order_by('company.id','DESC');	
	$result = $this->db->get('company');
	$result = $result->num_rows();
	return $result;	
	
	}
	
	public function count_enquiry(){
	
	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.*');	
	$this->db->join('company','company.company_id = enquiry.company');
	$this->db->join('branch','branch.branch_id = enquiry.branch');
	$this->db->where('enquiry.status !=','Quotation Send');
	$this->db->where('enquiry.status !=','Not Useful');
	$this->db->order_by('enquiry.id','DESC');
	$result = $this->db->get('enquiry');
	return $result->num_rows();
	
	}
	
	public function count_quotations(){
	
	$this->db->select('company.name,branch.country,branch.state,branch.city,branch.address,branch.contact_person,branch.contact_number,branch.email,enquiry.mode,enquiry.enquiry_for,quotation.*');	
	$this->db->join('enquiry','enquiry.id = quotation.enquiry_id');
	$this->db->join('company','company.company_id = enquiry.company');
	$this->db->join('branch','branch.branch_id = enquiry.branch');
	$this->db->order_by('id','DESC');
	$result = $this->db->get('quotation');
	return $result->num_rows();
	}	
	
	public function count_products(){
	
	$result = $this->db->get('products');
	return $result->num_rows();
	
	}	
	
    public function enquiry_status_count($locations=''){
		//echo '<pre>';echo implode('","',$locations[$this->input->get('location')]);exit;
        $where = 'enquiry.is_deleted = 0';
        if($this->router->fetch_class() == 'dashboard'){
            $where_and = ($where!='')?' AND ':'';
            $where .= $where_and.' enquiry.date >= "2024-01-01" ';
        }
        
        if($this->session->userdata('type') != '1'){
            //$where = 'file_handle_by = '.$this->session->userdata('id');
        }
	    
		if ($this->input->get('company_id') <> '') {
            $where .= ' AND enquiry.company_id = "' . trim($this->input->get('company_id')) . '"';
        }
		
		if(!empty( $this->input->get('booking_type') )){     
            $booking_type = urldecode($this->input->get('booking_type'));
            if($booking_type == 'all' && $this->input->get('location')<>'all'){
                $where_and = ($where!='')?' AND ':'';
                $where .= $where_and.' enquiry.enquiry_abbr IN ("'.implode('","',$locations[$this->input->get('location')]).'")';
            }else if($booking_type != 'all'){
                $where_and = ($where!='')?' AND ':'';
                $where .= $where_and.' enquiry.enquiry_abbr = "'.$booking_type.'"';
            }
        }
	    
		if(!empty( $this->input->get('followup_status') )){     
			$followup_status = urldecode($this->input->get('followup_status'));
			$where_and = ($where!='')?' AND ':'';
			$where .= $where_and.'enquiry.status="'.$followup_status.'"';
		}
		if(!empty( $this->input->get('from'))){
			$from_date = urldecode($this->input->get('from')) ;
			$where_and = ($where!='')?' AND ':'';
			$where .= $where_and.'enquiry.query_received_date>="'.$from_date.'"';
		}
		if(!empty( $this->input->get('to') )){     
			$to_date = urldecode($this->input->get('to'));
			$where_and = ($where!='')?' AND ':'';
			$where .= $where_and.'enquiry.query_received_date<="'.$to_date.'"';
		}
        
        if(!empty( $this->input->get('query_number') )){     
            $query_number = urldecode($this->input->get('query_number'));
            $where_and = ($where!='')?' AND ':'';
            $where .= $where_and.'enquiry.enquiry_no = "'.$query_number.'"';
        }
        if(!empty( $this->input->get('staff_id') ) && $this->input->get('staff_id') != 'all'){     
            $staff_id = urldecode($this->input->get('staff_id'));
            $where_and = ($where!='')?' AND ':'';
            $where .= $where_and.'enquiry.file_handle_by = "'.$staff_id.'"';
        }
        if($this->session->userdata('admin_type') != 'superadmin' && $this->router->fetch_class()=='enquiry'){
            $where_and = ($where!='')?' AND ':'';
            $assigned_loc = implode('","',$locations[$this->session->userdata('locations')]);
            $where.= $where_and.'enquiry.enquiry_abbr IN ("'.$assigned_loc.'")';
        }
		
		if(!empty($this->input->get('confirm_cnt'))){
			$query = 'SELECT followups.enquiry_id FROM followups ';
			$query .= 'WHERE followups.id IN ( SELECT MAX(followups.id) FROM followups ';
			$query .= 'WHERE followups.date = "'.date('Y-m-d').'" GROUP BY followups.enquiry_id) AND followups.followup_status="confirm"';
			$result = $this->common_model->custom_query($query);
			$where_in=[];
			foreach($result AS $list){
				$where_in[] = $list->enquiry_id;
			}
			$where_and = ($where!='')?' AND ':'';
			$where.= $where_and.'enquiry.id IN ('.implode(",",!empty($where_in)?$where_in:[0]).')';
		}
		
        if($where<>''){
            $where = ' WHERE '.$where;
        }

        $query = $this->db->query('SELECT t.status_cnt,t.status 
            FROM (SELECT status,COUNT(status) AS status_cnt FROM enquiry '.$where.' GROUP BY status) t GROUP BY t.status');
        $counts = $query->result();
		
        $new_arr=[];
        if(!empty($counts)){
            foreach($counts AS $list){
    		    $new_arr[$list->status] = $list->status_cnt;
    	    }
        }
		
		if($this->router->fetch_class() == 'dashboard'){
			$query_arrivals = $this->db->query('SELECT enquiry.status,COUNT(enquiry.status) AS status_cnt FROM enquiry JOIN arrivals ON arrivals.enquiry_id=enquiry.id '.$where.' AND enquiry.status="confirm" GROUP BY enquiry.status');
			$counts_arr = $query_arrivals->result();
			$new_arr[$counts_arr[0]->status] = $counts_arr[0]->status_cnt;
		}
		
        return $new_arr; 
    }
	
    public function arrival_status_count(){
        $where = 'WHERE 1=1';
        if($this->input->get('date_from') <> '' && $this->input->get('date_to') <> ''){
            $where_and = ($where!='')?' AND ':'';
            $where.= $where_and.'date(arrivals.arrival_date) >="'.$this->input->get('date_from').'" AND date(arrivals.arrival_date) <="'.$this->input->get('date_to').'"';
        }
        if($this->input->get('status') <> ''){
            $where_and = ($where!='')?' AND ':'';
            $where.= $where_and.'arrivals.status ="'.urldecode($this->input->get('status')).'"';
        }
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'arrivals.handling_staff_id ="' . urldecode($this->input->get('staff_id')) . '"';
        }
        if(!empty( $this->input->get('booking_type') )){     
            $booking_type = urldecode($this->input->get('booking_type'));
            if($booking_type == 'all' && $this->input->get('location')<>'all'){
                $loc = implode('","',$this->locations[$this->input->get('location')]);
                $where_and = ($where!='')?' AND ':'';
                $where.= $where_and.'enquiry.enquiry_abbr IN ("'.$loc.'")';
                //$this->db->where_in('enquiry.enquiry_abbr',$locations[$this->input->get('location')]);
            }else if($booking_type != 'all'){
                $where_and = ($where!='')?' AND ':'';
                $where.= $where_and.'enquiry.enquiry_abbr = "'.$booking_type.'"';
                //$this->db->where('enquiry.enquiry_abbr',$booking_type);	
            }
        }
        
        if ($this->input->get('company_id') <> '') {
            $where_and = ($where != '') ? ' AND ' : '';
            $where .= $where_and . 'enquiry.company_id ="' . urldecode($this->input->get('company_id')) . '"';
        }
        
        if($this->session->userdata('admin_type') != 'superadmin'){
            $where_and = ($where!='')?' AND ':'';
            $assigned_loc = implode('","',$this->locations[$this->session->userdata('locations')]);
            $where.= $where_and.'enquiry.enquiry_abbr IN ("'.$assigned_loc.'")';
        }
        
        $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
        if($this->input->get('country') <> '' && $this->input->get('country') <> 'all'){
            $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 1) = "'.urldecode($this->input->get('country')).'"';
        }
        if($this->input->get('query_number') <> ''){
            $enquiry_join .= ' AND enquiry.enquiry_no = "'.urldecode($this->input->get('query_number')).'"';
        }
        
        $query = $this->db->query('SELECT t.status_cnt,t.status 
            FROM (SELECT arrivals.status,COUNT(arrivals.status) AS status_cnt FROM arrivals JOIN enquiry ON ('.$enquiry_join.') '.$where.' GROUP BY arrivals.status) t GROUP BY t.status');
        $counts = $query->result(); 
        $new_arr=[];
        if(!empty($counts)){
            foreach($counts AS $list){
                    $new_arr[$list->status] = $list->status_cnt;
            }
        }
        return $new_arr; 
    }
	
	
}
?>