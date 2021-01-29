<?php

class Item_model extends CI_Model{
    protected $table = 'Barang';

    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        return $this->db->get($this->table)->result_array();
    }
    public function getOne($id){
        return $this->db->get_where($this->table, ['id' => $id])->result_array();
    }
    public function insertItem($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }
    public function updateItem($data, $id){
        $this->db->update($this->table, $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function deleteItem($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

}