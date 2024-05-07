<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProfileMenuModel;
use App\Models\MstMenuModel;
use App\Models\EmployeeModel;

class UserController extends BaseController
{
    public function index()  {
        return view('layout/login');        
    }

    public function doLogin() {
        helper(['form']);
        $rules = [
            "username" => [
                "label" => "Username", 
                "rules" => "required|min_length[3]|max_length[20]"
            ],
            "password" => [
                "label" => "Password", 
                "rules" => "required|min_length[3]|max_length[20]"
            ]
        ];

        if ($this->validate($rules)) {  
            $session = session();
            $userModel = new UserModel();

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            
            try {
                $array = array('username' => $username);
                $dataUser = $userModel->where($array)->first();
                if ( $dataUser ) {
                    // if ( password_verify($password, $dataUser['password']) ) {
                        $profileMenu = new ProfileMenuModel();
                        $mstMenu = new MstMenuModel();
                        $employee = new EmployeeModel();

                        $dataProfile = $profileMenu->where( array( 'id' => $dataUser['profile_id'] ) )->first();
                        $emp = $employee->where( array( 'user_id' => $dataUser['id'] ) )->first();
                        $arrMenuID = explode(",",$dataProfile['menu_id']);
                        $profileMenu = [];
                        for ($i = 0; $i < count($arrMenuID); $i++) {
                            $tempMenu = $mstMenu->where( array( 'id' => $arrMenuID[$i] ) )->first();
                            array_push($profileMenu, [
                                'menu_id' => $arrMenuID[$i],
                                'menu_detail' => $tempMenu['detail'],
                                'url' => $tempMenu['url']
                            ]);
                        }
                        $ses_data = array ( [
                            'id' => $dataUser['id'],
                            'username' => $dataUser['username'],
                            'name' => $emp['name'],
                            'employeeId' => $emp['id'],
                            'role' => $dataProfile['profile']
                        ] ) ;
                        // echo "<pre>"; var_dump($ses_data); echo"</pre>";
                        $session->set('dataUser', $ses_data);
                        $session->set('profileMenu', $profileMenu);
                        return redirect()->to('/');
                } else {
                    $session->setFlashdata('message', 'User Not Found');
                    return redirect()->to('/login');
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $data['validation'] = $this->validator;
            return view('layout/login');
        }
       
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
    
}
