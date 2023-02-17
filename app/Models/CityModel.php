<?php 
namespace App\Models;
use CodeIgniter\Model;
class CityModel extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'id';
    protected $countBusiness = 0;
    
    protected $allowedFields = ['name', 'name_short', 'region'];
}