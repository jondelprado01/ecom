<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>Product Table</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped product-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            @foreach($product->pivot as $pivot)
                                                <span class="badge rounded-pill text-bg-primary">{{$pivot->category->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td>
                                            <button request-type="product" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-product-modal-{{$product->id}}">
                                                <i class="fa-solid fa-eye"></i>
                                                View
                                            </button>
                                            <button request-type="product" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-product-modal-{{$product->id}}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </button>
                                            <button request-type="product" id="{{$product->id}}" type="button" class="btn btn-danger btn-delete-product" data-target="{{ucfirst($product->name)}}">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>Add Product</strong>
                    </div>
                    <div class="card-body">
                        
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-6 mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control product-input rounded" name="product_name">
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <label for="category" class="form-label">Category</label>
                                    <select id="category" class="form-control product-input product_category rounded" name="product_category" multiple="multiple" placeholder="-----">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea id="desc" class="form-control product-input rounded" name="product_desc" rows="5"></textarea>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input id="price" type="number" class="form-control product-input rounded" name="product_price">
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input id="stock" type="number" class="form-control product-input rounded" name="product_stock">
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <label for="image" class="form-label">Image</label>
                                    <input id="image" style="border: 1px solid black;" class="form-control product-input" type="file" name="product_image">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <button request-type="product" type="button" class="btn btn-success btn-save-product">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- MODALS -->
    @foreach($products as $product)
        <!-- VIEW MODAL -->
        <div class="modal fade" id="view-product-modal-{{$product->id}}" tabindex="-1" aria-labelledby="product-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="category-modal-lable">View Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <div class="card">
                        <img src="{{asset('storage/'.$product->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h2 class="card-title">{{ucfirst($product->name)}}</h2>
                            <ul>
                                <li>Price: {{$product->price}}</li>
                                <li>Stock: {{$product->stock}}</li>
                                <li>Categories:
                                    <ul>
                                        @foreach($product->pivot as $pivot)
                                            <li>{{$pivot->category->name}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>Description: {{$product->description}}</li>
                            </ul>
                        </div>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div class="modal fade" id="edit-product-modal-{{$product->id}}" tabindex="-1" aria-labelledby="product-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="category-modal-lable">Edit Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-lg-6 mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" class="form-control product-input-{{$product->id}} rounded" name="product_name" value="{{$product->name}}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="category" class="form-label">Category</label>
                                <select style="width: 100%;" id="product_category_{{$product->id}}" class="form-control product-input-{{$product->id}} rounded" name="product_category" multiple="multiple">
                                    @foreach($categories as $category)
                                        @if(count($product->pivot) == 0)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @else
                                            @foreach($product->pivot as $pivot)
                                                @if($pivot->category->id == $category->id)
                                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                @else
                                                    <!-- <option value="{{$category->id}}">{{$category->name}}</option> -->
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="desc" class="form-label">Description</label>
                                <textarea id="desc" class="form-control product-input-{{$product->id}} rounded" name="product_desc" rows="5">{{$product->description}}</textarea>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="price" class="form-label">Price</label>
                                <input id="price" type="number" class="form-control product-input-{{$product->id}} rounded" name="product_price" value="{{$product->price}}">
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="stock" class="form-label">Stock</label>
                                <input id="stock" type="number" class="form-control product-input-{{$product->id}} rounded" name="product_stock" value="{{$product->stock}}">
                            </div>

                            <div class="col-lg-12 mb-2">
                                <label for="image" class="form-label">Image</label>
                                <input id="image" style="border: 1px solid black;" class="form-control product-input-{{$product->id}}" type="file" name="product_image">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                            Close
                        </button>
                        <button request-type="product" id="{{$product->id}}" type="button" class="btn btn-outline-primary btn-edit-product">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                var id = '{{$product->id}}';
                $('#product_category_'+id).select2({
                    dropdownParent: $('#edit-product-modal-'+id),
                    width: 'resolve' 
                });
            });
        </script>
    @endforeach

</x-app-layout>
