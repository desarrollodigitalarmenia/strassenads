<?php 
namespace App\Models;
use CodeIgniter\Model;
class AdsModel extends Model
{
    protected $table = 'ads';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name_short', 'business', 'position'];
}