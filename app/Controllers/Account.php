<?php

namespace App\Controllers;
use App\Models\RegionModel;
use App\Models\CityModel;
use App\Models\CategoryModel;
use App\Models\BusinessModel;
use App\Models\AdsModel;
use App\Models\UserModel;

class Account extends BaseController
{
    public function register()
    {
        $session = session();

        $db                 = \Config\Database::connect();

        $email              = $this->request->getVar('email');
        $password           = $this->request->getVar('password');
        $password_repeat    = $this->request->getVar('password_repeat');

        if($password != "" && $password_repeat != "" ){
            if($password == $password_repeat){
                $builder = $db->table('users');
                $builder->set('email'   , $email);
                $builder->set('password', md5($password));
                $builder->insert();
                $session->setFlashdata('msg_register', 'Registro exitoso');
                return redirect()->to('/register');
            }else{
                $session->setFlashdata('msg_register', 'No se pudo registrar');
                return redirect()->to('/register');
            }
        }else{
            $session->setFlashdata('msg_register', 'No se pudo registrar');
            return redirect()->to('/register');
        }
        
        
    }

    public function login()
    {
        $session = session();

        $model = new UserModel();

        $email = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $data = $model->where('email', $email)->first();

        if($data){
            $pass       = $data['password'];
            $passhash   = md5($password);
            //echo 'hash pass:<br/>'.$passhash.'<br/>'.$pass;
            //die();
            $verify_pass = ($passhash==$pass)?true:false;
            if($verify_pass){
                /*
                $ses_data = [
                    'user_id'       => $data['id'],
                    'user_name'     => $data['name'],
                    'user_email'    => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                */
                $session->set("userdata", array(
                    "user_id" => $data['id'],
                    "user_name" => $data['name'],
                    "user_lastname" => $data['lastname'],
                    "user_email" => $data['email']
                ));

                $session->set("userdata_admin", array(
                    "user_id" => $data['id'],
                    "user_name" => $data['name'],
                    "user_lastname" => $data['lastname'],
                    "user_email" => $data['email']
                ));
                //print_r($session->get("userdata_admin"));
                //die();
                return redirect()->to('/account');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function dashboard(){
        
        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        if($data['data_context'] == null)
            return redirect()->to('/login');
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $BusinessModel      = new BusinessModel();
        $data['business']   = $BusinessModel->where('user', $data['data_context']['user_id'])->findAll();

        //print_r ($data['business']);
        
        echo view('frontend/header', $data);
        echo view('dashboard', $data);
        echo view('frontend/footer', $data);
        
    }
    
    public function editBusiness(){
        
        $session        = session();

        $db             = \Config\Database::connect();

        $name           = $this->request->getPost("name");
        $email          = $this->request->getPost("email");
        $phone          = $this->request->getPost("phone");
        $region         = $this->request->getPost("region");
        $city           = $this->request->getPost("city");
        $category       = $this->request->getPost("category");
        $schedule       = $this->request->getPost("schedule");
        $description    = $this->request->getPost("description");
        $image_business = $this->request->getPost("image_business");
        $contact        = $this->request->getPost("contact");
        $id             = $this->request->getPost("id");

        $builder = $db->table('business');
        $builder->set('name'        , $name);
        $builder->set('phone'       , $phone);
        $builder->set('country'     , 1);
        $builder->set('region'       , $region);
        $builder->set('city'        , $city);
        $builder->set('category'    , $category);
        $builder->set('contact'     , $contact);
        $builder->set('schedule'    , $schedule);
        $builder->set('description' , $description);
        
        helper(['form', 'url']);

        $file = $this->validate([
            'file' => [
                'uploaded[file]',
                'max_size[file,4096]',
            ]
        ]);
    
        if (!$file) {
            $session->setFlashdata('msg_update_business', 'Error al actualizar la información de la empresa');
        } else {
            $path_to_file   = WRITEPATH.'../business/'.$id.'/'.$id.".png";
            $path_to_folder = WRITEPATH.'../business/'.$id.'/';

            if(!file_exists($path_to_folder)){
                if(!mkdir($path_to_folder, 0777, true)) {
                    $session->setFlashdata('msg_update_business', 'Error al actualizar la información de la empresa');
                }else{
                    /*
                    if (!copy(WRITEPATH."../business/0/0.png", WRITEPATH.'../business/'.$id.'/'.$id.".png")) {
                        $session->setFlashdata('msg_update_business', 'Error al actualizar la información de la empresa');
                    }
                    */
                    $imageFile = $this->request->getFile('file');
                    $imageFile->move(WRITEPATH . '../business/'.$id, $id.".png");
                    $builder->set('image' , 1);
                }
            }else{
                if(!unlink($path_to_file)) {
                    $session->setFlashdata('msg_update_business', 'Error al actualizar la información de la empresa');
                }
    
                $imageFile = $this->request->getFile('file');
                $imageFile->move(WRITEPATH . '../business/'.$id, $id.".png");
            }
        }

        $builder->where('id'        , $id);
        $builder->update();

        $session->setFlashdata('msg_update_business', 'Información de la empresa actualizada');

        return redirect()->to('/account');
    }

    public function editUser(){

        $session    = session();

        $db         = \Config\Database::connect();

        helper(['form', 'url']);

        $user_name              = $this->request->getPost("user_name");
        $user_lastname          = $this->request->getPost("user_lastname");
        $user_password          = $this->request->getPost("user_password");
        $user_password_repeat   = $this->request->getPost("user_password_repeat");
        $id                     = $this->request->getPost("user_id");

        $builder = $db->table('users');
        $builder->set('name'    , $user_name);
        $builder->set('lastname', $user_lastname);

        $pass       = $data['password'];
        $passhash   = md5($password);
        
        if($user_password != "" && $user_password_repeat != "")
        {
            if($user_password == $user_password_repeat){
                $builder->set('password', $user_password);
            }else{
                $session->setFlashdata('msg_update_account', 'No se pudo actualizar el usuario');
            }
        }

        $builder->where('id', $id);
        $builder->update();
        $session->setFlashdata('msg_update_account', 'Los cambios se reflejarán cuando vuelva a iniciar sesión');
        return redirect()->to('/account');
    }

    public function createBusiness(){
        $session        = session();

        $message        = "";

        $db             = \Config\Database::connect();

        $name           = $this->request->getPost("name");
        $email          = $this->request->getPost("email");
        $phone          = $this->request->getPost("phone");
        $region         = $this->request->getPost("region");
        $city           = $this->request->getPost("city");
        $category       = $this->request->getPost("category");
        $schedule       = $this->request->getPost("schedule");
        $description    = $this->request->getPost("description");
        $image_business = $this->request->getPost("image_business");
        $contact        = $this->request->getPost("contact");
        $id             = $this->request->getPost("userid");
        /*
        echo "name:".$name."<br/>";
        echo "email:".$email."<br/>";
        echo "phone:".$phone."<br/>";
        echo "region:".$region."<br/>";
        echo "city:".$city."<br/>";
        echo "category:".$category."<br/>";
        echo "schedule:".$schedule."<br/>";
        echo "description:".$description."<br/>";
        echo "image_business:".$image_business."<br/>";
        echo "contact:".$contact."<br/>";
        echo "id:".$id."<br/>";
        */
        if($name != "" && $email != "" && $phone != ""){

            $string = $name;
            $separator = '_';

            $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|Grave|lig|orn|ring|slash|th|tilde|uml);~i';
            $special_cases = array( '&' => 'and', "'" => '');
            $string = mb_strtolower( trim( $string ), 'UTF-8' );
            $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
            $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
            $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
            $new_name = preg_replace("/[$separator]+/u", "$separator", $string);

            $builder = $db->table('business');

            $data = [
                'name'          => $name,
                'name_short'    => $new_name,
                'email'         => $email,
                'phone'         => $phone,
                'region'        => $region,
                'city'          => $city,
                'category'      => $category,
                'schedule'      => $schedule,
                'description'   => $description,
                'contact'       => $contact,
                'user'          => $id
            ];

            $builder->insert($data);

            $session->setFlashdata('msg_create_account', 'Empresa creada, los cambios seran visibles en el proximo inicio de sesion');
            $message = 'Empresa creada, los cambios seran visibles en el proximo inicio de sesion';
        }else{
            $session->setFlashdata('msg_create_account', 'Faltan datos minimos, nombre, correo y teléfono');
            $message = 'Faltan datos minimos, nombre, correo y teléfono';
        }
        //echo $message;
        return redirect()->to('/account');
    }
}
