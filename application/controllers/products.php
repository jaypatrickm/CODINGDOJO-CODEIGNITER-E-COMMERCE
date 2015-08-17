<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$result = $this->product->get_all_products();
		$products = array('products' => $result);
		$this->load->view('products/listing', $products);
	}

	public function cart()
	{
		if($this->session->userdata('cart'))
		{
			$cart_items = $this->session->userdata('cart');
			//Must Do Math HERE!
			foreach ($cart_items as $product => $value) {
				//take QTY multiply times price
				$itemPrice = intval($value['qty']) *  floatval($value['price']); //make sure for numbers
				$itemPrice = round($itemPrice, 2); //round to spots 
				$cart_items[$product] = array(
					'id' => $value['id'],
					'qty' => intval($value['qty']),
					'price' => floatval($value['price']),
					'description' => $value['description'],
					'price_qty' => $itemPrice
					);
			}
			$this->session->set_userdata('cart', $cart_items);
			$cart = array('cart' => $cart_items);
			$this->load->view('products/checkout', $cart);
		} 
		else 
		{
			$this->load->view('products/cart-empty');
		}
	}

	public function add_to_cart($id)
	{
		if ($this->session->userdata('cart'))
		{
			$cart = $this->session->userdata('cart');
			$updated = false;
			$qty = intval($this->input->post('qty'));
			$price = floatval($this->input->post('price'));
			$product_id = intval($id);
			foreach ($cart as $product => $value) {
				if($value['id'] == $product_id)
				{
					$updated = true;
					//echo $value['qty'];
					$value['qty'] = intval($value['qty']) + $qty;
					//echo $value['qty'];
					$cart[$product] = array(
						'id' => $product_id,
						'qty' => intval($value['qty']),
						'price' => $price,
						'description' => $this->input->post('description'));
				}
			}
			if(!$updated)
			{
				$cart[] = array(
					'id'	=>	$product_id,
					'qty'	=>	$qty,
					'price'	=> $price,
					'description'	=>	$this->input->post('description')
					); 
			}
			$this->session->set_userdata('cart', $cart);
		}
		else 
		{
			$qty = intval($this->input->post('qty'));
			$price = floatval($this->input->post('price'));
			$add_product = array(
				'id'	=>	intval($id),
				'qty'	=>	$qty,
				'price'	=> $price,
				'description'	=>	$this->input->post('description')
				); 
			$cart[] = $add_product;
			$this->session->set_userdata('cart', $cart);
		}
		redirect('/products');
	}
	public function destroy()
	{
		$this->session->sess_destroy();
		redirect('/products');
	}
	public function cart_empty()
	{
		$this->load->view('products/cart-empty');
	}
	public function delete($id)
	{
		$cart = $this->session->userdata('cart');
		$product_id = intval($id);
		//echo 'this is product id ' . $product_id . "<br>";
		foreach ($cart as $product => $value) {
			if(intval($value['id']) == $product_id)
			{
				//echo 'TRUE : value=' . $value['id'] . ' pid= ' . $product_id  . "<br>";
				if($value['qty'] == 1 && $value['id'] == $product_id)
				{
					unset($cart[$product]);
				}
				else
				{
					//echo 'subtract 1';
					$updated = true;
					//echo $value['qty'];
					$value['qty'] = intval($value['qty']) - 1;
					//echo $value['qty'];
					$cart[$product] = array(
						'id' => $product_id,
						'qty' => $value['qty'],
						'price' => $value['price'],
						'description' => $value['description']
					);
				}
			}
			else 
			{
				//echo 'NOT TRUE: value= ' .  $value['id'] . ' pid= ' . $product_id . "<br>";
				$cart[$product] = array(
					'id' => $value['id'],
					'qty' => $value['qty'],
					'price' => $value['price'],
					'description' => $value['description']
				);
			}
		}
		$this->session->set_userdata('cart',$cart);
		redirect('/products/cart');
	}
	public function checkout()
	{
		if($_POST){
			$this->load->helper(array('form', 'url'));
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required',
												array('required' => 'Please type in a first name.')
			);
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required',
												array('required' => 'Please type in a last name.')
			);
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('card', 'Card', 'trim|required|numeric');
			if($this->form_validation->run() == FALSE)
			{
				$cart_items = $this->session->userdata('cart');
				$cart = array('cart' => $cart_items);
				$this->load->view('products/checkout', $cart);
			}
			else
			{
				//$this->product->checkout($this->input->post());
				//$add_user = $this->product->add_user($this->input->post());
				// if ($add_user){
				// 	$this->product->
				// }
				$cart_items = $this->session->userdata('cart');
				$cart = array('cart' => $cart_items);
				$this->load->view('products/checkout', $cart);
			}

		}
		else
		{
			$cart_items = $this->session->userdata('cart');
			$cart = array('cart' => $cart_items);
			$this->load->view('products/checkout', $cart);
		}
	
	}
}

//end of main controller