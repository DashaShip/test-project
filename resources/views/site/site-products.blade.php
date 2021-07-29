@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>route('crm.products.index'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
                        @include('forms._input', [
    'name'=>'search',
    'placeholder'=>'Продукты...',
])
                    </div>
                    <div class="col-2">
                        <button class="btn btn-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    {{Form::close()}}
                </div>

                <div class="row pb-2 mt-5">
                    <div class="col-12">
                        Список продуктов
                    </div>
                </div>


                <div class="row pb-2 mt-4">
                @forelse($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="card" style="width: 15rem;">
                                <img src="{{$product-> getImagePath()}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->getName()}}</h5>
                                    <p class="card-text">{{$product->getDescription()}}</p>
                                    <p class="card-price">{{$product->getPrice()}}</p>
                                    <a href="#" class="btn btn-primary">В корзину</a>
                                </div>
                            </div>
                        </div>
                @empty
                @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
