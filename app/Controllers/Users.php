<?php

namespace App\Controllers;
use App\Models\UsersModel;
use CodeIgniter\RESTful\ResourceController;
class Users extends ResourceController
{
   protected $usersModel;
	protected $modelName = 'App\Models\Users';
   protected $format    = 'json';

   public function __construct()
   {
      $this->usersModel = new UsersModel();
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
      return $this->respond($this->usersModel->findAll());
   }

   public function create()
   {
      $data = $this->request->getPost();
      $this->validation->run($data, 'register');
      $errors = $this->validation->getErrors();

      if(!$errors) {
         $user = new \App\Entities\Users();
         $user->fill($data);
         $user->created_by = 0;
         $user->created_date = date('Y-m-d H:i:s');

         if($this->usersModel->save($user)) {
            return $this->respondCreated($user, 'user created');
         }
      }
      return $this->fail($errors);
   }

   public function update($id = null)
   {
      $data = $this->request->getRawInput();
      $data['id'] = $id;
      $this->validation->run($data, 'update_user');
      $errors = $this->validation->getErrors();

      if($errors) {
         return $this->fail($errors);
      }

      if(!$this->usersModel->getById($id)) {
         return $this->fail('id tidak ditemukan.');
      }

      $user = new \App\Entities\Users();
      $user->fill($data);
      $user->updated_by = 0;
      $user->updated_date = date('Y-m-d H:i:s');

      if($this->usersModel->save($user)) {
         return $this->respondUpdated($user, 'user updated');
      }
   }

   public function delete($id = null)
   {
      if(!$this->usersModel->getById($id)) {
         return $this->fail('id tidak ditemukan.');
      }

      if($this->usersModel->delete($id)) {
         return $this->respondDeleted(['id' => $id . ' Deleted']);
      }
   }

   public function show($id = null)
   {
      $data = $this->usersModel->getById($id);
      if($data) {
         return $this->respond($data);
      }

      return $this->fail('errors');
   }
}
