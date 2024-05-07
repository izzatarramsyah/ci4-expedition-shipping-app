<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table      = 'tbl_customers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'name',
        'address',
        'phone'
    ];

    public function saveCustomer($param) {
        $builder = $this->db->table('tbl_customers');
        $builder->insert($param);
        return $this->db->insertID();
    }
    
    public function updateCustomer($param) {
        $builder = $this->db->table('tbl_customers');
        $builder->set('phone', $param['phone']);
        $builder->set('address', $param['address']);
        $builder->set('name', $param['name']);
        $builder->set('updated_dtm', $param['updated_dtm']);
        $builder->set('updated_by', $param['updated_by']);
        $builder->where('id', $param['id']);
        return  $builder->update();
    }

    public function updateCustomerStatus($id, $status) {
        $builder = $this->db->table('tbl_customers');
        $builder->set('status', $status);
        $builder->where('id', $id);
        return $builder->update();
    }

    public function getListCustomer(){
        $builder = $this->db->table('tbl_customers');
        $builder->select('id, name, address, phone, status');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getCustomerByName($name){
        $builder = $this->db->table('tbl_customers');
        $builder->select('id, name, address, phone, status');
        $builder->where(['tbl_customers.name' => $name]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getCustomerById($id){
        $builder = $this->db->table('tbl_customers');
        $builder->select('id, name, address, phone, status');
        $builder->where(['tbl_customers.id' => $id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function deleteCustomer($id) {
        $builder = $this->db->table('tbl_customers');
        $builder->where('id', $id);
        return  $builder->delete();
    }

}