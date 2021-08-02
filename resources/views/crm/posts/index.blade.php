@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>route('crm.posts.index'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
                        @include('forms._input', [
    'name'=>'search',
    'placeholder'=>'Статьи...',
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
                        <a href="{{route('crm.posts.create')}}" class="btn btn-success">
                            Создать новый статью
                        </a>
                    </div>
                </div>
                <div class="row pb-2 mt-5">
                    <div class="col-12">
                        Статьи:
                    </div>
                </div>
                <div class="row pb-2 mt-4">
                    <div class="col-1">
                        Id
                    </div>
                    <div class="col-2">
                        Название
                    </div>
                    <div class="col-3">
                        Описание
                    </div>
                    <div class="col-2">
                        Фото
                    </div>
                    <div class="col-2">
                        Публикация
                    </div>
                    <div class="col-2">
                        Действия
                    </div>
                </div>

                @forelse($posts as $post)
                    <div class="row pb-2 mt-4">
                    <div class="col-1">
                        {{$post->getKey()}}
                    </div>
                    <div class="col-3">
                        {{$post->getName()}}
                    </div>
                        <div class="col-3">
                            {{$post->getDescription()}}
                        </div>
                        <div class="col-3">
                            {{$post->getImageId()}}
                        </div>
                        <div class="col-3">
                            {{$post->getPublishedAt()}}
                        </div>
                    <div class="col-1">
                        <a href="{{route('crm.posts.edit', $post)}}" class="btn btn-success">
                            <l class="fas fa-pen"></l>
                        </a>
                    </div>
                    <div class="col-1">
                        {{Form::open(['method'=>'DELETE','url'=>route('crm.posts.destroy',$post)])}}
                        <button class="btn btn-danger">
                            <l class="fas fa-trash"></l>
                        </button>
                        {{Form::close()}}
                    </div>

                    </div>
            @empty
                <div> Постов нет </div>
            @endforelse

            </div>
        </div>
    </div>
@endsection
