@extends('layout.master')

@section('title', 'Shopping Cart')

@section('content')
    <div class="container my-5">
        {{-- Table Start --}}
        <table class="table table-bordered text-center">
            <thead>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="text-muted">
                        <td>{{ $product->id }}</td>
                        <td>
                            <img src="{{ $product->image }}" alt="" style="max-width:50px; max-height: 100px;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <span>1</span>
                            <span class="bg-primary px-2 py-1 rounded text-white" style="cursor: pointer">+</span>
                            <span class="bg-primary px-2 py-1 rounded text-white" style="cursor: pointer">-</span>
                        </td>
                        <td>
                            500
                        </td>
                        <td>
                            <a href="/admin/product/{{ $product->id }}/delete">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Table End --}}
    </div>
@endsection