<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
	/*	
	   *	Developed by: Syncrypts
       *	Date	: 21 January, 2015
       *	Invenire Stock Inventory Manager
       *	http://codecanyon.net/user/syncrypts
    */

class Admin extends CI_Controller
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

	// DECLARATION: ADMIN DASHBOARD
	function dashboard()
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = 'Dashboard';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE CUSTOMER
	function customer($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['customer_code'] = $this->input->post('customer_code');
			$data['name']          = $this->input->post('name');
			$data['email']         = $this->input->post('email');
			$data['password']      = sha1($this->input->post('password'));
			$data['phone']         = $this->input->post('phone');
			$data['address']       = $this->input->post('address');
			$data['gender']        = $this->input->post('gender');
			$data['age']           = $this->input->post('age');
			$this->db->insert('customer', $data);
			// UPLOAD IMAGE FILE
			$customer_id       = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $customer_id . '.jpg');
			// MAIL SENDING TO CUSTOMER
			$password_unhashed = $this->input->post('password');
			$email_to          = $data['email'];
			$this->session->set_flashdata('flash_message', 'New customer added successfully');
			$this->email_model->account_opening_email('customer', $email_to, $password_unhashed);
			redirect(base_url() . 'index.php?manufacture/customer', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['name']    = $this->input->post('name');
			$data['email']   = $this->input->post('email');
			$data['phone']   = $this->input->post('phone');
			$data['address'] = $this->input->post('address');
			$data['gender']  = $this->input->post('gender');
			$data['age']     = $this->input->post('age');
			$this->db->where('customer_id', $param2);
			$this->db->update('customer', $data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/customer', 'refresh');
		}
		if ($param1 == 'delete') {
			if (file_exists("uploads/customer_image/" . $param2 . ".jpg")) {
				unlink("uploads/customer_image/" . $param2 . ".jpg");
			}
			$this->db->where('customer_id', $param2);
			$this->db->delete('customer');
			$this->session->set_flashdata('flash_message', 'Customer deleted');
			redirect(base_url() . 'index.php?manufacture/customer', 'refresh');
		}
		$page_data['page_name']  = 'customer';
		$page_data['page_title'] = 'Customers';
		$page_data['customers']  = $this->db->get('customer')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE SUPPLIER
	function supplier($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['name']    = $this->input->post('name');
			$data['company'] = $this->input->post('company');
			$data['email']   = $this->input->post('email');
			$data['phone']   = $this->input->post('phone');
			$this->db->insert('supplier', $data);
			// UPLOAD IMAGE FILE
			$supplier_id = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $supplier_id . '.jpg');
			$this->session->set_flashdata('flash_message', 'New supplier added successfully');
			redirect(base_url() . 'index.php?manufacture/supplier', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['name']    = $this->input->post('name');
			$data['company'] = $this->input->post('company');
			$data['email']   = $this->input->post('email');
			$data['phone']   = $this->input->post('phone');
			$this->db->where('supplier_id', $param2);
			$this->db->update('supplier', $data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/supplier', 'refresh');
		}
		if ($param1 == 'delete') {
			if (file_exists("uploads/supplier_image/" . $param2 . ".jpg")) {
				unlink("uploads/supplier_image/ " . $param2 . ".jpg");
			}
			$this->db->where('supplier_id', $param2);
			$this->db->delete('supplier');
			$this->session->set_flashdata('flash_message', 'Supplier deleted');
			redirect(base_url() . 'index.php?manufacture/supplier', 'refresh');
		}
		$page_data['page_name']  = 'supplier';
		$page_data['page_title'] = 'Suppliers';
		$page_data['suppliers']  = $this->db->get('supplier')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE PRODUCT CATEGORY
	function product_category($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->insert('category', $data);
			// UPLOAD IMAGE FILE
			$product_category_id = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_category_image/' . $product_category_id . '.jpg');
			$this->session->set_flashdata('flash_message', 'New product category added successfully');
			redirect(base_url() . 'index.php?manufacture/product_category', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->where('category_id', $param2);
			$this->db->update('category', $data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_category_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/product_category', 'refresh');
		}
		if ($param1 == 'delete') {			
			if (file_exists("uploads/product_category_image/" . $param2 . ".jpg")) {
				unlink("uploads/product_category_image/" . $param2 . ".jpg");
			}
			$this->db->where('category_id', $param2);
			$this->db->delete('category');
			$this->session->set_flashdata('flash_message', 'Product category deleted');
			redirect(base_url() . 'index.php?manufacture/product_category', 'refresh');
		}
		$page_data['page_name']  = 'product_category';
		$page_data['page_title'] = 'Product Categories';
		$page_data['categories'] = $this->db->get('category')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE PRODUCT SUB CATEGORY
	function product_sub_category($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$data['category_id'] = $this->input->post('category_id');
			$this->db->insert('sub_category', $data);
			// UPLOAD IMAGE FILE
			$product_sub_category_id = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_sub_category_image/' . $product_sub_category_id . '.jpg');
			$this->session->set_flashdata('flash_message', 'New product sub-category added successfully');
			redirect(base_url() . 'index.php?manufacture/product_sub_category', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$data['category_id'] = $this->input->post('category_id');
			$this->db->where('sub_category_id', $param2);
			$this->db->update('sub_category', $data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_sub_category_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/product_sub_category', 'refresh');
		}
		if ($param1 == 'delete') {
			if (file_exists("uploads/product_sub_category_image/" . $param2 . ".jpg")) {
				unlink("uploads/product_sub_category_image/" . $param2 . ".jpg");
			}
			$this->db->where('sub_category_id', $param2);
			$this->db->delete('sub_category');
			$this->session->set_flashdata('flash_message', 'Product sub-category deleted');
			redirect(base_url() . 'index.php?manufacture/product_sub_category', 'refresh');
		}
		$page_data['page_name']      = 'product_sub_category';
		$page_data['page_title']     = 'Product Sub-categories';
		$page_data['sub_categories'] = $this->db->get('sub_category')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE PRODUCTS
	function product($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['serial_number']   = $this->input->post('serial_number');
			$data['category_id']     = $this->input->post('category_id');
			$data['sub_category_id'] = $this->input->post('sub_category_id');
			$data['name']            = $this->input->post('name');
			$data['purchase_price']  = $this->input->post('purchase_price');
			$data['selling_price']   = $this->input->post('selling_price');
			$data['note']            = $this->input->post('note');
			$this->db->insert('product', $data);
			// UPLOAD IMAGE FILE
			$product_id = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $product_id . '.jpg');
			$this->session->set_flashdata('flash_message', 'New product added successfully');
			redirect(base_url() . 'index.php?manufacture/product', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['serial_number']   = $this->input->post('serial_number');
			$data['category_id']     = $this->input->post('category_id');
			$data['sub_category_id'] = $this->input->post('sub_category_id');
			$data['name']            = $this->input->post('name');
			$data['purchase_price']  = $this->input->post('purchase_price');
			$data['selling_price']   = $this->input->post('selling_price');
			$data['note']            = $this->input->post('note');
			$this->db->where('product_id', $param2);
			$this->db->update('product', $data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/product', 'refresh');
		}
		if ($param1 == 'delete') {
			if (file_exists("uploads/product_image/" . $param2 . ".jpg")) {
				unlink("uploads/product_image/" . $param2 . ".jpg");
			}
			$this->db->where('product_id', $param2);
			$this->db->delete('product');
			$this->session->set_flashdata('flash_message', 'Product deleted');
			redirect(base_url() . 'index.php?manufacture/product', 'refresh');
		}
		$page_data['page_name']  = 'product';
		$page_data['page_title'] = 'Products';
		$page_data['products']   = $this->db->get('product')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: CREATE PRODUCT BARCODE
	function product_barcode($param1 = '', $serial_number = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create_barcode') {
			$this->barcode_model->create_barcode($serial_number);
		}
		$page_data['page_name']  = 'product_barcode';
		$page_data['page_title'] = 'Product Barcodes';
		$page_data['products']   = $this->db->get('product')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE DAMAGED PRODUCTS
	function damaged_product($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['product_id'] = $this->input->post('product_id');
			$data['quantity']   = $this->input->post('quantity');
			$data['note']       = $this->input->post('note');
			$data['timestamp']  = strtotime($this->input->post('timestamp'));
			$this->db->insert('damaged_product', $data);
			$this->session->set_flashdata('flash_message', 'Damaged product added');
			redirect(base_url() . 'index.php?manufacture/damaged_product', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['product_id'] = $this->input->post('product_id');
			$data['quantity']   = $this->input->post('quantity');
			$data['note']       = $this->input->post('note');
			$data['timestamp']  = strtotime($this->input->post('timestamp'));
			$this->db->where('damaged_product_id', $param2);
			$this->db->update('damaged_product', $data);
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/damaged_product', 'refresh');
		}
		if ($param1 == 'delete') {
			$this->db->where('damaged_product_id', $param2);
			$this->db->delete('damaged_product');
			$this->session->set_flashdata('flash_message', 'Damaged product deleted');
			redirect(base_url() . 'index.php?manufacture/damaged_product', 'refresh');
		}
		$page_data['page_name']        = 'damaged_product';
		$page_data['page_title']       = 'Damaged Products';
		$page_data['damaged_products'] = $this->db->get('damaged_product')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE ORDERS
	function order($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['order_number']     = $this->input->post('order_number');
			$data['customer_id']      = $this->input->post('customer_id');
			$data['product_id']       = $this->input->post('product_id');
			$data['quantity']         = $this->input->post('quantity');
			$data['shipping_address'] = $this->input->post('shipping_address');
			$data['order_status']     = $this->input->post('order_status');
			$data['payment_status']   = $this->input->post('payment_status');
			$data['note']             = $this->input->post('note');
			$data['timestamp']        = strtotime($this->input->post('timestamp'));
			$status                   = $this->input->post('order_status');
			$this->db->insert('order', $data);
			// MAIL SENDING TO CUSTOMER
			$order_number     = $data['order_number'];
			$email_to         = $this->db->get_where('customer', array(
				'customer_id' => $data['customer_id']
			))->row()->email;
			$product_ordered  = $this->db->get_where('product', array(
				'product_id' => $data['product_id']
			))->row()->name;
			$product_quantity = $data['quantity'];
			if ($status == 0) {
				$this->session->set_flashdata('flash_message', 'Order added to pending');
				$this->email_model->order_creating_email_by_manufacture('Pending', $order_number, $product_ordered, $product_quantity, $email_to);
				redirect(base_url() . 'index.php?manufacture/pending_order', 'refresh');
			} elseif ($status == 1) {
				$this->session->set_flashdata('flash_message', 'Order added to approved');
				$this->email_model->order_creating_email_by_manufacture('Approved', $order_number, $product_ordered, $product_quantity, $email_to);
				redirect(base_url() . 'index.php?manufacture/approved_order', 'refresh');
			} else {
				$this->session->set_flashdata('flash_message', 'Order added to rejected');
				$this->email_model->order_creating_email_by_manufacture('Rejected', $order_number, $product_ordered, $product_quantity, $email_to);
				redirect(base_url() . 'index.php?manufacture/rejected_order', 'refresh');
			}
		}
		if ($param1 == 'edit') {
			$data['order_number']     = $this->input->post('order_number');
			$data['customer_id']      = $this->input->post('customer_id');
			$data['product_id']       = $this->input->post('product_id');
			$data['quantity']         = $this->input->post('quantity');
			$data['shipping_address'] = $this->input->post('shipping_address');
			$data['order_status']     = $this->input->post('order_status');
			$data['payment_status']   = $this->input->post('payment_status');
			$data['note']             = $this->input->post('note');
			$data['timestamp']        = strtotime($this->input->post('timestamp'));
			$notify_customer          = $this->input->post('notify');
			$status                   = $this->input->post('order_status');
			$this->db->where('order_id', $param2);
			$this->db->update('order', $data);
			// MAIL SENDING TO CUSTOMER
			$order_number = $data['order_number'];
			$email_to     = $this->db->get_where('customer', array(
				'customer_id' => $data['customer_id']
			))->row()->email;
			if ($status == 0) {
				$this->session->set_flashdata('flash_message', 'Informations updated');
				if ($notify_customer != '') {
					$this->email_model->order_status_change_email('Pending', $order_number, $email_to);
				}
				redirect(base_url() . 'index.php?manufacture/pending_order', 'refresh');
			} elseif ($status == 1) {
				$this->session->set_flashdata('flash_message', 'Informations updated');
				if ($notify_customer != '') {
					$this->email_model->order_status_change_email('Approved', $order_number, $email_to);
				}
				redirect(base_url() . 'index.php?manufacture/approved_order', 'refresh');
			} else {
				$this->session->set_flashdata('flash_message', 'Informations updated');
				if ($notify_customer != '') {
					$this->email_model->order_status_change_email('Rejected', $order_number, $email_to);
				}
				redirect(base_url() . 'index.php?manufacture/rejected_order', 'refresh');
			}
		}
		if ($param1 == 'delete') {
			$status = $this->db->get_where('order', array(
				'order_id' => $param2
			))->row()->order_status;
			$this->db->where('order_id', $param2);
			$this->db->delete('order');
			if ($status == 0) {
				$this->session->set_flashdata('flash_message', 'Order deleted');
				redirect(base_url() . 'index.php?manufacture/pending_order', 'refresh');
			} elseif ($status == 1) {
				$this->session->set_flashdata('flash_message', 'Order deleted');
				redirect(base_url() . 'index.php?manufacture/approved_order', 'refresh');
			} else {
				$this->session->set_flashdata('flash_message', 'Order deleted');
				redirect(base_url() . 'index.php?manufacture/rejected_order', 'refresh');
			}
		}
	}

	// DECLARATION: NEW ORDER
	function order_add()
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'order_add';
		$page_data['page_title'] = 'Create New Order';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE PENDING ORDERS
	function pending_order()
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']      = 'pending_order';
		$page_data['page_title']     = 'Pending Orders';
		$page_data['pending_orders'] = $this->db->get_where('order', array(
			'order_status' => 0
		))->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE APPROVED ORDERS
	function approved_order()
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']       = 'approved_order';
		$page_data['page_title']      = 'Approved Orders';
		$page_data['approved_orders'] = $this->db->get_where('order', array(
			'order_status' => 1
		))->result_array();
		$this->load->view('index', $page_data);
	}

	// REJECTED ORDERS
	function rejected_order()
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']       = 'rejected_order';
		$page_data['page_title']      = 'Rejected Orders';
		$page_data['rejected_orders'] = $this->db->get_where('order', array(
			'order_status' => 2
		))->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: NEW PURCHASE
	function purchase_add($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$this->crud_model->new_purchase();
			redirect(base_url() . 'index.php?manufacture/purchase_add');
		}
		$page_data['page_name']  = 'purchase_add';
		$page_data['page_title'] = 'New Purchase';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: PURCHASE HISTORY 
	function purchase_history()
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['purchases']  = $this->db->get('purchase')->result_array();
		$page_data['page_name']  = 'purchase_history';
		$page_data['page_title'] = 'Purchase History';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SALE PRODUCTS
	function sale_add($param1 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'do_add') {
			$invoice_id = $this->crud_model->add_new_sale();
			$this->session->set_flashdata('flash_message', 'New sale added successfully');
			redirect(base_url() . 'index.php?manufacture/sale_invoice_view/' . $invoice_id);
		}
		$page_data['page_name']  = 'sale_add';
		$page_data['page_title'] = 'Create a new sale';
		$this->load->view('index', $page_data);
	}
	// DECLARATION: VIEW SALE INVOICE 
	function sale_invoice_view($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['invoice_id'] = $param1;
		$page_data['page_name']  = 'sale_invoice_view';
		$page_data['page_title'] = 'Sale Invoice';
		$this->load->view('index', $page_data);
	}
	// DECLARATION: SALE INVOICES
	function sale_invoice($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']  = 'sale_invoice';
		$page_data['page_title'] = 'Sale invoices';
		$this->db->order_by('invoice_id', 'desc');
		$page_data['invoices'] = $this->db->get('invoice')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: GET THE PRODUCT LIST 
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

	// DECLARATION: GET THE SUB CATEGORY LIST OF PRODUCTS
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

	// DECLARATION: MANAGE REPORTS
	function report($report_type = 'payment')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($this->input->post('start') != "") {
			$page_data['timestamp_start'] = strtotime($this->input->post('start'));
			$page_data['timestamp_end']   = strtotime($this->input->post('end'));
		} else {
			$page_data['timestamp_start'] = strtotime('-29 days', time());
			$page_data['timestamp_end']   = strtotime(date("m/d/Y"));
		}
		$page_data['report_type'] = $report_type;
		$page_data['page_name']   = 'report_' . $report_type;
		$page_data['page_title']  = 'Report of ' . $report_type;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: MANAGE EMPLOYEES
	function employee($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = sha1($this->input->post('password'));
			$data['type']     = $this->input->post('type');
			$this->db->insert('employee', $data);
			// UPLOAD IMAGE FILE
			$employee_id       = mysql_insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $employee_id . '.jpg');
			// MAIL SENDING TO EMPLOYEE
			$email_to          = $data['email'];
			$password_unhashed = $this->input->post('password');
			$this->email_model->account_opening_email('employee', $email_to, $password_unhashed);
			$this->session->set_flashdata('flash_message', 'New employee added successfully');
			redirect(base_url() . 'index.php?manufacture/employee', 'refresh');
		}
		if ($param1 == 'edit') {
			$data['name']  = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['type']  = $this->input->post('type');
			$this->db->where('employee_id', $param2);
			$this->db->update('employee', $data);
			// UPLOAD IMAGE FILE
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $param2 . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/employee', 'refresh');
		}
		if ($param1 == 'delete') {
			if (file_exists("uploads/employee_image/" . $param2 . ".jpg")) {
				unlink("uploads/employee_image/" . $param2 . ".jpg");
			}
			$this->db->where('employee_id', $param2);
			$this->db->delete('employee');
			$this->session->set_flashdata('flash_message', 'Order deleted');
			redirect(base_url() . 'index.php?manufacture/employee', 'refresh');
		}
		$page_data['page_name']  = 'employee';
		$page_data['page_title'] = 'Employees';
		$page_data['employees']  = $this->db->get('employee')->result_array();
		$this->load->view('index', $page_data);
	}

	// DECLARATION: PRIVATE MESSAGING
	function message($messgae_thread_code = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']           = 'message';
		$page_data['page_title']          = 'Private Messaging';
		$page_data['message_thread_code'] = $messgae_thread_code;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SEND NEW MESSAGE
	function message_new($param1 = '', $param2 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'send_new_message') {
			$new_message_thread_code = $this->crud_model->send_new_message();
			$this->session->set_flashdata('flash_message', 'Message Sent');
			$get_receiver       = $this->db->get_where('message_thread', array(
				'message_thread_code' => $new_message_thread_code
			))->row()->receiver;
			$receiver           = explode('-', $get_receiver);
			$user_to_email_type = $receiver[0];
			$user_to_email_id   = $receiver[1];
			$email_to           = $this->db->get_where($user_to_email_type, array(
				$user_to_email_type . '_id' => $user_to_email_id
			))->row()->email;
			// MAIL SENDING TO RECEIVER
			$this->email_model->message_notification_email_sender_manufacture($email_to);
			redirect(base_url() . 'index.php?manufacture/message_read/' . $new_message_thread_code, 'refresh');
		}
		$page_data['page_name']			= 'message_new';
		$page_data['page_title']    	= 'Messaging';
		$page_data['customers']     	= $this->db->get('customer')->result_array();
		$page_data['sales_staff']   	= $this->db->get_where('employee', array(
			'type' => 1
		))->result_array();
		$page_data['purchase_staff']    = $this->db->get_where('employee', array(
			'type' => 2
		))->result_array();
		$page_data['message_thread_code'] = $param2;
		$this->load->view('index', $page_data);
	}

	// DECLARATION: READ MESSAGES
	function message_read($message_thread_code)
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		$page_data['page_name']           = 'message_read';
		$page_data['page_title']          = 'Read messages';
		$page_data['message_thread_code'] = $message_thread_code;
		$this->load->view('index', $page_data);
	}

	//DECLARATION: REPLY A MESSAGE
	function message_reply($message_thread_code)
	{
		$this->crud_model->send_reply_message($message_thread_code);
		$this->session->set_flashdata('flash_message', 'Message sent');
		$get_receiver       = $this->db->get_where('message_thread', array(
			'message_thread_code' => $message_thread_code
		))->row()->receiver;
		$receiver           = explode('-', $get_receiver);
		$user_to_email_type = $receiver[0];
		$user_to_email_id   = $receiver[1];
		$email_to           = $this->db->get_where($user_to_email_type, array(
			$user_to_email_type . '_id' => $user_to_email_id
		))->row()->email;
		// MAIL SENDING TO RECEIVER
		$this->email_model->message_notification_email_sender_manufacture($email_to);
		redirect(base_url() . 'index.php?manufacture/message_read/' . $message_thread_code, 'refresh');
	}

	// DECLARATION: manufacture PROFILE SETTINGS
	function profile_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'update') {
			$data['name']  = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['about'] = $this->input->post('about');
			$this->db->where('manufacture_id', $this->session->userdata('user_id'));
			$this->db->update('manufacture', $data);
			// UPLOAD IMAGE FILE
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/manufacture_image/' . $this->session->userdata('user_id') . '.jpg');
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/profile_settings', 'refresh');
		}
		// PASSWORD UPDATE
		if ($param1 == 'change_password') {
			$data['previous_password'] = sha1($this->input->post('previous_password'));
			$data['new_password']      = sha1($this->input->post('new_password'));
			$data['confirm_password']  = sha1($this->input->post('confirm_password'));
			$existing_password         = $this->db->get_where('manufacture', array(
				'manufacture_id' => $this->session->userdata('user_id')
			))->row()->password;
			if ($existing_password == $data['previous_password'] && $data['new_password'] == $data['confirm_password']) {
				$this->db->where('manufacture_id', $this->session->userdata('user_id'));
				$this->db->update('manufacture', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', 'Password Change Successful');
			} else {
				$this->session->set_flashdata('flash_message', 'Password Mismatch');
			}
			redirect(base_url() . 'index.php?manufacture/profile_settings', 'refresh');
		}
		$page_data['page_name']  = 'profile_settings';
		$page_data['manufacture']      = $this->db->get_where('manufacture', array(
			'manufacture_id' => $this->session->userdata('user_id')
		))->result_array();
		$page_data['page_title'] = 'Profile';
		$this->load->view('index', $page_data);
	}

	// DECLARATION: SYSTEM SETTINGS
	function settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('manufacture_login') != 1)
			redirect(base_url() . 'index.php?login');
		if ($param1 == 'update') {
			$data['description'] = $this->input->post('company_name');
			$this->db->where('type', 'company_name');
			$this->db->update('settings', $data);
			$data['description'] = $this->input->post('address');
			$this->db->where('type', 'address');
			$this->db->update('settings', $data);
			$data['description'] = $this->input->post('phone');
			$this->db->where('type', 'phone');
			$this->db->update('settings', $data);
			$data['description'] = $this->input->post('company_email');
			$this->db->where('type', 'company_email');
			$this->db->update('settings', $data);
			$data['description'] = $this->input->post('currency');
			$this->db->where('type', 'currency');
			$this->db->update('settings', $data);
			$data['description'] = $this->input->post('vat_percentage');
			$this->db->where('type', 'vat_percentage');
			$this->db->update('settings', $data);
			$data['description'] = $this->input->post('discount_percentage');
			$this->db->where('type', 'discount_percentage');
			$this->db->update('settings', $data);
			$this->session->set_flashdata('flash_message', 'Informations updated');
			redirect(base_url() . 'index.php?manufacture/settings', 'refresh');
		}
		if ($param1 == 'upload_logo') {
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo/logo.png');
			$this->session->set_flashdata('flash_message', 'Logo uploaded');
			redirect(base_url() . 'index.php?manufacture/settings' , 'refresh');
		}
		$page_data['page_name']  = 'settings';
		$page_data['page_title'] = 'System Settings';
		$this->load->view('index', $page_data);
	}
}

/* End of file manufacture.php */
/* Location: ./application/controllers/manufacture.php */
