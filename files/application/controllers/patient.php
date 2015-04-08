<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	/*	
	   *	Developed by: Syncrypts
       *	Date	: 21 January, 2015
       *	Invenire Stock Inventory Manager
       *	http://codecanyon.net/user/syncrypts
    */

class Patient extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	// DECLARATION: DEFAULT FUNCTION
	public function index()
	{
		$this->load->view('index');
	}

	// DECLARATION: Patient DASHBOARD
	function dashboard()
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = 'Dashboard';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW ALL PRODUCTS
	function product($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'product';
		$page_data['page_title'] = 'Products';
		$page_data['products']   = $this->db->get('product')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE ORDERS
	function order($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['order_number']     = rand() . "\n";
			$data['patient_id']      = $this->session->userdata('user_id');
			$data['product_id']       = $this->input->post('product_id');
			$data['quantity']         = $this->input->post('quantity');
			$data['shipping_address'] = $this->input->post('shipping_address');
			$data['note']             = $this->input->post('note');
			$data['timestamp']        = strtotime($this->input->post('timestamp'));
			$this->db->insert('order', $data);
			$this->session->set_flashdata('flash_message', 'Order added to pending');
			// MAIL SENDING TO ADMIN FOR APPROVAL
			$order_number     = $data['order_number'];
			$email_from       = $this->db->get_where('patient', array(
				'patient_id' => $data['patient_id']
			))->row()->email;
			$product_ordered  = $this->db->get_where('product', array(
				'product_id' => $data['product_id']
			))->row()->name;
			$product_quantity = $data['quantity'];
			$patient_name    = $this->db->get_where('patient', array(
				'patient_id' => $data['patient_id']
			))->row()->name;
			$this->email_model->order_creating_email_by_patient($email_from, $patient_name, $order_number, $product_ordered, $product_quantity, 'Pending');
			redirect(base_url() . 'index.php?patient/order', 'refresh');
		}
		$page_data['page_name']  = 'order';
		$page_data['page_title'] = 'Orders';
		$page_data['orders']     = $this->db->get_where('order', array(
			'patient_id' => $this->session->userdata('user_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW PURCHASE HISTORY
	function purchase_history($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'purchase_history';
		$page_data['page_title'] = 'Purchase History';
		$this->db->order_by('invoice_id', 'desc');
		$this->db->where('patient_id', $this->session->userdata('user_id'));
		$page_data['invoices'] = $this->db->get('invoice')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW SALE INVOICE
	function invoice_view($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['invoice_id'] = $param1;
		$page_data['page_name']  = 'invoice_view';
		$page_data['page_title'] = 'Invoice';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: PRIVATE MESSAGING
	function message($message_thread_code = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']           = 'message';
		$page_data['page_title']          = 'Private Messaging';
		$page_data['message_thread_code'] = $message_thread_code;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SEND A NEW MESSAGE TO ADMIN
	function message_new($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'send_new_message') {
			$new_message_thread_code = $this->crud_model->send_new_message();
			$this->session->set_flashdata('flash_message', 'Message Sent');
			// MAIL SENDING TO ADMIN
			$sender_account_type = $this->session->userdata('login_type');
			$sender_id           = $this->session->userdata('user_id');
			$email_from          = $this->db->get_where($sender_account_type, array(
				$sender_account_type . '_id' => $sender_id
			))->row()->email;
			$this->email_model->message_notification_email_sender_user($sender_account_type, $email_from);
			redirect(base_url() . 'index.php?patient/message_read/' . $new_message_thread_code, 'refresh');
		}
		$page_data['page_name']           = 'message_new';
		$page_data['page_title']          = 'Messaging';
		$page_data['message_thread_code'] = $param2;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: READ MESSAGES
	function message_read($message_thread_code)
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']           = 'message_read';
		$page_data['page_title']          = 'Read messages';
		$page_data['message_thread_code'] = $message_thread_code;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: REPLY MRSSAGES
	function message_reply($message_thread_code)
	{
		$this->crud_model->send_reply_message($message_thread_code);
		$this->session->set_flashdata('flash_message', 'Message sent');
		// MAIL SENDING TO ADMIN
		$sender_account_type = $this->session->userdata('login_type');
		$sender_id           = $this->session->userdata('user_id');
		$email_from          = $this->db->get_where($sender_account_type, array(
			$sender_account_type . '_id' => $sender_id
		))->row()->email;
		$this->email_model->message_notification_email_sender_user($sender_account_type, $email_from);
		redirect(base_url() . 'index.php?patient/message_read/' . $message_thread_code, 'refresh');
	}

	// DECLARATION: patient PROFILE SETTINGS
	function profile_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('patient_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'update') {
			$data['name']  = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$this->db->where('patient_id', $this->session->userdata('user_id'));
			$this->db->update('patient', $data);
			// UPLOAD IMAGE FILE
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/patient_image/' . $this->session->userdata('user_id') . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?patient/profile_settings', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['previous_password'] = sha1($this->input->post('previous_password'));
			$data['new_password']      = sha1($this->input->post('new_password'));
			$data['confirm_password']  = sha1($this->input->post('confirm_password'));
			$existing_password         = $this->db->get_where('patient', array(
				'patient_id' => $this->session->userdata('user_id')
			))->row()->password;
			if ($existing_password == $data['previous_password'] && $data['new_password'] == $data['confirm_password']) {
				$this->db->where('patient_id', $this->session->userdata('user_id'));
				$this->db->update('patient', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', 'Password Change Successful');
			} else {
				$this->session->set_flashdata('flash_message', 'Password Mismatch');
			}
			redirect(base_url() . 'index.php?patient/profile_settings', 'refresh');
		}
		$page_data['page_name']  = 'profile_settings';
		$page_data['patient']   = $this->db->get_where('patient', array(
			'patient_id' => $this->session->userdata('user_id')
		))->result_array();
		$page_data['page_title'] = 'Profile';
		$this->load->view('index', $page_data);
	}
}

/* End of file patient.php */
/* Location: ./application/controllers/patient.php */
