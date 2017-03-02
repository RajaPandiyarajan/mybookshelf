<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Book_Model extends CI_Model

{
	var $table = 'books';
	public function __construct()

	{
		parent::__construct();
		$this->load->database();
	}
	public function get_all_books()

	{		
		$this->db->select('a.*,b.rating_number, FORMAT((b.total_points / b.rating_number),1) as average_rating');
		$this->db->from('books a');
		$this->db->join('book_rating b', 'a.book_id = b.book_id', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_by_id($id)

	{
		$this->db->from($this->table);
		$this->db->where('book_id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function book_add($data)

	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function book_update($where, $data)

	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)

	{
		$this->db->where('book_id', $id);
		$this->db->delete($this->table);
		$this->db->where('book_id', $id);
		$this->db->delete('book_rating');
	}
	public function book_rating($book_id, $ratingPoints)

	{
		$ratingNum = 1;
		// Check the rating row with same book ID
		$this->db->from("book_rating");
		$this->db->where('book_id', $book_id);
		$ratingQuery = $this->db->get();
		$prevRatingRow = $ratingQuery->row();
		if ($prevRatingRow) {
			// Update rating data into the database
			$data = array(
				'rating_number' => $prevRatingRow->rating_number + $ratingNum,
				'total_points' => $prevRatingRow->total_points + $ratingPoints,
				'modified' => date("Y-m-d H:i:s")
			);
			$this->db->update("book_rating", $data, array(
				'book_id' => $book_id
			));
		}
		else {
			// Insert rating data into the database
			$data = array(
				'book_id' => $book_id,
				'rating_number' => $ratingNum,
				'total_points' => $ratingPoints,
				'created' => date("Y-m-d H:i:s") ,
				'modified' => date("Y-m-d H:i:s")
			);
			$this->db->insert("book_rating", $data);
		}
		$this->db->select('rating_number, FORMAT((total_points / rating_number),1) as average_rating');
		$this->db->from("book_rating");
		$this->db->where('book_id', $book_id);
		$this->db->where('status', 1);
		$updRatingQuery = $this->db->get();
		$ratingRow = $updRatingQuery->row();
		return $ratingRow;
	}
}