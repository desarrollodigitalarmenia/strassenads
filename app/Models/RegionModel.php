<?php 
namespace App\Models;
use CodeIgniter\Model;
class RegionModel extends Model
{
    protected $table = 'region';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'name_short', 'country', 'flag'];
}