<?php
    namespace App\Models;

    class UserModel extends Model {
        protected $table = 'users';
        protected $fillable = [
            'email',
            'firstname',
            'lastname',
            'password',
            'gender',
            'age',
            'created_at',
            'updated_at'
        ];

        public $timestamps  = false;

        public function getByEmail($email) {
            return $this->where('email', $email)->first();
        }

        public function authenticate($secret, $key) {
            $user = $this->getByEmail($secret);
            if(!$user) {
                //add message no user found
                return false;
            }

            $validatePassword = password_verify($key, $user->password);

            if(!$validatePassword) {
                return false;
            }

            //start session if logged in
            return $user;
        }
    }