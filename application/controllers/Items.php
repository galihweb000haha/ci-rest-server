<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Items extends REST_Controller {
    
    function __construct()
    {        
        parent::__construct();
        $this->load->model('Item_model', 'i');
    }
    function index_get() {        
        $id = $this->get('id');        

        if ($id == '') {
            $items = $this->i->getAll();
        } else {
            $items = $this->i->getOne($id);
            if ($items) {
                $this->response($items, 200);
            } else {
                $this->response( [
                    'status' => false,
                    'message' => 'No items were found'
                ], 404 );
            }
        }
        $this->response($items, 200);
    }
    public function index_post(){
        $data = [
            'nama' => $this->post('nama'),
            'kategori' => $this->post('kategori'),
            'brand' => $this->post('brand'),
            'harga' => $this->post('harga'),
            'gambar' => $this->post('gambar'),
            'deskripsi' => $this->post('deskripsi')
        ];        

        $insert = $this->i->insertItem($data);

        if ($insert) {
            return $this->response($data, 200);
        } else {
            return $this->response(array('status' => 'fail', 502));
        } 

    }
    public function index_put(){
        $id = $this->put('id');        

        $data = [
            'nama' => $this->put('nama'),
            'kategori' => $this->put('kategori'),
            'brand' => $this->put('brand'),
            'harga' => $this->put('harga'),
            'gambar' => $this->put('gambar'),
            'deskripsi' => $this->put('deskripsi')
        ];  

        $update = $this->i->updateItem($data, $id);

        if ($update) {
            return $this->response($data, 200);
        } else {
            return $this->response(array('status' => 'fail', 502));
        } 
    }
    public function index_delete(){
        $id = $this->delete('id');
        $delete = $this->i->deleteItem($id);
        if ($delete) {
            return $this->response(array('status' => 'success'), 201);
        } else {
            return $this->response(array('status' => 'fail', 502));
        } 
    }
}