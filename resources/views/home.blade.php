@extends('layout.master')
@section('title','Home')
@section('content')
    <div class="container my-5">
        <h1 class="text-info">Featured</h1>
        <div class="row mb-5">
            @foreach ($feature_products as $feature_product)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $feature_product->name }}
                        </div>
                        <div class="card-block">
                            <img src="{{ $feature_product->image }}" alt="">
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <span>${{ $feature_product->price }}</span>
                                <button class="btn btn-info btn-sm" onclick="addToCart('{{ $feature_product->id }}')">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h1 class="text-info">Most Popular</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $product->name }}
                        </div>
                        <div class="card-block">
                            <img src="{{ $product->image }}" alt="">
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <span>${{ $product->price }}</span>
                                <button class="btn btn-info btn-sm" onclick="addToCart('{{ $product->id }}')">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center mt-3">
            {!! $pages !!}
        </div>
    </div>
@endsection

@section('script')
  <script>
    function goToCartPage(){
        $.ajax({
          type: 'POST',
          url : '/cart',
          data: {
            cart: getCartItem()
          }
        }).done(function(response) {
          clearCartItem();
          window.location.href = "/cart";
        }).fail(function(response) {
          console.log(response);
        });
    }

    function addToCart(num){
        var ary = JSON.parse(localStorage.getItem("items"))
        if(ary == null){
            var itemAry = [num];
            localStorage.setItem("items", JSON.stringify(itemAry));
        }else{
            let con = ary.indexOf(num);
            
            if(con == -1){
                ary.push(num);
                localStorage.setItem("items", JSON.stringify(ary));
            }
        }

        $("#cart-count").html(getCartItem().length);
    }

    function getCartItem(){
        let ary = JSON.parse(localStorage.getItem("items"));
        return ary;
    }

    function clearCartItem(){
        localStorage.removeItem("items");
    }

  </script>
@endsection