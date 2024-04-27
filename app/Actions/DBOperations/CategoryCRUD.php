<?php 

namespace App\Actions\DBOperations;

use App\Models\ProductCategory;
use App\Models\ProductCategoryPivot;


class CategoryCRUD
{

    public function __construct()
    {
        $this->model = new ProductCategory();
        $this->prodcat = new ProductCategoryPivot();
        $this->model->timestamps = false;
    }

    public function retrieve(){
        return $categories = $this->model->all();
    }

    public function create($data){
        $this->model->name = $data['category_name'];
        $create_category = $this->model->save();
        return $create_category;
    }

    public function edit($id, $data){
        $update_category = $this->model->where('id', $id)->update(['name' => $data['category_name']]);
        return $update_category;
    }

    public function delete($id){
        $delete_pivot = $this->prodcat->where('category_id', $id)->delete();
        $delete_category = $this->model->where('id', $id)->delete();
        return $delete_category;
    }

    // public function read($id){
    //     $read_category = $this->model->find($id);
    //     if (!$read_category) {
    //         $read_category = "Product Category Not Found!";
    //     }
    //     return $read_category;
    // }
    
}

?>