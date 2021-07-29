@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>route('crm.categories.index'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
                        @include('forms._input', [
    'name'=>'search',
    'placeholder'=>'Категории...',
])

                    </div>
                    <div class="col-2">
                        <button class="btn btn-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    {{Form::close()}}
                </div>
                <div class="row justify-content-start">
                    <div class="col-auto">
                        <a href="{{route('crm.categories.create')}}" class="btn btn-success">
                            Создать новую категорию
                        </a>
                    </div>
                </div>
                <div class="row pb-2 mt-5">
                    <div class="col-12">
                        Список категорий
                    </div>
                </div>
                <div class="row pb-2 mt-4">
                    <div class="col-1">
                        Id
                    </div>
                    <div class="col-2">
                        Имя
                    </div>
                    <div class="col-2">
                        Ссылка
                    </div>
                    <div class="col-2">
                        Действия
                    </div>
                </div>

                @forelse($categories as $category)

                    <div class="row pb-2 mt-4">
                    <div class="col-1">
                        {{$category->getKey()}}
                    </div>
                    <div class="col-3">
                        {{$category->getName()}}
                    </div>
                        <div class="col-2">
                            {{$category->getSlug()}}
                        </div>
                    <div class="col-1">
                        <a href="{{route('crm.categories.edit', $category)}}" class="btn btn-success">
                            <l class="fas fa-pen"></l>
                        </a>
                    </div>
                    <div class="col-1">
                        {{Form::open(['method'=>'DELETE','url'=>route('crm.categories.destroy',$category)])}}
                        <button class="btn btn-danger">
                            <l class="fas fa-trash"></l>
                        </button>
                        {{Form::close()}}
                    </div>

                    </div>
            @empty
                <div> Категорий нет </div>
            @endforelse

            </div>
        </div>
    </div>
@endsection
