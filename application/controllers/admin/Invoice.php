<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('login');
		}
		$this->load->model(['admin/invoice_model','common_model','admin/quotation_model','admin/tender_model']);
	}		
	
	public function index()
	{

		if($this->input->post('submit') == 'Submit'){
		$result = $this->invoice_model->add_invoice();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
			redirect('invoices');		
		}else{
		$this->session->set_flashdata('message','Error!');	
			redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		$this->load->model('admin/enquiry_model');
        $data['products'] = $this->enquiry_model->products();
		$this->load->view('admin/invoice',$data);
	}	

    public function invoices(){
        $data['invoices'] = $this->invoice_model->invoice_list();
		$this->load->view('admin/invoices',$data);        
    }

    /*public function edit_invoice(){

		if($this->input->post('submit') == 'Update'){
		$result = $this->invoice_model->update_invoice();
		
		if($result){
		$this->session->set_flashdata('message','Updated Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		$this->load->model('admin/enquiry_model');
		$this->load->model('admin/tender_model');
        $data['products'] = $this->enquiry_model->products();
        $data['detail'] = $this->invoice_model->get_invoice();
        $data['branches'] = $this->tender_model->company_branch($data['detail']->organization);
		$this->load->view('admin/edit_invoice',$data);
        
    }*/
    
    // 31 Dec 2022
    public function edit_invoice(){
        $data['detail'] = $this->invoice_model->get_invoice();
        $data['branch'] = $this->tender_model->company_branch_new($data['detail']->organization);
        //echo '<pre>';print_r($data);exit;
        
        if($this->input->post('submit') == 'Update'){
            $result = $this->invoice_model->update_invoice();
            if($result){
                $this->session->set_flashdata('message','Updated Successfully!');
                $invoice_number = explode('.',$data['detail']->invoice_name);
                if(file_exists(FCPATH.'assets/invoices/'.$data['detail']->invoice_name)){
                $new_name = FCPATH.'assets/invoices/'.$invoice_number[0].'_'.($data['detail']->previously_edited+1).'_previous.pdf';
                    rename(FCPATH.'assets/invoices/'.$data['detail']->invoice_name, $new_name);
                }
                $this->load->view('admin/pdf_generate_invoice',['invoice_number'=>$invoice_number[0]]);
                redirect('invoices');
            }else{
                $this->session->set_flashdata('message','Error!');	
                redirect($_SERVER['HTTP_REFERER']);			
            }
        }
        $this->load->model('admin/enquiry_model');
        $this->load->model('admin/tender_model');
        //$data['products'] = $this->enquiry_model->products();        
	    $this->load->view('admin/invoice_edit_view',$data);
        
    }
    
	
    public function delete_invoice(){
		$this->invoice_model->delete_invoice();    
    }

	public function generate_invoice(){
	    $id = $this->uri->segment(1);
        if($id == ''){ redirect('dashboard'); }
        $select = 'c.name,b.*,i.*';
        $where = ' i.id = '.$id;
        $orderby = '';
        $join = [['type'=>'LEFT','join_table'=>'company c','condition'=>'i.organization = c.company_id'],
                //['type'=>'LEFT','join_table'=>'branch b','condition'=>'b.branch_id = i.branch']
                ['type'=>'LEFT','join_table'=>'branch b','condition'=>'b.company_id = i.organization']
            ];
        $data['invoice'] = $this->common_model->get_data('order_acknowledgement i','', '', $select,$where, $orderby, $count = false,$join);
        $data['branch'] = $data['invoice'];
        $data['invoice'] = $data['invoice'][0];
        
        $select = '*';
        $where = ' status = "1"';
        $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];
        
        $this->db->select('max(financial_year_invoice_no) AS inv_num');
        //$this->db->where('is_deleted',0);
        $this->db->where('financial_year',$financial_year->year);
        $result = $this->db->get('invoice'); 
        $result = $result->result();
        
        //echo "<PRE>"; print_r($result);exit;
        
        if($result[0]->inv_num=='' || $result[0]->inv_num=='0'){
            $new_inv_num = 'IT/TI/'.$financial_year->year.'/001';
            $financial_year_invoice_no = 1;
        }else{
            $new_inv_num = $result[0]->inv_num;
            //$new_inv_num = explode('/',$new_inv_num);
            //$cnt = count($new_inv_num);
            //$new_inv_num[$cnt-1] = $new_inv_num[$cnt-1] + 1;
            $new_inv_num = $new_inv_num + 1;
            $financial_year_invoice_no = $new_inv_num;
            if(strlen($new_inv_num)<3){
                $prefix = ['1'=>'00','2'=>'0'];
                $new_inv_num = $prefix[strlen($new_inv_num)].$new_inv_num;	
            }
            //$new_inv_num = implode('/',$new_inv_num);
            $new_inv_num = 'IT/TI/'.$financial_year->year.'/'.$new_inv_num;
        }
        
        // 6 march 2023 no need to check existing invoice at the time of crreating a new invoice 
        
        //echo $new_inv_num;exit;
        // $select_exists = 'invoice.financial_year_invoice_no';
        // $where = ' invoice.order_id = '.$id;
        // $invoice_exists = $this->common_model->get_data('invoice','', '', $select_exists,$where, '', $count = false);
        // if(!empty($invoice_exists)){
        //     foreach($invoice_exists AS $list){
        //         if($list->financial_year_invoice_no != '0'){
        //             $financial_year_invoice_no = $list->financial_year_invoice_no+1;
        //             $prefix = ['1'=>'00','2'=>'0'];
        //             $new_inv = explode('/', $new_inv_num);
        //             $new_inv[count($new_inv)-1] = $prefix[strlen($financial_year_invoice_no)].$financial_year_invoice_no;
        //             $new_inv_num = implode('/', $new_inv);
        //         }
        //     }
        // }
        //echo '<pre>'.$new_inv_num.'___'.$financial_year_invoice_no;print_r($invoice_exists);exit;
      
        
        // End here 6 march 2023
        
        $data['invoice_num'] = $new_inv_num;
        
        
        if($this->input->post('submit')<>''){
            $invoice_number = 'OA_'.$data['invoice']->id.'_'.str_replace('/','_',$this->input->post('invoice_no'));
            //$cnt = count($this->input->post('amount[]'));
            //$insert_data = [];
            //for($i=0;$i<$cnt;$i++){
            $this->form_validation->set_rules('invoice_no','Required','required|is_unique[invoice.invoice_no]');
            if($this->form_validation->run() === FALSE){
                $this->session->set_flashdata('inv_exists','<div class="col-sm-12 center alert alert-danger">Invoice number exists!</div>');
                redirect($id.'/generate-invoice');
            }
            
            
                $insert_data[] = array(
                    'invoice_no'            =>$this->security->xss_clean($this->input->post('invoice_no')),
                    'financial_year_invoice_no' => $financial_year_invoice_no,
                    'date'                  =>date('Y-m-d', strtotime( $this->input->post('invoice_date') )),
                    'oa_no'                 =>$data['invoice']->order_no,
                    'organization'          =>$data['invoice']->company_id,
                    'branch'                =>$this->input->post('branch_name'),//$data['invoice']->branch_id,	
                    //'equipment'             =>implode(',',($this->security->xss_clean($this->input->post('product_name[]')))),	
                    'equipment'             =>implode('_~$~_',($this->security->xss_clean($this->input->post('product_name[]')))),//11 April 2023
                    'purchase_order_detail' =>'',
                    'subtotal'              =>$this->security->xss_clean($this->input->post('total')),
                    'igst_tax'                  =>$this->security->xss_clean($this->input->post('rdo_tax')),
                    'igst'              => $this->input->post('tax_percentage'),//($this->input->post('rdo_tax')=='cgst_sgst' || $this->input->post('rdo_tax')=='igst')?'18':'5',
                    'received_amount'	    =>$this->security->xss_clean($this->input->post('advanced_received')),
                    'received_amount_date'  =>'',
                    'tds_deduction'         =>'',	
                    'company_gst'           =>$this->security->xss_clean($this->input->post('gst_number')),	
                    'customer_gst'          =>$this->security->xss_clean($this->input->post('consignee_gstin['.$this->input->post('branch_name').']')),	
                    //'remarks'             =>$this->security->xss_clean($this->input->post('remarks')),
                    'added_by'              =>$this->session->userdata('id'),
                    'is_deleted'            =>0,
                    'order_id'              => $data['invoice']->id,
                    'hsn_sac'               => implode(',',$this->input->post('hsn_sac[]')),
                    'unit'                  => implode(',',$this->input->post('unit[]')),
                    'rate'                  => implode(',',$this->input->post('rate[]')),
                    'quantity'              => implode(',',$this->input->post('quantity[]')),
                    'amount'                => implode(',',$this->input->post('amount[]')),
                    'packing'               => $this->input->post('packing'),
                    'installation_mobilization'=> $this->input->post('installation'),
                    'fright_transport'      => $this->input->post('fright'),
                    'eway_bill_no'          => $this->input->post('eway_bill_no'),
                    'reverse_charge'        => $this->input->post('reverse_charge'),
                    'place_of_supply'        => $this->input->post('place_of_supply'),
                    'amount_payable'        => $this->input->post('total_amount'),
                    'financial_year'    => $financial_year->year,
                    'invoice_name' => $invoice_number.'.pdf'
                );
            //}
            $insert = $this->common_model->insert_data_batch(['table_name'=>'invoice','insert_data'=>$insert_data]);
            if($insert){
                $update_data = ['table_name'=>'order_acknowledgement',
                                    'update_data'=>['invoice'=>'Yes','invoice_no'=>$this->input->post('invoice_no'),
                                        'client_order_no'=>$this->input->post('buyers_order_no')],
                            'condition'=>['id'=>$data['invoice']->id]];
                $this->common_model->update_data($update_data);
            }
            
            $this->load->view('admin/pdf_generate_invoice',['invoice_number'=>$invoice_number]);
            //$this->session->set_flashdata('message','Added Successfully!');
            //redirect('invoices');
        }
        
        $this->load->view('admin/generate_invoice_view',$data);
    }
    
    // 30-Sept-2022
    
    public function credit(){
        $id = $this->uri->segment(2);
        $select = 'c.name,b.*,i.*';
        $where = ' i.id = '.$id;
        $orderby = '';
        $join = [['type'=>'LEFT','join_table'=>'company c','condition'=>'i.organization = c.company_id'],
                //['type'=>'LEFT','join_table'=>'branch b','condition'=>'b.branch_id = i.branch']
                ['type'=>'LEFT','join_table'=>'branch b','condition'=>'b.company_id = i.organization']
            ];
        $data['invoice'] = $this->common_model->get_data('invoice i','', '', $select,$where, $orderby, $count = false,$join);
        $data['branch'] = $data['invoice'];
        $data['invoice'] = $data['invoice'][0];
        
        $select = '*';
        $where = ' status = "1"';
        $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];
        //echo '<pre>';print_r($data);exit;
        
        
        $this->db->select('max(credit_note_no) AS credit_num');
        $this->db->where('is_deleted',0);
        $this->db->where('financial_year',$financial_year->year);
        $result = $this->db->get('credit_notes'); 
        $result = $result->result();
        
        if($result[0]->credit_num==''){
            $new_credit_num = 'IT/CN/'.$financial_year->year.'/001';
        }else{
            $new_credit_num = $result[0]->credit_num;
            $new_credit_num = explode('/',$new_credit_num);
            $cnt = count($new_credit_num);
            $new_credit_num[$cnt-1] = $new_credit_num[$cnt-1] + 1;
            if(strlen($new_credit_num[$cnt-1])<3){
                $prefix = ['1'=>'00','2'=>'0'];
                $new_credit_num[$cnt-1] = $prefix[strlen($new_credit_num[$cnt-1])].$new_credit_num[$cnt-1];	
            }
            $new_credit_num = implode('/',$new_credit_num);
        }
        $data['new_credit_num'] = $new_credit_num;
        if($this->input->post('submit')<>''){
            $credit_number = $data['invoice']->id.'_'.str_replace('/','_',$this->input->post('credit_no'));
            
            $insert_data[] = array(
                'credit_note_no'        => $this->security->xss_clean($this->input->post('credit_no')),
                'credit_note_date'      => $this->input->post('credit_date'),
                'our_reference'         => $this->input->post('our_reference'),
                'supply_date'           => $this->input->post('supply_date'),
                'supply_place'          => $this->input->post('place_of_supply'),	
                'organization'          => $data['invoice']->company_id,
                'buyer_branch'          => $this->input->post('branch_name'),
                'consignee_branch'      => $this->input->post('branch_name_consignee'),
                'equipment'             => implode(',',($this->security->xss_clean($this->input->post('equipment[]')))),	
                'hsn_sac'               => implode(',',$this->input->post('hsn_sac[]')),
                'unit'                  => implode(',',$this->input->post('unit[]')),
                'rate'                  => implode(',',$this->input->post('rate[]')),
                'quantity'              => implode(',',$this->input->post('quantity[]')),
                'amount'                => implode(',',$this->input->post('amount[]')),
                'gst_applicable'        => $this->security->xss_clean($this->input->post('rdo_tax')),
                'gst_percentage'        => $this->security->xss_clean($this->input->post('tax_percentage')),
                'sub_total'              => $this->security->xss_clean($this->input->post('total_without_tax')),
                'total_payable'         => $this->input->post('total_amount'),
                'company_gst'           => $this->security->xss_clean($this->input->post('gst_number')),	
                'customer_gst'          => $this->security->xss_clean($this->input->post('consignee_gstin['.$this->input->post('branch_name').']')),	
                'financial_year'        => $financial_year->year,
                'added_by'              => $this->session->userdata('id'),
                'creditnote_name'       => $credit_number.'.pdf',
                'invoice_id'            => $this->security->xss_clean($this->input->post('hdn_invoice_id')), 
                'your_reference'        => $this->security->xss_clean($this->input->post('your_ref')), 
            );
            $insert = $this->common_model->insert_data_batch(['table_name'=>'credit_notes','insert_data'=>$insert_data]);
            $this->load->view('admin/pdf_generate_credit_note',['credit_number'=>$credit_number]);
        }
        
        $this->load->view('admin/credit_note_view',$data);
    }
    
    public function debit(){
        $id = $this->uri->segment(2);
        $select = 'c.name,b.*,i.*';
        $where = ' i.id = '.$id;
        $orderby = '';
        $join = [['type'=>'LEFT','join_table'=>'company c','condition'=>'i.organization = c.company_id'],
                //['type'=>'LEFT','join_table'=>'branch b','condition'=>'b.branch_id = i.branch']
                ['type'=>'LEFT','join_table'=>'branch b','condition'=>'b.company_id = i.organization']
            ];
        $data['invoice'] = $this->common_model->get_data('invoice i','', '', $select,$where, $orderby, $count = false,$join);
        $data['branch'] = $data['invoice'];
        $data['invoice'] = $data['invoice'][0];
        
        $select = '*';
        $where = ' status = "1"';
        $financial_year = $this->common_model->get_data('financial_year','', '', $select,$where, '', $count = false)[0];
        //echo '<pre>';print_r($data);exit;
        
        
        $this->db->select('max(debit_note_no) AS debit_num');
        $this->db->where('is_deleted',0);
        $this->db->where('financial_year',$financial_year->year);
        $result = $this->db->get('debit_notes'); 
        $result = $result->result();
        
        if($result[0]->debit_num==''){
            $new_debit_num = 'IT/DN/'.$financial_year->year.'/001';
        }else{
            $new_debit_num = $result[0]->debit_num;
            $new_debit_num = explode('/',$new_debit_num);
            $cnt = count($new_debit_num);
            $new_debit_num[$cnt-1] = $new_debit_num[$cnt-1] + 1;
            if(strlen($new_debit_num[$cnt-1])<3){
                $prefix = ['1'=>'00','2'=>'0'];
                $new_debit_num[$cnt-1] = $prefix[strlen($new_debit_num[$cnt-1])].$new_debit_num[$cnt-1];	
            }
            $new_debit_num = implode('/',$new_debit_num);
        }
        $data['new_debit_num'] = $new_debit_num;
        if($this->input->post('submit')<>''){
            $debit_number = $data['invoice']->id.'_'.str_replace('/','_',$this->input->post('debit_no'));
            
            $insert_data[] = array(
                'debit_note_no'         => $this->security->xss_clean($this->input->post('debit_no')),
                'debit_note_date'       => $this->input->post('debit_date'),
                'supply_reference_no'   => $this->input->post('supply_reference'),
                'transport_mode'        => $this->input->post('transport_mode'),
                'eway_bill_number'      => $this->input->post('eway_bill_number'),
                'supply_date'           => $this->input->post('supply_date'),
                'supply_place'          => $this->input->post('place_of_supply'),	
                'organization'          => $data['invoice']->company_id,
                'buyer_branch'          => $this->input->post('branch_name'),
                'consignee_branch'      => $this->input->post('branch_name_consignee'),
                'equipment'             => implode(',',($this->security->xss_clean($this->input->post('equipment[]')))),	
                'hsn_sac'               => implode(',',$this->input->post('hsn_sac[]')),
                'unit'                  => implode(',',$this->input->post('unit[]')),
                'rate'                  => implode(',',$this->input->post('rate[]')),
                'quantity'              => implode(',',$this->input->post('quantity[]')),
                'amount'                => implode(',',$this->input->post('amount[]')),
                'gst_applicable'        => $this->security->xss_clean($this->input->post('rdo_tax')),
                'gst_percentage'        => $this->security->xss_clean($this->input->post('tax_percentage')),
                'sub_total'             => $this->security->xss_clean($this->input->post('total_without_tax')),
                'total_payable'         => $this->input->post('total_amount'),
                'company_gst'           => $this->security->xss_clean($this->input->post('gst_number')),	
                'customer_gst'          => $this->security->xss_clean($this->input->post('consignee_gstin['.$this->input->post('branch_name').']')),	
                'financial_year'        => $financial_year->year,
                'added_by'              => $this->session->userdata('id'),
                'debitnote_name'        => $debit_number.'.pdf',
                'invoice_id'            => $this->security->xss_clean($this->input->post('hdn_invoice_id')), 
                'your_reference'        => $this->security->xss_clean($this->input->post('your_ref')), 
            );
            $insert = $this->common_model->insert_data_batch(['table_name'=>'debit_notes','insert_data'=>$insert_data]);
            $this->load->view('admin/pdf_generate_debit_note',['debit_number'=>$debit_number]);
        }
        
        $this->load->view('admin/debit_note_view',$data);
    }
    
    public function check_invoice_num(){
        $response = ['response'=>'s','error'=>''];
        $this->form_validation->set_rules('invoice_num','Invoice No.','required|is_unique[invoice.invoice_no]',array('is_unique'=>'Invoice Number Exists!'));
        if($this->form_validation->run() === FALSE){
            $response = ['response'=>'e','error'=> validation_errors()];
        }
        echo json_encode($response);
    }
    
	public function pdf_preview_invoice(){
        $this->load->view('admin/pdf_preview_invoice');
    }
	
}
