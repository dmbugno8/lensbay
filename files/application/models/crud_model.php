<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    /*  
       *    Developed by: Syncrypts
       *    Date    : 21 January, 2015
       *    Invenire Stock Inventory Manager
       *    http://codecanyon.net/user/syncrypts
    */

class Crud_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    // DECLARATION: CREATE A NEW SALE
    function add_new_sale()
    {
        $data['invoice_code']        = $this->input->post('invoice_code');
        $data['discount_percentage'] = $this->input->post('discount_percentage');
        $data['vat_percentage']      = $this->input->post('vat_percentage');
        $data['customer_id']         = $this->input->post('customer_id');
        $data['timestamp']           = strtotime($this->input->post('timestamp'));
        $invoice_entries             = array();
        $product_ids                 = $this->input->post('product_id');
        $total_numbers               = $this->input->post('total_number');
        $selling_prices              = $this->input->post('selling_price');
        $customer                    = $this->input->post('customer_id');
        $number_of_entries           = sizeof($product_ids);
        for ($i = 0; $i < $number_of_entries; $i++) {
            if ($product_ids[$i] != "" && $total_numbers[$i] != "" && $selling_prices[$i] != "") {
                $new_entry = array(
                    'product_id' => $product_ids[$i],
                    'total_number' => $total_numbers[$i],
                    'selling_price' => $selling_prices[$i]
                );
                array_push($invoice_entries, $new_entry);
                // DECREASES THE PRODUCT QUANTITY FROM STOCK 
                $this->db->where('product_id', $product_ids[$i]);
                $this->db->set('stock_quantity', 'stock_quantity - ' . $total_numbers[$i], FALSE);
                $this->db->update('product');
            }
        }
        $data['invoice_entries'] = json_encode($invoice_entries);
        $this->db->insert('invoice', $data);
        $invoice_id           = $this->db->insert_id();
        // CREATE PAYMENT ENTRY
        $data2['invoice_id']  = $invoice_id;
        $data2['amount']      = $this->input->post('amount');
        $data2['method']      = $this->input->post('method');
        $data2['type']        = 'income';
        $data2['timestamp']   = strtotime(date("Y-m-d H:i:s"));
        $data2['customer_id'] = $this->input->post('customer_id');
        $this->db->insert('payment', $data2);
        // MAIL SENDING TO CUSTOMER
        $email_to = $this->db->get_where('customer', array(
            'customer_id' => $data2['customer_id']
        ))->row()->email;
        $this->email_model->sale_notification_email_to_customer($email_to);
        return $invoice_id;
    }

    // DECLARATION: CREATE A NEW PURCHASE
    function new_purchase()
    {
        $data['purchase_code'] = $this->input->post('purchase_code');
        $data['supplier_id']   = $this->input->post('supplier_id');
        $data['product_id']    = $this->input->post('product_id');
        $data['quantity']      = $this->input->post('quantity');
        $data['unit_price']    = $this->input->post('unit_price');
        $data['total_amount']  = $this->input->post('total_amount');
        $data['timestamp']     = strtotime($this->input->post('timestamp'));
        $this->db->insert('purchase', $data);
        $new_purchase_id       = $this->db->insert_id();
        $current_purchase_code = $data['purchase_code'];
        $data2['type']         = 'expense';
        $data2['method']       = $this->input->post('method');
        $data2['amount']       = $this->input->post('total_amount');
        $data2['timestamp']    = strtotime($this->input->post('timestamp'));
        $data2['supplier_id']  = $this->input->post('supplier_id');
        $data2['purchase_id']  = $new_purchase_id;
        $this->db->insert('payment', $data2);
        $stock_quantity          = $this->db->get_where('product', array(
            'product_id' => $this->input->post('product_id')
        ))->row()->stock_quantity;
        $data3['purchase_price'] = $this->input->post('unit_price');
        $data3['stock_quantity'] = $this->input->post('quantity') + $stock_quantity;
        $this->db->where('product_id', $this->input->post('product_id'));
        $this->db->update('product', array(
            'purchase_price' => $data3['purchase_price'],
            'stock_quantity' => $data3['stock_quantity']
        ));
        $this->session->set_flashdata('flash_message', 'Purchase entry successful');
        return $current_purchase_code;
    }

    // DECLARATION: SEND NEW MESSAGE
    function send_new_message()
    {
        $message_body = $this->input->post('message_body');
        $receiver     = $this->input->post('receiver');
        $sender       = $this->session->userdata('login_type') . '-' . $this->session->userdata('user_id');
        $query1       = $this->db->get_where('message_thread', array(
            'sender' => $sender,
            'receiver' => $receiver
        ))->num_rows();
        $query2       = $this->db->get_where('message_thread', array(
            'sender' => $receiver,
            'receiver' => $sender
        ))->num_rows();
        if ($query1 == 0 && $query2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['receiver']            = $receiver;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($query1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array(
                'sender' => $sender,
                'receiver' => $receiver
            ))->row()->message_thread_code;
        if ($query2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array(
                'sender' => $receiver,
                'receiver' => $sender
            ))->row()->message_thread_code;
        $timestamp                           = strtotime(date("Y-m-d H:i:s"));
        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message_body']        = $message_body;
        $data_message['sender']              = $sender;
        $data_message['timestamp']           = $timestamp;
        $this->db->insert('message', $data_message);
        return $message_thread_code;
    }

    // DECLARATION: SEND REPLY MESSAGE
    function send_reply_message($message_thread_code)
    {
        $message_body                        = $this->input->post('message_body');
        $timestamp                           = strtotime(date("Y-m-d H:i:s"));
        $sender                              = $this->session->userdata('login_type') . '-' . $this->session->userdata('user_id');
        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message_body']        = $message_body;
        $data_message['sender']              = $sender;
        $data_message['timestamp']           = $timestamp;
        $this->db->insert('message', $data_message);
    }

    // DECLARATION: GET ANY IMAGE LOCATION OF USERS
    function get_image_url($type = '', $id = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/avatar.png';
        return $image_url;
    }

    // DECLARATION: GET ANY IMAGE LOCATION OF PRODUCTS
    function get_image_url_object($type = '', $id = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/none.png';
        return $image_url;
    }
}

/* End of file crud_model.php */
/* Location: ./application/models/crud_model.php */