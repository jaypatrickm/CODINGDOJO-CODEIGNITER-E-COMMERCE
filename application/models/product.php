<?php
class product extends CI_Model
{
	function get_all_products()
	{
		return $this->db->query("SELECT * FROM products")->result_array();
	}
	function add_user($post)
	{
		$query = "INSERT INTO users (first_name, last_name, address, card, created_at, updated_at 
				   VALUES (?, ?, ?, ?, NOW(), NOW())";
		$values = array($this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('address'), $this->input->post('card'));
		return $this->db->query($query, $values);
	}
	// function get_product_by_id($product_id)
	// {
	// 	return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id)->row_array();
	// }
	// function add_course($course)
	// {
	// 	$query - "INSERT INTO Courses (title, description, created_at) VALUES (?,?,?)";
	// 	$values = array($course['title'], $course['description']. date("Y-m-d, H:i:s"));
	// 	return $this->db->query($query, $values);
	// }
}
?>