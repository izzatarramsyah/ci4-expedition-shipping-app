<?php

namespace App\Models;

use CodeIgniter\Model;

class ShipmentsDetailModel extends Model
{
    protected $table      = 'tbl_shipments_detail';
    protected $allowedFields = [
        'shipment_id',
        'item_name',
        'item_type',
        'quantity',
        'weight'
    ];

    public function saveShipmentsDetail($param) {
        $builder = $this->db->table('tbl_shipments_detail');
        return $builder->insert($param);
    }

    public function getShipmentsDetailById($id){
        $builder = $this->db->table('tbl_shipments_detail');
        $builder->select('shipment_id, item_name, item_type, quantity, weight');
        $builder->where(['tbl_shipments_detail.shipment_id' => $id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getShipmentsDetailByDateRange($startDate, $endDate){
        $builder = $this->db->table('tbl_shipments_detail');
        $builder->select('shipment_id, item_name, item_type, quantity, weight');
        $builder->where('DATE(tbl_shipments_detail.created_dtm) BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
        $query = $builder->get();
        return $query->getResult();
    }

}