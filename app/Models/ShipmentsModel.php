<?php

namespace App\Models;

use CodeIgniter\Model;

class ShipmentsModel extends Model
{
    protected $table      = 'tbl_shipments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_id',
        'employee_id',
        'delivery_address',
        'receipment_name',
        'receipment_phone_no',
        'shipments_type'
    ];

    public function saveShipments($param) {
        $builder = $this->db->table('tbl_shipments');
        return $builder->insert($param);
    }

    public function getShipments(){
        $builder = $this->db->table('tbl_shipments');
        $builder->select('id, customer_id, delivery_address, receipment_name, receipment_phone_no');
        $query = $builder->get();
        return $query->getResult();
    }


    public function getShipmentsById($id){
        $builder = $this->db->table('tbl_shipments');
        $builder->select('id, customer_id, delivery_address, receipment_name, receipment_phone_no');
        $builder->where(['tbl_shipments.id' => $id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getShipmentsByDateRange($startDate, $endDate){
        $builder = $this->db->table('tbl_shipments');
        $builder->select('id, customer_id, delivery_address, receipment_name, receipment_phone_no');
        $builder->where('DATE(tbl_shipments.created_dtm) BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
        $query = $builder->get();
        return $query->getResult();
    }

}