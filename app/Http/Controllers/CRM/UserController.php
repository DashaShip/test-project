<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        SEOMeta::setTitle('Пользователи');
        SEOMeta::setDescription('Просмотр списка пользователей');
        $frd = $request->all();
        $users = User::filter($frd)->get();
        //$users = User::get();
        return view('crm.users.index',compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        SEOMeta::setTitle('Новый пользователь');
        SEOMeta::setDescription('Страница создания нового пользователя');
        return view('crm.users.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $frd = $request->all();

        $rules = [
            'name'=>'required|min:2|max:30',
            'email'=>'required',
            'password'=>'required|min:8',
        ];

        $messages = [
            'name.required'=>'Введите имя!',
            'name.min'=>'Имя должно быть более 2 символов!',
            'name.max'=>'Имя должно быть меньше 30 символов!',
            'email.required'=>'Введите почту!',
            'password.required'=>'Введите пароль!',
            'paassword.min'=>'Пароль должен быть больше 8 сиволов!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $frd['password']=Hash::make(Arr::get($frd, 'password'));

        $user = new User($frd);
        $user->save();

        $user->syncRoles(Role::whereIn('id',Arr::get($frd, 'roles',[]))->get());

        return redirect()->route('crm.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        SEOMeta::setTitle('Редактировать запись');
        SEOMeta::setDescription('Страница редактирования записи пользователя');
        return view('crm.users.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $frd = $request->all();

        $rules = [
            'name'=>'required|min:2|max:30',
            'email'=>'required',
            'password'=>'required|min:8',
        ];

        $messages = [
            'name.required'=>'Введите имя!',
            'name.min'=>'Имя должно быть более 2 символов!',
            'name.max'=>'Имя должно быть меньше 30 символов!',
            'email.required'=>'Введите почту!',
            'password.required'=>'Введите пароль!',
            'paassword.min'=>'Пароль должен быть больше 8 сиволов!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $user->update($frd);
        $user->syncRoles(Role::whereIn('id',Arr::get($frd, 'roles',[]))->get());
        return redirect()->route('crm.users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('crm.users.index');
    }
}
