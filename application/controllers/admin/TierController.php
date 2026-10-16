<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TierController extends CI_Controller
{

    var $locations = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ'],
        'georgia' => ['FGE', 'GGE', 'IGE'],
        'armenia' => ['FAR','GAR','IAR'],
        'uzbekistan' => ['FUZ','GUZ','IUZ'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ']
    ];
    var $allowed_users = ['1'];
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        check_delete();
        $this->load->model(['admin/TierModel','common_model']);
        $this->load->library('pagination');
    }

    public function index()
    {
        if (!in_array($this->session->userdata('type'), $this->allowed_users)) {
            redirect('admin/dashboard');
        }

        $data['states'] = $this->TierModel->get_State();
        $data['title'] = 'Arrival Chart';
        $data['content'] = 'admin/tier_state_filter';

        // Fetch existing record
        $existing = $this->db->get('tiermaster')->row();
        $data['existing'] = $existing;
        log_user_activity('Tier Filter', $this->session->userdata('id'), 'Viewed Tier Filter Page');

        if ($this->input->post()) {
            $tier1 = $this->input->post('tier1');
            $tier2 = $this->input->post('tier2');
            $tier3 = $this->input->post('tier3');

            $insert_data = [
                'tier1' => !empty($tier1) ? implode(',', $tier1) : '',
                'tier2' => !empty($tier2) ? implode(',', $tier2) : '',
                'tier3' => !empty($tier3) ? implode(',', $tier3) : ''
            ];

            if ($existing) {
                // update existing record using its ID
                $this->TierModel->update_data($insert_data, $existing->id);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data updated successfully</div>');
                log_user_activity('Tier Filter', $this->session->userdata('id'), 'Updated Tier Data: ' . json_encode($insert_data));

            } else {
                // Insert new record
                $this->TierModel->insert_data($insert_data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data saved successfully</div>');
                log_user_activity('Tier Filter', $this->session->userdata('id'), 'Inserted New Tier Data: ' . json_encode($insert_data));
            }

            redirect('tier-filter');
        }

        $this->load->view('admin/layout', $data);
    }


}