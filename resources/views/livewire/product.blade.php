<div class="row">
    <div class="col-md-12">

        <div class="row">
            <div class="col-12">
                <div class="float-end my-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">Add Product</button>
                </div>
            </div>
        </div>

        @if (count($products) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <button type="button" class="btn btn-round btn-danger btn-sm mx-1" title="Delete Product" wire:click="$dispatch('confirmDelete',{ 'id':{{ $product->id }},'targetEvent':'product-deleted'})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-primary my-2" role="alert">
                No products available!!
            </div>
        @endif


    </div>







    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button> --}}

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addProduct" wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addProductLabel">Add Product</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="demo-form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="name">Product Name <span class="text-danger">*</span>
                                    :</label>
                                <input type="text" id="name" wire:model="name"class="form-control"
                                    name="name" />
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">

                                <label for="description">Product Description
                                    :</label>
                                <input type="text" id="description" wire:model="description"class="form-control"
                                    name="description" required />
                            </div>

                            <div class="col-12 mt-2">
                                <hr>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetFields">Close</button>
                                <button type="button" class="btn btn-primary" wire:click="saveProduct">add</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
