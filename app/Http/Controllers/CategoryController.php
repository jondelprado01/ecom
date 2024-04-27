<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequestValidation;
use App\Actions\DBOperations\CategoryCRUD;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->crud = new CategoryCRUD();
    }

    public function index(){
        $categories = $this->crud->retrieve();
        return view('product-category', compact('categories'));
    }

    public function addCategory(CategoryRequestValidation $request){
        try {
            $validator = $request->validated();
            $result = $this->crud->create($validator);
            return $result;
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function editCategory(CategoryRequestValidation $request, $id){
        try {
            
            $validator = $request->validated();
            $update_category = $this->crud->edit($id, $validator);
            return $update_category;
            
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function deleteCategory($id){
        try {
            $delete_category = $this->crud->delete($id);
            return $delete_category;
            
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }
}
