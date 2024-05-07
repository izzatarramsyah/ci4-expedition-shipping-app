<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tbl_users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $allowedFields = [
        'username',
        'password',
        'status',
        'join_date'
    ];

}