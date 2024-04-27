<?php 

namespace App\Actions\DBOperations;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryPivot;


class ProductCRUD
{

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new ProductCategory();
        $this->prodcat = new ProductCategoryPivot();
        $this->product->timestamps = false;
    }

    public function retrieve(){
        return [
            "products" => $this->product->with('pivot.category')->get(),
            "categories" => $this->category->all()
        ];
    }

    public function create($data, $request){

        $categories = explode(",", $data['product_category']);
        $prodcat_arr = [];

        $file = $request->file('product_image');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        $this->product->name = $data['product_name'];
        $this->product->description = $data['product_desc'];
        $this->product->image = $filePath;
        $this->product->price = $data['product_price'];
        $this->product->stock = $data['product_stock'];
        $create_product = $this->product->save();
        $product_id = $this->product->id;

        foreach ($categories as $category) {
            $prodcat_arr[] = [
                "product_id" => $product_id,
                "category_id" => $category,
            ];
        }

        $create_pivot = $this->prodcat->insert($prodcat_arr);

        return $create_pivot;
    }

    public function edit($id, $data, $request){

        $new_data_arr = [];
        $categories = explode(",", $data['product_category']);
        $prodcat_arr = [];

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads', 'public');
            $new_data_arr[] = ['image' => $filePath];
        }

        $new_data_arr[] = [
            'name' => $data['product_name'],
            'stock' => $data['product_stock'],
            'price' => $data['product_price'],
            'description' => $data['product_desc'],
        ];

        $update_product = $this->product->where('id', $id)->update($new_data_arr[0]);

        foreach ($categories as $category) {
            $prodcat_arr[] = [
                "product_id" => $id,
                "category_id" => $category,
            ];
        }

        $delete_pivot = $this->prodcat->where('product_id', $id)->delete();

        $create_pivot = $this->prodcat->insert($prodcat_arr);

        return $update_product;
    }

    public function delete($id){
        $delete_pivot = $this->prodcat->where('product_id', $id)->delete();
        $delete_product = $this->product->where('id', $id)->delete();
        return $delete_product;
    }

    // public function read($id){
    //     $read_product = $this->product->find($id);
    //     if (!$read_product) {
    //         $read_product = "Product Product Not Found!";
    //     }
    //     return $read_product;
    // }
    
}

?>