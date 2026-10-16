<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partybus_model extends CI_Model
{

    public function count_rows()
    {
        $this->db->select('party_bus.*, packages.package');
        $this->db->join('packages', 'packages.id = party_bus.package', 'left');
        $this->db->where('party_bus.status', 1);

        if ($this->input->get('submit') == '') {
            $this->db->where('party_bus.date_of_booking>=', date('Y-m-d'));
        }

        if ($this->input->get('booking_date') <> '') {
            $booking_date = urldecode($this->input->get('booking_date'));
            $this->db->where('party_bus.date_of_booking', $booking_date);
        }

        if (!empty($this->input->get('file_number'))) {
            $file_number = urldecode($this->input->get('file_number'));
            $this->db->where('party_bus.file_number', $file_number);
        }
        if (!empty($this->input->get('kazin_query'))) {
            $kazin_query = urldecode($this->input->get('kazin_query'));
            $this->db->where('party_bus.kazin_query', $kazin_query);
        }
        if (!empty($this->input->get('package'))) {
            $package = urldecode($this->input->get('package'));
            $this->db->where('party_bus.package ', $package);
        }

        $this->db->order_by('party_bus.date_of_booking', 'ASC');
        return $this->db->get('party_bus')->num_rows();
    }

    public function get_rows($limit, $offset)
    {
        $this->db->select('party_bus.*, packages.package');
        $this->db->join('packages', 'packages.id = party_bus.package', 'left');
        $this->db->where('party_bus.status', 1);

        if ($this->input->get('submit') == '') {
            $this->db->where('party_bus.date_of_booking>=', date('Y-m-d'));
        }

        if ($this->input->get('booking_date') <> '') {
            $booking_date = urldecode($this->input->get('booking_date'));
            $this->db->where('party_bus.date_of_booking', $booking_date);
        }

        if (!empty($this->input->get('file_number'))) {
            $file_number = urldecode($this->input->get('file_number'));
            $this->db->where('party_bus.file_number', $file_number);
        }
        if (!empty($this->input->get('kazin_query'))) {
            $kazin_query = urldecode($this->input->get('kazin_query'));
            $this->db->where('party_bus.kazin_query', $kazin_query);
        }
        if (!empty($this->input->get('package'))) {
            $package = urldecode($this->input->get('package'));
            $this->db->where('party_bus.package ', $package);
        }

        $this->db->order_by('party_bus.date_of_booking', 'ASC');
        $this->db->limit($limit, $offset);
        $result = $this->db->get('party_bus');
        return $result->result();
    }

    // public function get_rows()
    // {

    //     $this->db->select('party_bus.*, packages.package');
    //     $this->db->join('packages', 'packages.id = party_bus.package', 'left');
    //     $this->db->where('party_bus.status', 1);
    //     // $this->db->order_by("str_to_date(" . $oBy . ", '%d-%b-%Y')", "asc");
    //     // $this->db->order_by('date', 'ASC');
    //     $result = $this->db->get('party_bus');
    //     return $result = $result->result();
    // }

    public function add_bus()
    {
        $data = array(
            'file_Number' => $this->input->post('file_number'),
            'enquiry_form' => $this->input->post('enquiry_form'),
            'kazin_query' => $this->input->post('kazin_query'),
            'date_of_booking' => $this->input->post('date_of_booking'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'reporting_location' => $this->input->post('reporting_location'),
            'end_location' => $this->input->post('end_location'),
            'package' => $this->input->post('package'),
            'number_of_passengers' => $this->input->post('passengers'),
            'currency' => $this->input->post('currency'),
            'package_price' => $this->input->post('package_price'),
            'payment_recieved' => $this->input->post('payment_recieved'),
            'balance' => $this->input->post('balance'),
            'purchase_cost' => $this->input->post('purchase_cost'),
            'net_margin' => $this->input->post('net_margin'),
            'remarks' => $this->input->post('remarks'),
            'status' => '1'
        );

        $bus_add = $this->db->insert('party_bus', $data);

        if (!empty($bus_add)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_bus()
    {

        $this->db->select('party_bus.*');
        $this->db->where('party_bus.id', $this->uri->segment(1));
        $result = $this->db->get('party_bus');
        $result = $result->result();


        $data = array(
            'status' => 0
        );

        $this->db->where('id', $this->uri->segment(1));
        $this->db->update('party_bus', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>