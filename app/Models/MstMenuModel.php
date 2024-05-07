<?php

namespace App\Models;

use CodeIgniter\Model;

class MstMenuModel extends Model
{
    protected $table      = 'tbl_mst_menu';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'detail'
    ];

}