<?php 
namespace App\Controllers;
use App\Models\RegionModel;
use CodeIgniter\Controller;
class RegionController extends Controller
{
    // show dashboard
    public function dashboard(){
        echo view('template/header');
        echo view('admin/dashboard');
        echo view('template/footer');
    }

    // show users list
    public function index(){
        $RegionModel = new RegionModel();
        $data['regions'] = $RegionModel->orderBy('id', 'DESC')->findAll();

        echo view('template/header', $data);
        echo view('admin/user_view', $data);
        echo view('template/footer', $data);
    }
    
    // add user form
    public function create(){
        echo view('template/header');
        echo view('admin/add_user');
        echo view('template/footer');
    }
 
    // insert data
    public function store() {
        $RegionModel = new RegionModel();
        $data = [
            'name'      => $this->request->getVar('name'),
            'email'     => $this->request->getVar('email'),
            'password'  => md5($password)
        ];
        $RegionModel->insert($data);

        echo view('template/header');
        $this->response->redirect(site_url('admin/users-list'));
        echo view('template/footer');
    }

    // show single user
    public function singleUser($id = null){
        $session = session();
        $data['data_context'] = $session->get("userdata");
        $RegionModel = new RegionModel();
        $data['user_obj'] = $RegionModel->where('id', $id)->first();

        echo view('template/header', $data);
        echo view('admin/edit_view', $data);
        echo view('template/footer', $data);
    }

    // update user data
    public function update(){
        $RegionModel  = new RegionModel();
        $id         = $this->request->getVar('id');
        $password1  = $this->request->getVar('password1');
        $password2  = $this->request->getVar('password2');

        if($password1 != ""){
            if($password1 == $password2){
                $password = md5($password1);
            }else{
                $session->setFlashdata('msg', 'Passwords not match');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/');
        }
        

        $data = [
            'name'      => $this->request->getVar('name'),
            'email'     => $this->request->getVar('email'),
            'password'  => $password
        ];

        $RegionModel->update($id, $data);

        echo view('template/header');
        $this->response->redirect(site_url('admin/users-list'));
        echo view('template/footer');
    }
 
    // delete user
    public function delete($id = null){
        $RegionModel = new RegionModel();
        $data['user'] = $RegionModel->where('id', $id)->delete($id);

        echo view('template/header');
        $this->response->redirect(site_url('admin/users-list'));
        echo view('template/footer');
    }

}