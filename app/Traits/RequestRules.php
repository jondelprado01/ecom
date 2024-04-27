<?php
namespace App\Traits;

trait RequestRules
{
    

    public function categoryRules()
    {
        return [
            "category_name" => "required",
        ];
    }

    public function categoryRulesMessages()
    {
        return [
            "category_name.required" => "Category Name is Required",
        ];
    }


    public function productRules()
    {
        return [
            "product_name" => "required",
            "product_category" => "required",
            "product_desc" => "required",
            "product_price" => "required|integer",
            "product_stock" => "required|integer",
            // "product_image" => "required|mimes:pdf,jpg,png|max:2048"
        ];
    }

    public function productRulesMessages()
    {
        return [
            "product_name.required" => "Product Name is Required",
            "product_category.required" => "Product Category is Required",
            "product_desc.required" => "Product Description is Required",
            "product_price.required" => "Product Price is Required",
            "product_price.integer" => "Product Price must be a number",
            "product_stock.required" => "Product Stock is Required",
            "product_stock.integer" => "Product Stock must be a number",
            // "product_image.required" => "Product Image is Required",
            // "product_image.file" => "Product Image must be a file",
            // "product_image.size" => "Product Image must not exceed 5MB",
        ];
    }

}
