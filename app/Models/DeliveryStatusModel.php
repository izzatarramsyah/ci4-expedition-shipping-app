<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryStatusModel extends Model
{
    protected $table      = 'tbl_delivery_status';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'shipment_id',
        'delivery_date',
        'status',
        'remarks'
    ];

    public function saveDeliveryStatus($param) {
        $builder = $this->db->table('tbl_delivery_status');
        $builder->insert($param);
        return $this->db->insertID();
    }

    public function getDeliveryStatusById($id){
        $builder = $this->db->table('tbl_delivery_status');
        $builder->select('id, shipment_id, delivery_date, status, remarks');
        $builder->where(['tbl_delivery_status.shipment_id' => $id]);
        $builder->orderBy('tbl_delivery_status.delivery_date', 'desc');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDeliveryStatus($delivArea, $startDate, $endDate){
        $db = \Config\Database::connect(); 
        $sql = "select t1.*
        from tbl_delivery_status t1 join 
            ( select shipment_id, delivery_date, status, remarks
             from tbl_delivery_status order by delivery_date desc limit 1) t2
        on t1.shipment_id  = t2.shipment_id
        AND t1.delivery_date = t2.delivery_date";
        $query = $db->query($sql, ['value']);
        return $query->getResult();
    }

    public function getDeliveryStatusData(){
        $db = \Config\Database::connect(); 
        $sql = "select MONTHNAME(t1.delivery_date) as month, 
                case 
                    when t1.status = 'Package Received' then 'Success'
                    when t1.status = 'Waiting For Proccess' or status = 'Shipped' or status = 'Delayed' then 'On Progress'
                    when t1.status = 'Out Of Delivery' or status = 'Returned' then 'Failed'
                end as status,
                count(*) as count
            from (select t1.*
                    from tbl_delivery_status t1 join 
                        ( select shipment_id, delivery_date, status, remarks
                        from tbl_delivery_status order by delivery_date desc limit 1) t2
                    on t1.shipment_id  = t2.shipment_id
                    AND t1.delivery_date = t2.delivery_date) t1
            group by MONTHNAME(t1.delivery_date), t1.status";
        $query = $db->query($sql, ['value']);
        return $query->getResult();
    }

}