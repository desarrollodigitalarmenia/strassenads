<?php

namespace App\Controllers;
use App\Models\RegionModel;
use App\Models\CityModel;
use App\Models\CategoryModel;
use App\Models\BusinessModel;
use App\Models\AdsModel;

class Home extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();

        $RegionModel = new RegionModel();
        $data['regions'] = $RegionModel->orderBy('position', 'ASC')->findAll();

        $builder = $db->table('ads');
        $builder->select(' *,
        business.id as business_id,
        business.name as business_name,
        business.name_short as business_nameshort,
        business.description as business_description,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_nameshort,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_nameshort,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_nameshort
        ');
        $builder->where('ads.name_short', 'business_main');
        $builder->join('business', 'business.id = ads.business');
        $builder->join('category', 'category.id = business.category');
        $builder->join('city', 'city.id = business.city');
        $builder->join('region', 'region.id = business.region');
        $query = $builder->get();
        $data['business_main'] = $query->getResult();

        $builder = $db->table('ads');
        $builder->select(' *,
        business.id as business_id,
        business.name as business_name,
        business.name_short as business_nameshort,
        business.description as business_description,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_nameshort,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_nameshort,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_nameshort
        ');
        $builder->where('ads.name_short', 'business_more_visited');
        $builder->join('business', 'business.id = ads.business');
        $builder->join('category', 'category.id = business.category');
        $builder->join('city', 'city.id = business.city');
        $builder->join('region', 'region.id = business.region');
        $query = $builder->get();
        $data['business_more_visited'] = $query->getResult();

        $CategoryModel = new CategoryModel();
        $data['categories']     = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('index', $data);
        echo view('frontend/footer');
    }

    public function login()
    {
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('login');
        echo view('frontend/footer');
    }

    public function region($id = null){
        $db      = \Config\Database::connect();

        $RegionModel        = new RegionModel();

        $data['region']     = $RegionModel->where('name_short', $id)->first();

        
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->where('region', $data['region']['id'])->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $builder = $db->table('business');
        $builder->select(' *,
        business.id as business_id,
        business.name as business_name,
        business.name_short as business_nameshort,
        business.description as business_description,
        business.image as business_image,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_nameshort,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_nameshort,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_nameshort
        ');
        $builder->where('business.region', $data['region']['id']);
        $builder->join('category', 'category.id = business.category');
        $builder->join('city', 'city.id = business.city');
        $builder->join('region', 'region.id = business.region');
        $query = $builder->get();
        $data['business'] = $query->getResult();
        /*
        print_r($query);
        die();
        */
        $session = session();
        $data['data_context'] = $session->get("userdata");

        $RegionModel        = new RegionModel();
        
        if($data['business'] != null){
            $data['region_name']= $RegionModel->orderBy('position', 'ASC')->where('id', $data['business'][0]->region)->find();
            $data['region_name']= $data['region_name'][0]['name_short'];
        }else{
            $data['region_name']= "";
        }
        
        echo view('frontend/header', $data);
        echo view('list_business', $data);
        echo view('frontend/footer');
        
    }

    public function city($state_id = null, $city_id = null){
        $db      = \Config\Database::connect();
        
        $CityModel    = new CityModel();
        $data['city']   = $CityModel->where('name_short', $city_id)->first();

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->where('region', $state_id)->findAll();

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $builder = $db->table('business');
        $builder->select(' *,
        business.id as business_id,
        business.name as business_name,
        business.name_short as business_nameshort,
        business.description as business_description,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_nameshort,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_nameshort,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_nameshort
        ');
        $builder->where('business.city', $data['city']['id']);
        $builder->where('city.region', $data['city']['region']);
        $builder->join('category', 'category.id = business.category');
        $builder->join('city', 'city.id = business.city');
        $builder->join('region', 'region.id = business.region');
        $query = $builder->get();
        $data['business'] = $query->getResult();

        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        echo view('frontend/header', $data);
        echo view('list_business', $data);
        echo view('frontend/footer');
        
    }

    public function category($categoryname = null){
        
        $db      = \Config\Database::connect();
        /*
        $CityModel          = new CityModel();
        $data['city']       = $CityModel->where('name_short', $categoryname)->first();
        */

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->findAll();

        $RegionModel        = new RegionModel();
        $data['region']     = $RegionModel->where('id', $data['cities'][0]['id'])->first();
        
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        $data['category'] = $CategoryModel->orderBy('position', 'ASC')->where('name_short', $categoryname)->find();
        $category = $data['category'][0];

        $builder = $db->table('business');
        $builder->select(' *,
        business.id as business_id,
        business.name as business_name,
        business.name_short as business_nameshort,
        business.description as business_description,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_nameshort,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_nameshort,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_nameshort
        ');

        $builder->where('business.category', $category['id']);
        $builder->join('category', 'category.id = business.category');
        $builder->join('city', 'city.id = business.city');
        $builder->join('region', 'region.id = business.region');
        $query = $builder->get();
        $data['business'] = $query->getResult();

        $session = session();
        $data['data_context'] = $session->get("userdata");

        $RegionModel        = new RegionModel();
        
        if($data['business'] != null){
            $data['region_name']= $RegionModel->orderBy('position', 'ASC')->where('id', $data['business'][0]->region)->find();
            $data['region_name']= $data['region_name'][0]['name_short'];
        }else{
            $data['region_name']= "";
        }
        

        //echo "region:".$data['region_name'];
        //die();
        echo view('frontend/header', $data);
        echo view('list_business', $data);
        echo view('frontend/footer');
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

    public function morecategory(){

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('categories');
        echo view('frontend/footer');
    }

    public function subcategories($categoryname = null){
        $db      = \Config\Database::connect();

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        $data['category'] = $CategoryModel->orderBy('position', 'ASC')->where('name_short', $categoryname)->find();
        $category = $data['category'][0];

        $data['subcategories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', $category['id'])->find();

        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('subcategories');
        echo view('frontend/footer');
    }
    
    public function morestate(){
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        echo view('frontend/header', $data);
        echo view('states');
        echo view('frontend/footer');
        
        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo "Regions";
    }

    public function cities($state = null){
        $db                 = \Config\Database::connect();

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        $data['region']     = $RegionModel->orderBy('position', 'ASC')->where('name_short', $state)->find();
        $region             = $data['region'][0];

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->where('region', $region['id'])->findAll();
        
        $data['region']     = $state;

        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('cities');
        echo view('frontend/footer');
    }

    public function searchMain(){
        $RegionModel        = new RegionModel();
        $region             = $RegionModel->where('name_short', $this->request->getPost("region"))->find();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->where('region', $region[0]["id"])->findAll();
        return json_encode($data['cities']);
    }
    
    public function search(){

        echo "Search Page";
        /*
        $db                 = \Config\Database::connect();

        $q                  = $this->request->getPost("q");
        $region             = $this->request->getPost("region");
        $city               = $this->request->getPost("city");
        $category           = $this->request->getPost("category");
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $RegionModel        = new RegionModel();
        $data['region_name']= $RegionModel->orderBy('position', 'ASC')->where('id', $region)->find();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
  
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

        if($q != "")
            $builder->like('business.name'              , $q);
        if($region != 0)
            $builder->havingLike('business.region'      , $region);
        if($city != 0)
            $builder->havingLike('business.city'        , $city);
        if($category != 0)
            $builder->havingLike('business.category'    , $category);
        

        $builder->join('category'               , 'category.id = business.category');
        $builder->join('region'                 , 'region.id = business.region');
        $builder->join('city'                   , 'city.id = business.city');
        $query = $builder->get();
        
        $data['business'] = $query->getResult();

        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        $data['region_name'] = array(0 => array('name' => ""));

        if($data['region_name'] != null){
            $data['region_name'] = $data['region_name'][0];
        }

        echo view('frontend/header', $data);
        echo view('search', $data);
        echo view('frontend/footer');
        */
    }

    public function regionsAndCategories(){

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
    }

    public function aboutus(){

        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('aboutus');
        echo view('frontend/footer');
    }

    public function blog(){
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('blog');
        echo view('frontend/footer');
    }
    
    public function contactus(){
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('contactus');
        echo view('frontend/footer');
    }

    public function register()
    {
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();
        
        $session = session();
        $data['data_context'] = $session->get("userdata");

        echo view('frontend/header', $data);
        echo view('register');
        echo view('frontend/footer');
    }
}
