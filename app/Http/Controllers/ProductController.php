<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequestValidation;
use App\Actions\DBOperations\ProductCRUD;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->crud = new ProductCRUD();
    }

    public function index(){
        $products = $this->crud->retrieve()['products'];
        $categories = $this->crud->retrieve()['categories'];
        return view('products', compact('products', 'categories'));
    }

    public function addProduct(ProductRequestValidation $request){
        try {
            $validator = $request->validated();
            $result = $this->crud->create($validator, $request);
            return $result;
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function editProduct(ProductRequestValidation $request, $id){
        try {
            
            $validator = $request->validated();
            $update_category = $this->crud->edit($id, $validator, $request);
            return $update_category;
            
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function deleteProduct($id){
        try {
            $delete_product = $this->crud->delete($id);
            return $delete_product;
            
        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

}
