<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Category Management') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <strong>Category Table</strong>
                    </div>
                    <div class="card-body text-center">
                        <table class="table table-striped category-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-category-modal-{{$category->id}}">
                                            <i class="fa-regular fa-eye"></i>
                                            View
                                        </button> -->
                                        <button request-type="category" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-category-modal-{{$category->id}}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                        </button>
                                        <button request-type="category" id="{{$category->id}}" type="button" class="btn btn-danger btn-delete-category">
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
                    <div class="card-header">
                        <strong>Add Category</strong>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12 mb-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control rounded category-input" name="category_name">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button request-type="category" type="button" class="btn btn-success btn-save-category">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALS -->
    @foreach($categories as $category)
        <!-- EDIT MODAL -->
        <div class="modal fade" id="edit-category-modal-{{$category->id}}" tabindex="-1" aria-labelledby="category-modal-lable" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="category-modal-lable">Edit Product Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-lg-12 mb-2">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="category_name" class="form-control rounded category-input-{{$category->id}}" value="{{$category->name}}">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                            Close
                        </button>
                        <button request-type="category" id="{{$category->id}}" type="button" class="btn btn-outline-primary btn-edit-category">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
