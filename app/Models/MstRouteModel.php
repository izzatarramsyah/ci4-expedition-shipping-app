<?php

namespace App\Models;

use CodeIgniter\Model;

class MstRouteModel extends Model
{
    protected $table      = 'tbl_mst_route';
    protected $primaryKey = 'shipment_code';
    protected $allowedFields = [
        'destination',
        'duration',
        'price'
    ];

    public function saveRoute($param) {
        $builder = $this->db->table('tbl_mst_route');
        return $builder->insert($param);
    }

    public function updateRoute($param) {
        $builder = $this->db->table('tbl_mst_route');
        $builder->set('shipment_code', $param['shipment_code']);
        $builder->set('destination', $param['destination']);
        $builder->set('duration', $param['duration']);
        $builder->set('price', $param['price']);
        $builder->where('shipment_code', $param['shipment_code']);
        return  $builder->update();
    }

    public function deleteRoute($code) {
        $builder = $this->db->table('tbl_mst_route');
        $builder->where('shipment_code', $code);
        return  $builder->delete();
    }

    public function getListRoute(){
        $builder = $this->db->table('tbl_mst_route');
        $builder->select('shipment_code, destination, duration, price');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getRoute($shipmentCode){
        $builder = $this->db->table('tbl_mst_route');
        $builder->select('shipment_code, destination, duration, price');
        $builder->where(['tbl_mst_route.shipment_code' => $shipmentCode]);
        $query = $builder->get();
        return $query->getResult();
    }

}