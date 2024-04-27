<?php 

namespace App\Actions\DBOperations;

use App\Models\User;

class UserCRUD{

    public function __construct()
    {
        $this->user = new User();
        $this->user->timestamps = false;
    }

    public function retrieve(){
        $get_users = $this->user->with('roles.user')->get();
        return $get_users;
    }

    public function edit($id){
        $update_user = $this->user->where('id', $id)->update(['role' => 1]);
        return $update_user;
    }

    public function delete($id){
        $delete_user = $this->user->where('id', $id)->delete();
        return $delete_user;
    }

}

?>