<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\DBOperations\UserCRUD;
use Auth;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->crud = new UserCRUD();
    }

    public function index() {
        $users = $this->crud->retrieve();
        return view('users', compact('users'));
    }

    public function editUser($id){
        try {
            
            $update_user = $this->crud->edit($id);
            return $update_user;
            
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function deleteUser($id){
        try {
            $delete_user = $this->crud->delete($id);
            return $delete_user;
            
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

}
