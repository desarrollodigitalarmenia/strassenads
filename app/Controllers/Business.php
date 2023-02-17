<?php

namespace App\Controllers;
use App\Models\RegionModel;
use App\Models\CityModel;
use App\Models\CategoryModel;
use App\Models\BusinessModel;
use App\Models\AdsModel;

class Business extends BaseController
{

    public function index()
    {
        
    }

    public function searchEngine()
    {
        $session = session();

        $db = \Config\Database::connect();

        $region = 0;
        $country = 0;
        $city = 0;
        $category = 0;
        $q = "";

        $activeQty = 0;

        $q              = $this->request->getVar("q");
        $regionName     = $this->request->getVar("region");
        $cityName       = $this->request->getVar("city");
        $category       = $this->request->getVar("category");

        if($regionName != '')
            $activeQty++;
        
        if($cityName != '')
            $activeQty++;

        if($category != 0 && $category != '')
            $activeQty++;

        $breadcrumb = "<a class='active' href='./'>Principal</a> / ";

        $url = 'searchEngine?q='.$q;

        //Region
        $RegionModel = new RegionModel();
        $data['region'] = $RegionModel->where('name_short', $regionName)->first();

        if(!empty($regionName)){
            $region = $data['region']['id'];
            $session->set("region",$regionName);
            $url = $url.'&region='.$data['region']['name_short'];

            if($activeQty > 1){
                $breadcrumb .= "<a class='active' href='$url'>".$data['region']['name']."</a> / ";
                $activeQty--;
            }else{
                $breadcrumb .= "".$data['region']['name']."";
            }
        }

        //City
        $CityModel = new CityModel();
        $data['city'] = $CityModel->where('name_short', $cityName)->first();
        if(!empty($cityName)){
            $city = $data['city']['id'];
            $session->set("city",$cityName);
            $url = $url.'&city='.$cityName.'&category=0';
            if($activeQty > 1){
                $breadcrumb .= "<a class='active' href='$url'>".$data['city']['name']."</a> / ";
                $activeQty--;
            }else{
                $breadcrumb .= "".$data['city']['name']."";
            }
        }

        //Category
        $CategoryModel = new CategoryModel();
        $data['category'] = $CategoryModel->where('name_short', $category)->first();
        if(!empty($category)){
            $category = $data['category']['id'];
            $session->set("category",$data['category']['name_short']);
            $url = $url.'&category='.$data['category']['name_short'];
            if($activeQty > 1){
                $breadcrumb .= "<a class='active' href='$url'>".$data['category']['name']."</a> / ";
                $activeQty--;
            }else{
                $breadcrumb .= "".$data['category']['name']."";
            }
        }
        /*
        echo "region:".$session->get("region")."<br/>";
        echo "city:".$session->get("city")."<br/>";
        echo "category:".$session->get("category")."<br/>";
        die();
        */
        $session->set("breadcrumb",$breadcrumb);

        $data = $this->getBusinessList($region, $country, $city, $category, $q);

        //Category list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM (SELECT T1.category, count(*) as total
        FROM business T1 WHERE `region`=$region AND `city`=$city
        GROUP BY T1.category
        HAVING count(*) > 0 
        ORDER BY category desc) T2 JOIN `category` ON T2.category = category.id ORDER BY id ");

        $categoryList = $query->getResult();

        $data['categoryListByRegion'] = $categoryList;

        //City list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM 
        (SELECT T1.city, count(*) as total FROM 
        business T1 WHERE `region`=$region 
        GROUP BY T1.city HAVING count(*) > 0 
        ORDER BY city desc) T2 JOIN `city` ON T2.city = city.id ORDER BY id; ");

        $cityList = $query->getResult();

        $data['cityListByRegion'] = $cityList;

        $data['regionId'] = $regionName;

