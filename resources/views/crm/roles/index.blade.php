@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>route('crm.roles.index'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
                        @include('forms._input', [
    'name'=>'search',
    'placeholder'=>'Роли...',
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
                        <a href="{{route('crm.roles.create')}}" class="btn btn-success">
                            Создать новую роль
                        </a>
                    </div>
                </div>
                <div class="row pb-2 mt-5">
                    <div class="col-12">
                        Список ролей
                    </div>
                </div>
                <div class="row pb-2 mt-4">
                    <div class="col-1">
                        Id
                    </div>
                    <div class="col-2">
                        Имя
                    </div>
                    <div class="col-3">
                        Полное имя
                    </div>
                    <div class="col-3">
                        Описание
                    </div>
                    <div class="col-3">
                        Действия
                    </div>
                </div>

                @forelse($roles as $role)

                    <div class="row pb-2 mt-4">
                    <div class="col-1">
                        {{$role->getKey()}}
                    </div>
                    <div class="col-3">
                        {{$role->getName()}}
                    </div>
                        <div class="col-3">
                            {{$role->getDisplayName()}}
                        </div>
                        <div class="col-3">
                            {{$role->getDescription()}}
                        </div>
                    <div class="col-1">
                        <a href="{{route('crm.roles.edit', $role)}}" class="btn btn-success">
                            <l class="fas fa-pen"></l>
                        </a>
                    </div>
                    <div class="col-1">
                        {{Form::open(['method'=>'DELETE','url'=>route('crm.roles.destroy',$role)])}}
                        <button class="btn btn-danger">
                            <l class="fas fa-trash"></l>
                        </button>
                        {{Form::close()}}
                    </div>

                    </div>
            @empty
                <div> Пользователей нет </div>
            @endforelse

            </div>
        </div>
    </div>
@endsection
