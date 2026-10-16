<?php if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Company_model extends CI_Model
{

  // public function new_company(){
  //           $result = 1;
  //           if($this->input->post('company_id')==''){
  //               $company_id = uniqid();
  //               $data = array(

  //                   'name' =>   $this->security->xss_clean(ucwords(strtolower($this->input->post('name')))),
  //                   'company_id'  => $company_id,
  //                   'date'	 => date('Y-m-d')
  // 	);
  //               $result = $this->db->insert('company',$data);
  //           }else { $company_id = $this->input->post('company_id'); }
  // if($result){
  //           $branch = array(
  // 	'company'               =>$company_id,
  // 	'country'		=>$this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
  // 	'state'			=>$this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
  // 	'city'			=>$this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
  // 	'address'		=>$this->security->xss_clean($this->input->post('address')),
  // 	'contact_person'=>$this->security->xss_clean(ucwords(strtolower($this->input->post('contact_person')))),
  //               'contact_person_isd_code'=>$this->security->xss_clean($this->input->post('isd_codes')),
  // 	'contact_person_number'=>$this->security->xss_clean($this->input->post('contact_number')),
  // 	'email'			=>$this->security->xss_clean($this->input->post('email')),
  // 	'creation_date'		=>date('Y-m-d'),
  //               'gstin'			=>$this->security->xss_clean($this->input->post('gstin')),
  //               'user_id'               =>$this->session->userdata('id'),
  //               'designation'           =>$this->security->xss_clean($this->input->post('designation'))
  //           );

  // $result2 = $this->db->insert('company_details',$branch);
  // if($result2){
  //           return true;	
  // }else{
  //           return false;	
  // }
  //   }else{
  //           return false;
  // }
  //   }

  public function update_company()
  {

    $data = array(
      'name' => $this->security->xss_clean(ucwords(strtolower($this->input->post('name'))))
    );
    $this->db->where('company_id', $this->security->xss_clean($this->input->post('company_id')));

    $result = $this->db->update('company', $data);

    $result = $this->db->affected_rows();
    $branch = array(
      'country' => $this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
      'state' => $this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
      'city' => $this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
      'address' => $this->security->xss_clean($this->input->post('address')),
      'contact_person' => $this->security->xss_clean(ucwords(strtolower($this->input->post('contact_person')))),
      'contact_number' => $this->security->xss_clean($this->input->post('contact_number')),
      'email' => $this->security->xss_clean($this->input->post('email')),
      'gstin' => $this->security->xss_clean($this->input->post('gstin')),
    );

    $this->db->where('company_id', $this->security->xss_clean($this->input->post('company_id')));
    $this->db->where('branch_id', $this->security->xss_clean($this->input->post('branch')));
    $result2 = $this->db->update('branch', $branch);
    $result2 = $this->db->affected_rows();
    if ($result2 || $result) {
      return true;
    } else {
      return false;
    }
  }

  public function new_branch()
  {



    $branch = array(

      'company_id' => $this->security->xss_clean($this->input->post('company_id')),

      'branch_id' => uniqid(),

      'country' => $this->security->xss_clean($this->input->post('country')),

      'state' => $this->security->xss_clean($this->input->post('state')),

      'city' => $this->security->xss_clean($this->input->post('city')),

      'address' => $this->security->xss_clean($this->input->post('address')),

      'contact_person' => $this->security->xss_clean($this->input->post('contact_person')),

      'contact_number' => $this->security->xss_clean($this->input->post('contact_number')),

      'email' => $this->security->xss_clean($this->input->post('email')),

      'date' => date('Y-m-d'),
      'gstin' => $this->security->xss_clean($this->input->post('gstin')),

    );

    $result2 = $this->db->insert('branch', $branch);

    if ($result2) {

      return true;

    } else {

      return false;

    }



  }



  public function company_name()
  {



    $this->db->order_by('name', 'ASC');

    $result = $this->db->get('company');

    $result = $result->result();

    return $result;



  }



  public function all_company()
  {
    $this->db->join('company_details', 'company_details.company = company.company_id');
    $this->db->where('company.is_deleted !=', 1);
    $this->db->where('company_details.status = ', 'active');
    $this->db->order_by('company.id', 'DESC');
    $result = $this->db->get('company');
    $result = $result->result();
    return $result;
  }



  public function all_countries()
  {



    $this->db->order_by('name', 'ASC');

    $result = $this->db->get('countries');

    $result = $result->result();

    return $result;

    //print_r($result);exit;	

  }

  public function get_hotel_ajax($postData)
  {
      $response = [];

      if (!empty($postData['search'])) {
          $this->db->distinct(); 
          $this->db->select('name');
          $this->db->from('hotels');
          $this->db->like('name', $postData['search']);
          $this->db->limit(10);
          $query = $this->db->get()->result();

          foreach ($query as $row) {
              $response[] = [
                  'id'    => 0, 
                  'label' => $row->name,
                  'value' => $row->name
              ];
          }
      }

      return $response;
  }
  
  
  public function get_driver_using_ajax($postData)
  {
      $search = $postData['search'];

      $this->db->select('id, driver_name');
      $this->db->from('drivers');
      $this->db->where('status !=', 'deleted');
      $this->db->like('driver_name', $search);
      $query = $this->db->get();

      $result = [];

      foreach ($query->result() as $row) {
          $result[] = [
              'label' => $row->driver_name,
              'value' => $row->driver_name, 
              'driver_id' => $row->id 
          ];
      }

      return $result;
  }


  public function get_country_ajax($postData)
  {
    $response = array();
    $this->db->select('*');
    if (!empty($postData['search'])) {
      // Select record
      $this->db->where("name like '%" . $postData['search'] . "%' ");
      $this->db->limit(10);
      $records = $this->db->get('countries')->result();
      foreach ($records as $row) {
        $response[] = array("country_id" => $row->id, "label" => $row->name);
      }
    }
    return $response;
  }

  public function get_country_ajax_new($postData)
  {
    $response = array();
    $this->db->select('*');
    if (!empty($postData['search'])) {
      // Select record
      $this->db->where_in("id", [11, 15, 20, 81, 112, 234]);
      //$this->db->limit(10);
      $records = $this->db->get('countries')->result();
      foreach ($records as $row) {
        $response[] = array("country_id" => $row->id, "label" => $row->name);
      }
    }
    return $response;
  }

 public function get_state_ajax($postData)
{
    $response = [];

    if (!empty($postData['search'])) {
        $this->db->select('MIN(id) as id, name');
        $this->db->from('states');
        $this->db->like('name', $postData['search']);

        if (!empty($postData['country_id'])) {
            $this->db->where('country_id', $postData['country_id']);
        }

        $this->db->group_by('name');
        $this->db->limit(10);
        $records = $this->db->get()->result();

        foreach ($records as $row) {
            $response[] = [
                "state_id" => $row->id,
                "label"    => $row->name
            ];
        }
    }

    return $response;
}


  public function get_city_ajax($postData)
{
    $response = [];

    if (!empty($postData['search'])) {
        $this->db->select('MIN(id) as id, name');
        $this->db->from('cities');
        $this->db->like('name', $postData['search']);

        if (!empty($postData['state_id'])) {
            $this->db->where('state_id', $postData['state_id']);
        }

        $this->db->group_by('name');
        $this->db->limit(10);
        $records = $this->db->get()->result();

        foreach ($records as $row) {
            $response[] = [
                "city_id" => $row->id,
                "label"   => $row->name
            ];
        }
    }

    return $response;
}



  public function get_branch_ajax()
  {
    $this->db->where('company', $this->security->xss_clean($this->input->post('company')));
	  $this->db->where('status != ', 'deleted');

    $this->db->order_by('contact_person', 'DESC');

    $result = $this->db->get('company_details');

    $result = $result->result();

    echo json_encode($result);

  }

  public function branch_detail_ajax()
  {

    $this->db->where('company_id', $this->security->xss_clean($this->input->post('agent_id')));
    $result = $this->db->get('company_details');
    $result = $result->row();
    echo json_encode($result);
  }

  public function company_name_suggesstion($postData)
  {



    $response = array();



    $this->db->select('*');



    if (!empty($postData['search'])) {



      // Select record

      $this->db->where("name like '%" . trim($postData['search']) . "%' ");
      $this->db->where('is_deleted !=', '1');
      $this->db->where('status', 'active');
      $this->db->limit(10);

      $records = $this->db->get('company')->result();



      foreach ($records as $row) {

        $response[] = array("company_id" => $row->company_id, "label" => trim($row->name),"gstin"=>trim($row->gstin));

      }



    }

    return $response;

  }


//   public function company_name_suggesstion($postData)
//   {
//     $response = array();
//     $this->db->select('*');
//     if (!empty($postData['search'])) {
//       // Select record
//       $this->db->where("name like '%" . trim($postData['search']) . "%' ");
//       $this->db->where('is_deleted !=', '1');
//       $this->db->or_where('status !=', 'in-active');
//       $this->db->limit(10);
//       $records = $this->db->get('company')->result();
//       foreach ($records as $row) {
//         $response[] = array("company_id" => $row->company_id, "label" => trim($row->name),"gstin"=>trim($row->gstin));
//       }
//     }
//     return $response;
//   }



  public function enquiry_suggesstion($postData)
  {



    $response = array();



    $this->db->select('*');



    if (!empty($postData['search'])) {



      // Select record

      $this->db->where("enquiry_for like '%" . $postData['search'] . "%' ");

      //  $this->db->group_by('enquiry_for');

      $this->db->limit(10);

      $records = $this->db->get('enquiry')->result();



      foreach ($records as $row) {

        $response[] = array("label" => $row->enquiry_for);

      }



    }

    return $response;

  }



  public function delete_client()
  {

    $this->db->set('status', 'deleted');
    $this->db->where('company_id', $this->uri->segment(1));
    $this->db->update('company_details');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  //03 April 2024

  public function new_company()
  {
    $filename = '';
    if (empty($_FILES['company_logo']['name'])) {
      $filename = 'no-image.png';
    }
    if (!empty($_FILES['company_logo']['name'])) {
      $this->load->library('upload');
      $config['upload_path'] = './assets/company/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size'] = '2048';
      $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['company_logo']['name']);
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('company_logo')) {
        return false; // File upload failed
      }
      $file = $this->upload->data();
      $filename = $file['file_name'];

      // Validate image dimensions
      $image_path = $config['upload_path'] . $filename;
      list($width, $height) = getimagesize($image_path);
      if ($width >= 200 && $height >= 200) {
        // Delete the uploaded file
        unlink($image_path);
        // Return an error message or handle the error as needed
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Please Update Image of 200 * 200 Size.</div>');
        redirect('company');
      }

    }
    if ($this->input->post('company_id') == '') {
      $company_id = uniqid();

      $data = array(
        'name' => ucwords(strtolower($this->input->post('name'))),
        'company_id' => $company_id,
        'date' => date('Y-m-d'),
        'company_logo' => $filename,
        'gstin' => $this->input->post('gstin'),
        'country' => ucwords(strtolower($this->input->post('country'))),
        'state' => ucwords(strtolower($this->input->post('state'))),
        'city' => ucwords(strtolower($this->input->post('city'))),
        'address' => $this->input->post('address'),
        'address_2' => $this->input->post('address_2'),
        //'address_3' => $this->input->post('address_3'),
        'pincode' => $this->input->post('pincode'),        
      );
      $result1 = $this->db->insert('company', $data);
    }else {
        $company_id = $this->input->post('company_id');
    }
    $branch = array(
        'company' => $company_id,
        'country' => ucwords(strtolower($this->input->post('country'))),
        'state' => ucwords(strtolower($this->input->post('state'))),
        'city' => ucwords(strtolower($this->input->post('city'))),
        'address' => $this->input->post('address'),
        'address_2' => $this->input->post('address_2') ?? '',
        //'address_3' => $this->input->post('address_3'),
        'pincode' => $this->input->post('pincode'),
        'contact_person' => ucwords(strtolower($this->input->post('contact_person'))),
        'contact_person_isd_code' => $this->input->post('isd_codes'),
        'contact_person_number' => $this->input->post('contact_number'),
        'email' => $this->input->post('email'),
        'creation_date' => date('Y-m-d'),
        'gstin' => $this->input->post('gstin'),
        'user_id' => $this->session->userdata('id'),
        'designation' => $this->input->post('designation'),
        'acquiring_source'=>$this->input->post('acquiring_source') ?? '',
        'exhibition_source'=>$this->input->post('exhibition') ?? '',
        'remark'  => $this->input->post('remark') ?? '',
        'sales_admin_id'   => $this->input->post('sales') ?? '',
        'landline_number_isd_code' => $this->input->post('landline_number_isd_code'),
        'landline_number'  => $this->input->post('landline_number') ?? '',
        'email2'  => $this->input->post('email2') ?? '',
        'register_address' => $this->input->post('register_address') ?? '',
        'register_address2' => $this->input->post('register_address2') ?? '',
        'road_show' => $this->input->post('road_show') ?? '',
    );

    $result2 = $this->db->insert('company_details', $branch);

    if ($result1 || $result2) {
      return true;
    } else {
      return false;
    }
  }
  
  public function count_all_company()
  {

    $this->db->select('company.name, company.company_logo, company_details.*');
    $this->db->select('COUNT(company_details.company) as totalRows');
    $this->db->join('company', 'company.company_id = company_details.company');
    $this->db->where('company.is_deleted !=', '1');
    $this->db->where('company_details.status', 'active');

    if ($this->input->get('country') <> '') {
      $country = strtolower(urldecode($this->input->get('country')));
      $this->db->where('LOWER(company_details.country)', $country);
    }
    if ($this->input->get('state') <> '') {
      $state = strtolower(urldecode($this->input->get('state')));
      $arr = explode(',', $state);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
        unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company_details.state)', $arr);
    }
    if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
      $city = strtolower(urldecode($this->input->get('city')));
      $arr = explode(',', $city);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
        unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company_details.city)', $arr);
    }
    if ($this->input->get('company_id') <> '') {
      $this->db->where('company_details.company', $this->input->get('company_id'));
    }
    if ($this->input->get('agent') <> '') {
      $this->db->where('company_details.contact_person', $this->input->get('agent'));
    }
    if ($this->input->get('email') <> '') {
      $email = urldecode($this->input->get('email'));
      $this->db->where('company_details.email', $email);
    }
    if ($this->input->get('mobile') <> '') {
      $mobile = urldecode($this->input->get('mobile'));
      $this->db->where('company_details.contact_person_number', $mobile);
    }

    $this->db->group_by('company_details.company');
    $this->db->order_by('company_details.company_id', 'DESC');

    return $this->db->get('company_details')->num_rows();
  }

  public function all_company_enquiry($limit = '', $offset = '')
  {
      
    // if ($this->input->get('sales') <> '') {
    //     $sales_id = $this->input->get('sales');

    //     // Fetch salesperson's regions
    //     $this->db->select('region');
    //     $this->db->from('admin');
    //     $this->db->where('id', $sales_id);
    //     $this->db->where_in('type', [5, 6]);
    //     $salesperson = $this->db->get()->row();

    //     if ($salesperson && $salesperson->region) {
    //         $regions = explode(',', $salesperson->region);
    //         $regions = array_map('strtolower', array_map('trim', $regions));

    //         // Match against company state or country
    //         $this->db->group_start();
    //         $this->db->where_in('LOWER(company_details.state)', $regions);
    //         $this->db->or_where_in('LOWER(company_details.country)', $regions);
    //         $this->db->group_end();
    //     } else {
    //         // No regions assigned, filter nothing
    //         $this->db->where('1', 0);
    //     }
    // }
    
      
    $this->db->select('company.name, company.company_logo,company.date AS company_creation_date ,company_details.*');
    $this->db->select('COUNT(company_details.company) as totalRows');
    $this->db->select('(CASE 
        WHEN (
            SELECT COUNT(*) 
            FROM enquiry 
            WHERE enquiry.company_id = company.company_id 
              AND enquiry.status = "confirm"
        ) > 1 THEN "queries-converted"
        WHEN (
            SELECT COUNT(*) 
            FROM enquiry 
            WHERE enquiry.company_id = company.company_id 
              AND enquiry.status = "confirm"
        ) = 1 THEN "only-one-query-converted"
        WHEN EXISTS (
            SELECT 1 
            FROM enquiry 
            WHERE enquiry.company_id = company.company_id 
              AND enquiry.status != "confirm"
        ) THEN "query-received-but-not-converted"
        ELSE "no-query"
    END) as enquiry_status');

    $this->db->join('company', 'company.company_id = company_details.company', 'left');
    $this->db->where('company.is_deleted !=', '1');
    $this->db->where('company_details.status', 'active');
    
    

    if ($this->input->get('country') <> '') {
      //$country = strtolower(urldecode($this->input->get('country')));
      //$this->db->where('LOWER(company_details.country)', $country);
	  $country = strtolower(urldecode($this->input->get('country')));
      $arr = explode(',', $country);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
          unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company_details.country)', $arr);
    }

    if ($this->input->get('state') <> '') {
      $state = strtolower(urldecode($this->input->get('state')));
      $arr = explode(',', $state);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
        unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company_details.state)', $arr);
    }
    if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
      $city = strtolower(urldecode($this->input->get('city')));
      $arr = explode(',', $city);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
        unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company_details.city)', $arr);
    }
    if ($this->input->get('company_id') <> '') {
      $this->db->where('company_details.company', $this->input->get('company_id'));
    }
    if ($this->input->get('agent') <> '') {
      $agent = urldecode($this->input->get('agent'));
      $this->db->where('company_details.contact_person', $agent);
    }
    if ($this->input->get('email') <> '') {
      $email = urldecode($this->input->get('email'));
      $this->db->where('company_details.email', $email);
    }
    if ($this->input->get('mobile') <> '') {
      $mobile = urldecode($this->input->get('mobile'));
      $this->db->where('company_details.contact_person_number', $mobile);
    }

    if ($this->input->get('acquiring_source') <> '') {
      $acquiring_source = urldecode($this->input->get('acquiring_source'));
      $this->db->where('company_details.acquiring_source', $acquiring_source);
    }
    
    if ($this->input->get('exhibition') <> '') {
      $exhibition = urldecode($this->input->get('exhibition'));
      $this->db->where('company_details.exhibition_source', $exhibition);
    }
    
    if ($this->input->get('road_show') <> '') {
      $road_show = urldecode($this->input->get('road_show'));
      $this->db->where('company_details.road_show', $road_show);
    }
    
    if ($this->input->get('sales') <> '') {
      $sales = urldecode($this->input->get('sales'));
      $this->db->where('company_details.sales_admin_id', $sales);
    }

    if ($this->input->get('pincode') <> '') {
      $mobile = urldecode($this->input->get('pincode'));
      $this->db->where('company_details.pincode', $mobile);
    }

    if ($this->input->get('from') <> '') {
      $from = urldecode($this->input->get('from'));
      $this->db->where('company.date >=', $from);
    }

    if ($this->input->get('to') <> '') {
      $to = urldecode($this->input->get('to'));
      $this->db->where('company.date <=', $to);
    }

	
    if($this->input->get('year')<>''){
        if(array_key_exists('months', $this->input->get()) && $this->input->get('months')<>'' && $this->input->get('months')[0]<>'all'){
            $months = $this->input->get('months');
            $first_month = $months[0];
            $last_month = end($months);
            $from = $this->input->get('year')[0].'-'.$first_month.'-01';
            $to = $this->input->get('year')[0].'-'.$last_month.'-31';
        }else {
            if(count($this->input->get('year')) > 1){
                $years = $this->input->get('year');
                $from = $years[0].'-01-01';
                $to = end($years).'-12-31';
            }else{
                $from = $this->input->get('year')[0].'-01-01';
                $to = $this->input->get('year')[0].'-12-31';
            }
        }
        $this->db->where('company.date >=', $from);
        $this->db->where('company.date <=', $to);
    }
	
    $this->db->group_by('company_details.company');
    //$this->db->limit($limit, $offset);
    $this->db->order_by('company_details.company_id', 'DESC');
    //$query = $this->db->get('company_details');
    $query = $this->db->get_compiled_select('company_details');
    //echo $query;exit;
    return $query; 
  }

  public function count_all_companies()
  {

    $this->db->select('company.name, company.company_logo,company.country,company.state,company.city,company_details.*');
    $this->db->select('COUNT(company_details.company) as totalRows');
    $this->db->join('company', 'company.company_id = company_details.company');

    $this->db->where("(company.country = '' OR company.country IS NULL)");
    $this->db->where("(company.state = '' OR company.state IS NULL)");
    $this->db->where("(company.city = '' OR company.city IS NULL)");

    $this->db->where('company.is_deleted !=', '1');
    $this->db->where('company_details.status', 'active');

    if ($this->input->get('company_id') <> '') {
      $this->db->where('company_details.company', $this->input->get('company_id'));
    }

    $this->db->group_by('company_details.company');
    $this->db->order_by('company_details.company_id', 'DESC');

    return $this->db->get('company_details')->num_rows();
  }

  public function all_company_enquiries($limit = '', $offset = '')
  {

    $this->db->select('company.name, company.company_logo,company.country,company.state,company.city,company_details.*');
    $this->db->select('COUNT(company_details.company) as totalRows');
    $this->db->join('company', 'company.company_id = company_details.company', 'left');

    $this->db->where("(company.country = '' OR company.country IS NULL)");
    $this->db->where("(company.state = '' OR company.state IS NULL)");
    $this->db->where("(company.city = '' OR company.city IS NULL)");

    $this->db->where('company.is_deleted !=', '1');
    $this->db->where('company_details.status', 'active');

    if ($this->input->get('company_id') <> '') {
      $this->db->where('company_details.company', $this->input->get('company_id'));
    }

    $this->db->group_by('company_details.company');
    $this->db->limit($limit, $offset);
    $this->db->order_by('company_details.company_id', 'DESC');

    $query = $this->db->get('company_details');

    // Check if there are any results
    if ($query->num_rows() > 0) {
      return $query->result(); // Return the results
    } else {
      return false; // Return false if no results found
    }
  }

  public function company_details_data()
  {
    $this->db->where('company_details.status', 'active');
    $this->db->select('company_details.*');
    $this->db->where('company_details.company', $this->input->get('company_id'));
    $this->db->order_by('company_details.company_id', 'DESC');

    $query = $this->db->get('company_details');

    // Check if there are any results
    if ($query->num_rows() > 0) {
      return $query->result(); // Return the results
    } else {
      return false; // Return false if no results found
    }
  }
  
    public function count_database_report()
  {
    $this->db->select('company.*,company_details.contact_person,company_details.contact_person_number,company_details.email');
    $this->db->select('COUNT(company_details.company) as totalRows');
    $this->db->join('company', 'company.company_id = company_details.company');
    $this->db->where('company.is_deleted !=', '1');
    $this->db->where('company_details.status', 'active');

    if ($this->input->get('country') <> '') {
      $country = strtolower(urldecode($this->input->get('country')));
      $arr = explode(',', $country);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
          unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company.country)', $arr);
    }
    if ($this->input->get('state') <> '') {
      $state = strtolower(urldecode($this->input->get('state')));
      $arr = explode(',', $state);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
        unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company.state)', $arr);
    }
    if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
      $city = strtolower(urldecode($this->input->get('city')));
      $arr = explode(',', $city);
      $arr = array_map('trim', $arr);
      if (end($arr) == '') {
        unset($arr[count($arr) - 1]);
      }
      $this->db->where_in('LOWER(company.city)', $arr);
    }
    if ($this->input->get('company_id') <> '') {
      $this->db->where('company_details.company', $this->input->get('company_id'));
    }
    if ($this->input->get('agent') <> '') {
      $this->db->where('company_details.contact_person', $this->input->get('agent'));
    }
    if ($this->input->get('email') <> '') {
      $email = urldecode($this->input->get('email'));
      $this->db->where('company_details.email', $email);
    }
    if ($this->input->get('mobile') <> '') {
      $mobile = urldecode($this->input->get('mobile'));
      $this->db->where('company_details.contact_person_number', $mobile);
    }

    $this->db->group_by('company_details.company');
    $this->db->order_by('company_details.company_id', 'DESC');

    return $this->db->get('company_details')->num_rows();
  }

  // public function all_database_report($limit = '', $offset = '')
  // {

  //   $this->db->select('company.*,company_details.contact_person,company_details.contact_person_number,company_details.email');
  //   $this->db->select('COUNT(company_details.company) as totalRows');
  //   $this->db->join('company', 'company.company_id = company_details.company', 'left');
  //   $this->db->where('company.is_deleted !=', '1');
  //   $this->db->where('company_details.status', 'active');

  //   if ($this->input->get('country') <> '') {
  //     $country = strtolower(urldecode($this->input->get('country')));
  //     $arr = explode(',', $country);
  //     $arr = array_map('trim', $arr);
  //     if (end($arr) == '') {
  //         unset($arr[count($arr) - 1]);
  //     }
  //     $this->db->where_in('LOWER(company.country)', $arr);
  //   }
  //   if ($this->input->get('state') <> '') {
  //     $state = strtolower(urldecode($this->input->get('state')));
  //     $arr = explode(',', $state);
  //     $arr = array_map('trim', $arr);
  //     if (end($arr) == '') {
  //       unset($arr[count($arr) - 1]);
  //     }
  //     $this->db->where_in('LOWER(company.state)', $arr);
  //   }
  //   if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
  //     $city = strtolower(urldecode($this->input->get('city')));
  //     $arr = explode(',', $city);
  //     $arr = array_map('trim', $arr);
  //     if (end($arr) == '') {
  //       unset($arr[count($arr) - 1]);
  //     }
  //     $this->db->where_in('LOWER(company.city)', $arr);
  //   }
  //   if ($this->input->get('company_id') <> '') {
  //     $this->db->where('company_details.company', $this->input->get('company_id'));
  //   }
  //   if ($this->input->get('agent') <> '') {
  //     $agent = urldecode($this->input->get('agent'));
  //     $this->db->where('company_details.contact_person', $agent);
  //   }
  //   if ($this->input->get('email') <> '') {
  //     $email = urldecode($this->input->get('email'));
  //     $this->db->where('company_details.email', $email);
  //   }
  //   if ($this->input->get('mobile') <> '') {
  //     $mobile = urldecode($this->input->get('mobile'));
  //     $this->db->where('company_details.contact_person_number', $mobile);
  //   }

  //   $this->db->group_by('company_details.company');
  //   $this->db->limit($limit, $offset);
  //   $this->db->order_by('company_details.company_id', 'DESC');

  //   $query = $this->db->get('company_details');

  //   //echo $this->db->last_query();
  //   //exit;

  //   // Check if there are any results
  //   if ($query->num_rows() > 0) {
  //     return $query->result(); // Return the results
  //   } else {
  //     return false; // Return false if no results found
  //   }
  // }
  

}

?>