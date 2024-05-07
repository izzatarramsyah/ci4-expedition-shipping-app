<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'tbl_employee';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id',
        'name',
        'position',
        'email',
        'status'
    ];

}