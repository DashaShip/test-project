@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>route('crm.users.index'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
                        @include('forms._input', [
    'name'=>'search',
    'placeholder'=>'Пользователь...',
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
                        <a href="{{route('crm.users.create')}}" class="btn btn-success">
                            Создать нового пользователя
                        </a>
                    </div>
                </div>
                <div class="row pb-2 mt-5">
                    <div class="col-12">
                        Список пользователей
                    </div>
                </div>
                <div class="row pb-2 mt-4">
                    <div class="col-1">
                        Id
                    </div>
                    <div class="col-5">
                        Имя пользователя
                    </div>
                    <div class="col-4">
                        Email
                    </div>
                    <div class="col-2">
                        Действия
                    </div>
                </div>

                @forelse($users as $user)

                    <div class="row pb-2 mt-4">
                    <div class="col-1">
                        {{$user->getKey()}}
                    </div>
                    <div class="col-5">
                        {{$user->getName()}}
                    </div>
                        <div class="col-4">
                            {{$user->getEmail()}}
                        </div>
                    <div class="col-1">
                        <a href="{{route('crm.users.edit', $user)}}" class="btn btn-success">
                            <l class="fas fa-pen"></l>
                        </a>
                    </div>
                    <div class="col-1">
                        {{Form::open(['method'=>'DELETE','url'=>route('crm.users.destroy',$user)])}}
                        <button class="btn btn-danger">
                            <l class="fas fa-trash"></l>
                        </button>
                        {{Form::close()}}
                    </div>

                    </div>
            @empty
                <div> Пользователей нету </div>
            @endforelse

            </div>
        </div>
    </div>
@endsection
