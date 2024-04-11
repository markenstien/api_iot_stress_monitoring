<?php
    namespace App\Controllers;

use App\Models\UserModel;

    class UserController extends Controller{
        protected $modelUser;

        public function __construct()
        {
            parent::__construct();
            $this->modelUser = new UserModel();
        }


        public function index() {
            echo parent::apiResponse($this->modelUser->all());
        }
        
        public function authenticate() {
            if(parent::isSubmitted()) {
                $req = request()->postData();
                //validate email
                $email = $req['email'];
                $password = $req['password'];

                $resp = $this->modelUser->authenticate($email, $password);

                if(!$resp) {
                    echo parent::apiResponse([
                        'message' => $this->modelUser->getMessageString()
                    ]);
                } else{
                    echo parent::apiResponse([
                        'message' => 'authenticated',
                        'user' => $resp
                    ]);
                }
            }
        }

        public function register() {
            if(parent::isSubmitted()) {
                $req = request()->postData();

                $resp = $this->modelUser->getByEmail($req['email']);

                if($resp) {
                    echo parent::apiResponse([
                        'message' => 'Unable to register user already exist'
                    ]);
                    return;
                } else {
                    $resp = $this->modelUser->create([
                        'email' => $req['email'],
                        'firstname' => $req['firstname'],
                        'lastname' => $req['lastname'],
                        'password' => password_hash($req['password'], PASSWORD_DEFAULT)
                    ]);

                    if($resp) {
                        echo parent::apiResponse([
                            'message' => 'User Created'
                        ]);
                    } else {
                        echo parent::apiResponse([
                            'message' => 'something went wrong'
                        ]);
                    }
                }
            }
        }

        public function get($id) {
            $user = $this->modelUser->getById($id);

            if(!$user) {
                $message = "User not found";
            } else {
                $message = "User found {$user->firstname}";
            }
            echo parent::apiResponse([
                'message' => $message,
                'data'    => $user
            ]);
        }
    }