<?php

namespace App\Livewire;

use App\Models\Product as ProductModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Product extends Component
{

    // add the properties for input fields
    #[Rule('required|min:5')]
    public $name = '';
    #[Rule('required|min:10')]
    public $description = '';

    public function render()
    {
        return view('livewire.product',['products' => ProductModel::all()]);
    }

    // add new product
    public function saveProduct()
    {

        // validate the data
        $validatedData = $this->validate();

        // add new record
        ProductModel::create($validatedData);

        $this->resetFields();

        $this->dispatch('closeModal','addProduct');

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => "Product Added Successfully!!",
        ]);

    }


    public function resetFields()
    {

        $this->name = '';
        $this->description = '';

        $this->resetValidation();

    }

    #[On('product-deleted')]
    public function deleteProduct($id)
    {

            ProductModel::find($id)->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => "Product deleted Successfully!!",
            ]);
    }


}
