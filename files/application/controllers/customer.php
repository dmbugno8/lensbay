<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	/*	
	   *	Developed by: Syncrypts
       *	Date	: 21 January, 2015
       *	Invenire Stock Inventory Manager
       *	http://codecanyon.net/user/syncrypts
    */

class Customer extends CI_Controller
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

	// DECLARATION: CUSTOMER DASHBOARD
	function dashboard()
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = 'Dashboard';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW ALL PRODUCTS
	function product($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'product';
		$page_data['page_title'] = 'Products';
		$page_data['products']   = $this->db->get('product')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE ORDERS
	function order($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['order_number']     = rand() . "\n";
			$data['customer_id']      = $this->session->userdata('user_id');
			$data['product_id']       = $this->input->post('product_id');
			$data['quantity']         = $this->input->post('quantity');
			$data['shipping_address'] = $this->input->post('shipping_address');
			$data['note']             = $this->input->post('note');
			$data['timestamp']        = strtotime($this->input->post('timestamp'));
			$this->db->insert('order', $data);
			$this->session->set_flashdata('flash_message', 'Order added to pending');
			// MAIL SENDING TO ADMIN FOR APPROVAL
			$order_number     = $data['order_number'];
			$email_from       = $this->db->get_where('customer', array(
				'customer_id' => $data['customer_id']
			))->row()->email;
			$product_ordered  = $this->db->get_where('product', array(
				'product_id' => $data['product_id']
			))->row()->name;
			$product_quantity = $data['quantity'];
			$customer_name    = $this->db->get_where('customer', array(
				'customer_id' => $data['customer_id']
			))->row()->name;
			$this->email_model->order_creating_email_by_customer($email_from, $customer_name, $order_number, $product_ordered, $product_quantity, 'Pending');
			redirect(base_url() . 'index.php?customer/order', 'refresh');
		}
		$page_data['page_name']  = 'order';
		$page_data['page_title'] = 'Orders';
		$page_data['orders']     = $this->db->get_where('order', array(
			'customer_id' => $this->session->userdata('user_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW PURCHASE HISTORY
	function purchase_history($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'purchase_history';
		$page_data['page_title'] = 'Purchase History';
		$this->db->order_by('invoice_id', 'desc');
		$this->db->where('customer_id', $this->session->userdata('user_id'));
		$page_data['invoices'] = $this->db->get('invoice')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: VIEW SALE INVOICE
	function invoice_view($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['invoice_id'] = $param1;
		$page_data['page_name']  = 'invoice_view';
		$page_data['page_title'] = 'Invoice';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: PRIVATE MESSAGING
	function message($message_thread_code = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']           = 'message';
		$page_data['page_title']          = 'Private Messaging';
		$page_data['message_thread_code'] = $message_thread_code;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SEND A NEW MESSAGE TO ADMIN
	function message_new($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
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
			redirect(base_url() . 'index.php?customer/message_read/' . $new_message_thread_code, 'refresh');
		}
		$page_data['page_name']           = 'message_new';
		$page_data['page_title']          = 'Messaging';
		$page_data['message_thread_code'] = $param2;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: READ MESSAGES
	function message_read($message_thread_code)
	{
		if ($this->session->userdata('customer_login') != 1)
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
		redirect(base_url() . 'index.php?customer/message_read/' . $message_thread_code, 'refresh');
	}

	// DECLARATION: CUSTOMER PROFILE SETTINGS
	function profile_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'update') {
			$data['name']  = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$this->db->where('customer_id', $this->session->userdata('user_id'));
			$this->db->update('customer', $data);
			// UPLOAD IMAGE FILE
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $this->session->userdata('user_id') . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?customer/profile_settings', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['previous_password'] = sha1($this->input->post('previous_password'));
			$data['new_password']      = sha1($this->input->post('new_password'));
			$data['confirm_password']  = sha1($this->input->post('confirm_password'));
			$existing_password         = $this->db->get_where('customer', array(
				'customer_id' => $this->session->userdata('user_id')
			))->row()->password;
			if ($existing_password == $data['previous_password'] && $data['new_password'] == $data['confirm_password']) {
				$this->db->where('customer_id', $this->session->userdata('user_id'));
				$this->db->update('customer', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', 'Password Change Successful');
			} else {
				$this->session->set_flashdata('flash_message', 'Password Mismatch');
			}
			redirect(base_url() . 'index.php?customer/profile_settings', 'refresh');
		}
		$page_data['page_name']  = 'profile_settings';
		$page_data['customer']   = $this->db->get_where('customer', array(
			'customer_id' => $this->session->userdata('user_id')
		))->result_array();
		$page_data['page_title'] = 'Profile';
		$this->load->view('index', $page_data);
	}
}


	// DECLARATION: NEW SALE
	function sale_add($param1 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'do_add') {
			$invoice_id = $this->crud_model->add_new_sale();
			//send mail to admin
			$this->email_model->sale_notification_email_to_admin();
			$this->session->set_flashdata('flash_message', 'New sale added successfully');
			redirect(base_url() . 'index.php?customer/sale_invoice_view/' . $invoice_id);
		}
		$page_data['page_name']  = 'sale_add';
		$page_data['page_title'] = 'Create a new sale';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SALE INVOICES
	function sale_invoice($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
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
		if ($this->session->userdata('customer_login') != 1)
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






		// DECLARATION: MANAGE PATIENT
	function patient2($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('customer_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['patient_code'] = $this->input->post('patient_code');
			$data['email']         = $this->input->post('email');
			$data['password']      = sha1($this->input->post('password'));
			$data['phone']         = $this->input->post('phone');
			$data['gender']        = $this->input->post('gender');
			$data['age']           = $this->input->post('age');
			$data['customer_id']           = $this->input->post('customer_id');
			$data['bill_to_name']	= $this->input->post('bill_to_name');
			$data['bill_to_street']	= $this->input->post('bill_to_street');
			$data['bill_to_city']	= $this->input->post('bill_to_city');
			$data['bill_to_state']	= $this->input->post('bill_to_state');
			$data['bill_to_zip']	= $this->input->post('bill_to_zip');
			$data['ship_to_name']	= $this->input->post('ship_to_name');
			$data['ship_to_street']	= $this->input->post('ship_to_street');
			$data['ship_to_city']	= $this->input->post('ship_to_city');
			$data['ship_to_state']	= $this->input->post('ship_to_state');
			$data['ship_to_zip']	= $this->input->post('ship_to_zip');
			$this->db->insert('patient', $data);
			// UPLOAD IMAGE FILE
			$patient_id       = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/patient_image/' . $patient_id . '.jpg');
			
			// MAIL SENDING TO PATIENT
			$password_unhashed = $this->input->post('password');
			$email_to          = $data['email'];
			$this->session->set_flashdata('flash_message', 'New patient added successfully');
			$this->email_model->account_opening_email('patient', $email_to, $password_unhashed);
			redirect(base_url() . 'index.php?customer/patient', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['email']   = $this->input->post('email');
			$data['phone']   = $this->input->post('phone');
			$data['gender']  = $this->input->post('gender');
			$data['age']     = $this->input->post('age');
			$data['bill_to_name']	= $this->input->post('bill_to_name');
			$data['bill_to_street']	= $this->input->post('bill_to_street');
			$data['bill_to_city']	= $this->input->post('bill_to_city');
			$data['bill_to_state']	= $this->input->post('bill_to_state');
			$data['bill_to_zip']	= $this->input->post('bill_to_zip');
			$data['ship_to_name']	= $this->input->post('ship_to_name');
			$data['ship_to_street']	= $this->input->post('ship_to_street');
			$data['ship_to_city']	= $this->input->post('ship_to_city');
			$data['ship_to_state']	= $this->input->post('ship_to_state');
			$data['ship_to_zip']	= $this->input->post('ship_to_zip');
			$this->db->where('patient_id', $param2);
			$this->db->update('patient', $data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/patient_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?customer/patient', 'refresh');
		}
		if ($param1 == 'delete') {
			if (file_exists("uploads/patient_image/" . $param2 . ".jpg")) {
				unlink("uploads/patient_image/" . $param2 . ".jpg");
			}
			$this->db->where('patient_id', $param2);
			$this->db->delete('patient');
			$this->session->set_flashdata('flash_message', 'Patient deleted');
			redirect(base_url() . 'index.php?customer/patient', 'refresh');
		}
		$page_data['page_name']  = 'patient';
		$page_data['page_title'] = 'Patients';
		$page_data['patients']  = $this->db->get('patient')->result_array();
		$this->load->view('index', $page_data);
	}




/* End of file customer.php */
/* Location: ./application/controllers/customer.php */
