<?php 
namespace App\Models;
use CodeIgniter\Model;
class BusinessModel extends Model
{
    protected $table = 'business';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name', 
        'email', 
        'image', 
        'country', 
        'state', 
        'city', 
        'category', 
        'schedule'];
}