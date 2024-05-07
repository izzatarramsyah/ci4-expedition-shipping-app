<?php

namespace App\Models;

use CodeIgniter\Model;

class MstWeightRateModel extends Model
{
    protected $table      = 'tbl_mst_weight_rate';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'min_weight',
        'max_weight',
        'price'
    ];

    public function saveWeight($param) {
        $builder = $this->db->table('tbl_mst_weight_rate');
        return $builder->insert($param);
    }

    public function deleteWeight($id) {
        $builder = $this->db->table('tbl_mst_weight_rate');
        $builder->where('id', $id);
        return  $builder->delete();
    }

    public function getListWeight(){
        $builder = $this->db->table('tbl_mst_weight_rate');
        $builder->select('id, min_weight, max_weight, price');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getWeight($id){
        $builder = $this->db->table('tbl_mst_weight_rate');
        $builder->select('id, min_weight, max_weight, price');
        $builder->where(['tbl_mst_weight_rate.id' => $id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function updateWeight($param) {
        $builder = $this->db->table('tbl_mst_weight_rate');
        $builder->set('min_weight', $param['min_weight']);
        $builder->set('max_weight', $param['max_weight']);
        $builder->set('price', $param['price']);
        $builder->where('id', $param['id']);
        return  $builder->update();
    }

}