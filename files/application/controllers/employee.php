<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	/*	
	   *	Developed by: Syncrypts
       *	Date	: 21 January, 2015
       *	Invenire Stock Inventory Manager
       *	http://codecanyon.net/user/syncrypts
    */

class Employee extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	// DECLARATION: DEFAULT FUCTION
	public function index()
	{
		$this->load->view('index');
	}

	// DECLARATION: EMPLOYEE DASHBOARD
	function dashboard()
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = 'Dashboard';
		$this->load->view('index', $page_data);
	}
	
	// DECLARATION: NEW PURCHASE
	function purchase_add($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$this->crud_model->new_purchase();
			$this->email_model->purchase_notification_email_to_admin();
			$this->session->set_flashdata('flash_message', 'New purchase added successfully');
			redirect(base_url() . 'index.php?employee/purchase_add');
		}
		$page_data['page_name']  = 'purchase_add';
		$page_data['page_title'] = 'New Purchase';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW PURCHASE HISRTORY
	function purchase_history()
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		$this->db->order_by('purchase_id', 'desc');
		$page_data['purchases']  = $this->db->get('purchase')->result_array();
		$page_data['page_name']  = 'purchase_history';
		$page_data['page_title'] = 'Purchase History';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: NEW SALE
	function sale_add($param1 = '')
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'do_add') {
			$invoice_id = $this->crud_model->add_new_sale();
			//send mail to admin
			$this->email_model->sale_notification_email_to_admin();
			$this->session->set_flashdata('flash_message', 'New sale added successfully');
			redirect(base_url() . 'index.php?employee/sale_invoice_view/' . $invoice_id);
		}
		$page_data['page_name']  = 'sale_add';
		$page_data['page_title'] = 'Create a new sale';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SALE INVOICES
	function sale_invoice($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'sale_invoice';
		$page_data['page_title'] = 'Sale invoices';
		$this->db->order_by('invoice_id', 'desc');
		$page_data['invoices'] = $this->db->get('invoice')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW SALE INVOICE
	function sale_invoice_view($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['invoice_id'] = $param1;
		$page_data['page_name']  = 'sale_invoice_view';
		$page_data['page_title'] = 'Sale Invoice';
		$this->load->view('index', $page_data);
	}

	//DECLARATION: GET PRODUCT LIST 
	function get_sale_product_list($type, $category_id)
	{
		if ($type == 'category')
			$products = $this->db->get_where('product', array(
				'category_id' => $category_id
			))->result_array();
		if ($type == 'sub_category')
			$products = $this->db->get_where('product', array(
				'sub_category_id' => $category_id
			))->result_array();
		foreach ($products as $row) {
			echo '<div class="panel-footer">
	                <img class="img-circle" style="width: 30px; height: 30px;" src="' . base_url() . 'uploads/product_image/' . $row['product_id'] . '.jpg">
	                    ' . $row['name'] . '
	                <button class="btn btn-success btn-circle pull-right" type="button"
	                    onclick="add_product(' . $row['product_id'] . ')"><i class="fa fa-plus"></i>
	                        </button>
	            </div>';
		}
	}

	// DECLARATION: GET SUB CATEGORY LIST OF PRODUCTS
	function get_sub_category_list($category_id)
	{
		echo '<select data-placeholder="Select a sub-category" onchange="get_product(\'sub_category\' , this.value)" 
	                class="form-control" name="sub_category_id">
	                <option value="">Select a sub-category</option>';
		$sub_categories = $this->db->get_where('sub_category', array(
			'category_id' => $category_id
		))->result_array();
		foreach ($sub_categories as $row):
			echo '<option value="' . $row['sub_category_id'] . '">' . $row['name'] . '</option>';
		endforeach;
		echo '</select>';
	}

	// DECLARATION: GET SELECTED PRODUCTS TO BE SOLD
	function get_selected_product($input_type, $input_id, $total_number)
	{
		if ($input_type == 'mouse') {
			$product_info = $this->db->get_where('product', array(
				'product_id' => $input_id
			))->row();
		} else if ($input_type == 'barcode') {
			$product_info = $this->db->get_where('product', array(
				'serial_number' => $input_id
			))->row();
		}
		echo '<tr id="entry_row_' . $total_number . '">
	                <td id="serial_number_' . $total_number . '">' . $total_number . '</td>
	                <td>' . $product_info->serial_number . '</td>
	                <td>
	                	' . $product_info->name . '
	                    <input type="hidden" name="product_id[]" value="' . $product_info->product_id . '" size="3" style="width:50px;" 
	                    	id="single_entry_product_id_' . $total_number . '">
	                </td>
	                <td>
	                    <input type="number" name="total_number[]" value="1" size="3" style="width:50px;" 
	                    	id="single_entry_quantity_' . $total_number . '" max="4"
	                    		onkeyup="calculate_single_entry_total(' . $total_number . ')">
	                </td>
	                <td>
	                    <input type="number" name="selling_price[]" value="' . $product_info->selling_price . '"  
	                    	id="single_entry_selling_price_' . $total_number . '"
	                    		onkeyup="calculate_single_entry_total(' . $total_number . ')">
	                </td>
	                <td id="single_entry_total_' . $total_number . '">' . $product_info->selling_price . '</td>
	                <td>
	                	<i class="fa fa-trash-o" onclick="remove_row(' . $total_number . ')"
	                		id="delete_button_' . $total_number . '"	style="cursor:pointer;"></i>
	                	 	</td>
	            </tr>';
	}

	// DECLARATION: PRIVATE MESSAGING 
	function message($message_thread_code = '')
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']           = 'message';
		$page_data['page_title']          = 'Private Messaging';
		$page_data['message_thread_code'] = $message_thread_code;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SEND A NEW MESSAGE
	function message_new($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('employee_login') != 1)
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
			redirect(base_url() . 'index.php?employee/message_read/' . $new_message_thread_code, 'refresh');
		}
		$page_data['page_name']           = 'message_new';
		$page_data['page_title']          = 'Messaging';
		$page_data['message_thread_code'] = $param2;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: READ THE SENT MESSAGES
	function message_read($message_thread_code)
	{
		if ($this->session->userdata('employee_login') != 1)
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
		redirect(base_url() . 'index.php?employee/message_read/' . $message_thread_code, 'refresh');
	}
	// DECLARATION: EMPLOYEE PROFILE SETTINGS
	function profile_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('employee_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'update') {
			$data['name']  = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$this->db->where('employee_id', $this->session->userdata('user_id'));
			$this->db->update('employee', $data);
			// UPLOAD IMAGE FILE
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $this->session->userdata('user_id') . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?employee/profile_settings', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['previous_password'] = sha1($this->input->post('previous_password'));
			$data['new_password']      = sha1($this->input->post('new_password'));
			$data['confirm_password']  = sha1($this->input->post('confirm_password'));
			$existing_password         = $this->db->get_where('employee', array(
				'employee_id' => $this->session->userdata('user_id')
			))->row()->password;
			if ($existing_password == $data['previous_password'] && $data['new_password'] == $data['confirm_password']) {
				$this->db->where('employee_id', $this->session->userdata('user_id'));
				$this->db->update('employee', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', 'Password Change Successful');
			} else {
				$this->session->set_flashdata('flash_message', 'Password Mismatch');
			}
			redirect(base_url() . 'index.php?employee/profile_settings', 'refresh');
		}
		$page_data['page_name']  = 'profile_settings';
		$page_data['employee']   = $this->db->get_where('employee', array(
			'employee_id' => $this->session->userdata('user_id')
		))->result_array();
		$page_data['page_title'] = 'Profile';
		$this->load->view('index', $page_data);
	}
}

/* End of file employee.php */
/* Location: ./application/controllers/employee.php */
