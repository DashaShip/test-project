<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $roles = Role::filter($frd)->get();
//        $roles = Role::get();
        return view('crm.roles.index',compact('roles'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crm.roles.create');
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
        ];

        $messages = [
            'name.required'=>'Введите имя роли!',
            'name.min'=>'Имя должно быть более 2 символов!',
            'name.max'=>'Имя должно быть меньше 30 символов!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $role = new Role($frd);
        $role->save();

        return redirect()->route('crm.roles.index');
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
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        return view('crm.roles.edit', compact('role'));
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $frd = $request->all();

        $rules = [
            'name'=>'required|min:2|max:30',
        ];

        $messages = [
            'name.required'=>'Введите имя!',
            'name.min'=>'Имя должно быть более 2 символов!',
            'name.max'=>'Имя должно быть меньше 30 символов!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $role->update($frd);

        return redirect()->route('crm.roles.index');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('crm.roles.index');
    }
}
