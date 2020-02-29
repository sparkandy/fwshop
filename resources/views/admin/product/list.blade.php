@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
             <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                   @include('admin.include.sidemenu')
                </div>
               

            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of Products</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Color</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->color }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td><a href="#">Edit Product</a> |  <a href="#">View Product</a></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
