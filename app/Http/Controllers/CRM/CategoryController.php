<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $categories = Category::filter($frd)->get();
        //$categories = Category::get();
        return view('crm.categories.index',compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categoryList = Category::getCategoryList();
        return view('crm.categories.create',compact('categoryList'));
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
            'name' => 'required|min:2|max:30',
        ];

        $messages = [
            'name.required' => 'Введите имя роли!',
            'name.min' => 'Имя должно быть более 2 символов!',
            'name.max' => 'Имя должно быть меньше 30 символов!',
        ];

        Validator::make($frd, $rules, $messages)->validate();

        $category = new Category($frd);
        $category->save();

        return redirect()->route('crm.categories.index');
    }

    /**
     * @param $id
     */
        public function show($id)
    {
        //
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
        public function edit(Category $category)
    {
        $categoryList = Category::getCategoryList([$category->getKey()]);
        return view('crm.categories.edit', compact('category','categoryList'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Category $category)
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

        $category->update($frd);

        return redirect()->route('crm.categories.index');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('crm.categories.index');
    }


}
