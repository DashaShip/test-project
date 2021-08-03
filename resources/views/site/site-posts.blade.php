@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>url('/posts'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
    @include('forms._input', [
'name'=>'search',
'placeholder'=>'Поиск статьи...',
])
                    </div>
                    <div class="col-2">
                        <button class="btn btn-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    {{Form::close()}}
                </div>

                <div class="row">
    @forelse($posts as $post)
        @if ($post->isSuper() === true)
                            <div class="col-12">
                                <div class="card mb-3 text-white bg-dark">
                                    <img src="{{$post->getImagePath()}}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$post->getName()}}</h5>
                                            <p class="card-text">{{$post->getDescription()}}</p>
                                            <p class="card-text"><small class="text-muted"> {{$post->getPublishedAt()}}</small></p>
                                            <a href="#" class="btn btn-primary">Смотреть</a>
                            </div>
                        </div>
                </div>
        @else
                            <div class="col-sm-6">
                                 <div class="card text-white bg-dark">
                                     <div class="card-body">
                                        <img src="{{$post->getImagePath()}}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$post->getName()}}</h5>
                                            <p class="card-text">{{$post->getDescription()}}</p>
                                            <p class="card-text"><small class="text-muted"> {{$post->getPublishedAt()}}</small></p>
                                            <a href="#" class="btn btn-primary">Смотреть</a>
                                        </div>
                                     </div>
                                </div>
                            </div>
        @endif
    @empty
    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