        echo view('frontend/header', $data);
        echo view('business_list', $data);
        echo view('frontend/footer');

    }

    public function getBusinessList($region, $country, $city, $category, $q)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('business');
        $builder->select(' *,
        business.id as id,
        business.name as name,
        business.name_short as business_nameshort,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_name_short,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_name_short,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_name_short
        ');

        if($country!=0){
            $builder->where('business.country', $country);
        }
        
        if($region!=0){
            $builder->where('business.region', $region);
        }
        
        if($city!=0){
            $builder->where('business.city', $city);
        }
        
        if($category!=0){
            $builder->where('business.category', $category);
        }
        
        if($q!=""){
            $builder->like('business.name', $q);
        }
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $RegionModel        = new RegionModel();
        $data['region_name']= $RegionModel->orderBy('position', 'ASC')->where('id', $region)->find();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->where('region', $region)->find();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $builder->join('category'   , 'category.id = business.category');
        $builder->join('region'     , 'region.id = business.region');
        $builder->join('city'       , 'city.id = business.city');
        $query = $builder->get();
        
        $data['business'] = $query->getResult();

        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        $data['region_name'] = array(0 => array('name' => ""));

        if($data['region_name'] != null){
            $data['region_name'] = $data['region_name'][0];
        }

        return $data;
    }

    public function getBusiness($shortname = null){

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $BusinessModel = new BusinessModel();

        $db      = \Config\Database::connect();
        $builder = $db->table('business');
        $builder->select(' *,
        business.id as id,
        business.name as name,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_name_short,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_name_short,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_name_short
        ');

        $builder->where('business.name_short', $shortname);
        $builder->join('category', 'category.id = business.category');
        $builder->join('region', 'region.id = business.region');
        $builder->join('city', 'city.id = business.city');
        $query = $builder->get();

        $data['business'] = $query->getResult();
        $data['business'] = $data['business'][0];

        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        if(empty($data['business'])){
            return redirect()->to('/');
        }
        
        echo view('frontend/header', $data);
        echo view('details', $data);
        echo view('frontend/footer');
        
    }

    /*
    public function list()
    {
        $db = \Config\Database::connect();

        $country = 1;
        $region             = $this->request->getPost("region");
        $city               = $this->request->getPost("city");
        $category           = $this->request->getPost("category");
        $q                  = $this->request->getPost("q");

        $builder = $db->table('business');
        $builder->select(' *,
        business.id as id,
        business.name as name,
        business.name_short as business_nameshort,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_name_short,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_name_short,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_name_short
        ');

        if($country!=0){
            $builder->where('business.country', $country);
        }
        
        if($region!=0){
            $builder->where('business.region', $region);
        }
        
        if($city!=0){
            $builder->where('business.city', $city);
        }
        
        if($category!=0){
            $builder->where('business.category', $category);
        }
        
        if($q!=""){
            $builder->like('business.name', $q);
        }
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $RegionModel        = new RegionModel();
        $data['region_name']= $RegionModel->orderBy('position', 'ASC')->where('id', $region)->find();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->where('region', $region)->find();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $builder->join('category'   , 'category.id = business.category');
        $builder->join('region'     , 'region.id = business.region');
        $builder->join('city'       , 'city.id = business.city');
        $query = $builder->get();
        
        $data['business'] = $query->getResult();

        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        $data['region_name'] = array(0 => array('name' => ""));

        if($data['region_name'] != null){
            $data['region_name'] = $data['region_name'][0];
        }
        
        echo view('frontend/header', $data);
        echo view('business_list', $data);
        echo view('frontend/footer');
    }

    

    public function getByRegion($regionName = null){
        
        $session = session();

        $db = \Config\Database::connect();

        $region = 0;
        $country = 0;
        $city = 0;
        $category = 0;
        $q = "";

        $breadcrumb = "";

        //Region
        $RegionModel = new RegionModel();
        $data['region'] = $RegionModel->where('name_short', $regionName)->first();
        if(!empty($data['region'])){
            $region = $data['region']['id'];
            $breadcrumb .= $data['region']['name'];
            $session->set("region",$regionName);
        }
        
        $session->set("breadcrumb",$breadcrumb);

        $data = $this->getBusinessList($region, $country, $city, $category, $q);

        //Category list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM (SELECT T1.category, count(*) as total
        FROM business T1 WHERE `region`=$region
        GROUP BY T1.category
        HAVING count(*) > 0 
        ORDER BY category desc) T2 JOIN `category` ON T2.category = category.id ORDER BY id ");

        $categoryList = $query->getResult();

        $data['categoryListByRegion'] = $categoryList;

        //City list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM 
        (SELECT T1.city, count(*) as total FROM 
        business T1 WHERE `region`=$region 
        GROUP BY T1.city HAVING count(*) > 0 
        ORDER BY city desc) T2 JOIN `city` ON T2.city = city.id ORDER BY id; ");

        $cityList = $query->getResult();

        $data['cityListByRegion'] = $cityList;

        $data['regionId'] = $regionName;

        echo view('frontend/header', $data);
        echo view('business_list', $data);
        echo view('frontend/footer');

    }

    public function getByRegionCity($regionName = null, $cityName = null){
        
        $session = session();

        $db = \Config\Database::connect();

        $region = 0;
        $country = 0;
        $city = 0;
        $category = 0;
        $q = "";

        $breadcrumb = "";
        
        //Region
        $RegionModel = new RegionModel();
        $data['region'] = $RegionModel->where('name_short', $regionName)->first();
        if(!empty($data['region'])){
            $region = $data['region']['id'];
            $session->set("region",$regionName);
            $breadcrumb .= "<a class='active' href='".base_url()."/".$data['region']['name_short']."'>".$data['region']['name']."</a> / ";
        }

        //City
        $CityModel = new CityModel();
        $data['city'] = $CityModel->where('name_short', $cityName)->first();
        if(!empty($data['city'])){
            $city = $data['city']['id'];
            $breadcrumb .= $data['city']['name']."";
        }
        
        $session->set("breadcrumb",$breadcrumb);

        $data = $this->getBusinessList($region, $country, $city, $category, $q);

        //Category list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM (SELECT T1.category, count(*) as total
        FROM business T1 WHERE `region`=$region AND `city`=$city
        GROUP BY T1.category
        HAVING count(*) > 0 
        ORDER BY category desc) T2 JOIN `category` ON T2.category = category.id ORDER BY id ");

        $categoryList = $query->getResult();

        $data['categoryListByRegion'] = $categoryList;

        //City list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM 
        (SELECT T1.city, count(*) as total FROM 
        business T1 WHERE `region`=$region 
        GROUP BY T1.city HAVING count(*) > 0 
        ORDER BY city desc) T2 JOIN `city` ON T2.city = city.id ORDER BY id; ");

        $cityList = $query->getResult();

        $data['cityListByRegion'] = $cityList;

        $data['regionId'] = $regionName;

        echo view('frontend/header', $data);
        echo view('business_list', $data);
        echo view('frontend/footer');
    }

    public function getByRegionCityCategory($regionName = null, $cityName = null, $categoryName = null){
        
        $session = session();

        $db = \Config\Database::connect();

        $region = 0;
        $country = 0;
        $city = 0;
        $category = 0;
        $q = "";

        $breadcrumb = "";
        
        //Region
        $RegionModel = new RegionModel();
        $data['region'] = $RegionModel->where('name_short', $regionName)->first();
        if(!empty($data['region'])){
            $region = $data['region']['id'];
            $session->set("region",$regionName);
            $breadcrumb .= "<a class='active' href='".base_url()."/".$data['region']['name_short']."'>".$data['region']['name']."</a> / ";
        }

        //City
        $CityModel = new CityModel();
        $data['city'] = $CityModel->where('name_short', $cityName)->first();
        if(!empty($data['city'])){
            $city = $data['city']['id'];
            $breadcrumb .= "<a class='active' href='".base_url()."/".$data['region']['name_short']."/".$data['city']['name_short']."'>".$data['city']['name']."</a> / ";
            //$breadcrumb .= $data['city']['name']." / ";
        }
        
        //Category
        $CategoryModel = new CategoryModel();
        $data['category'] = $CategoryModel->where('name_short', $categoryName)->first();
        if(!empty($data['category'])){
            $category = $data['category']['id'];
            $breadcrumb .= $data['category']['name']."";
        }
        
        $session->set("breadcrumb",$breadcrumb);

        $data = $this->getBusinessList($region, $country, $city, $category, $q);

        //Category list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM (SELECT T1.category, count(*) as total
        FROM business T1 WHERE `region`=$region AND `city`=$city
        GROUP BY T1.category
        HAVING count(*) > 0 
        ORDER BY category desc) T2 JOIN `category` ON T2.category = category.id ORDER BY id ");

        $categoryList = $query->getResult();

        $data['categoryListByRegion'] = $categoryList;

        //City list
        $query = $db->query("SELECT id, name, name_short, T2.total FROM 
        (SELECT T1.city, count(*) as total FROM 
        business T1 WHERE `region`=$region 
        GROUP BY T1.city HAVING count(*) > 0 
        ORDER BY city desc) T2 JOIN `city` ON T2.city = city.id ORDER BY id; ");

        $cityList = $query->getResult();

        $data['cityListByRegion'] = $cityList;

        $data['regionId'] = $regionName;

        echo view('frontend/header', $data);
        echo view('business_list', $data);
        echo view('frontend/footer');
    }

    

    
    */
}
