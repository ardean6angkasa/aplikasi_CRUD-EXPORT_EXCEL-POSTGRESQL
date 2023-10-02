<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_login';

    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'password', 'candidate_name', 'candidate_position', 'image'];
}
