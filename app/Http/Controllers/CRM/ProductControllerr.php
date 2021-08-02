<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Models\Role;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Laratrust\Models\LaratrustRole;

class ProductControllerr extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        SEOMeta::setTitle('Продукты');
        SEOMeta::setDescription('Просмотр списка продуктов');
        $frd = $request->all();
        $products = Product::filter($frd)->get();
       // $products = Product::get();
        return view('crm.products.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        SEOMeta::setTitle('Новый продукт');
        SEOMeta::setDescription('Страница создания записи продукта');
        $categoryList = Category::getCategoryList();
        return view('crm.products.create', compact('categoryList'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $frd = $request->all();

        $rules = [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ];

        $messages = [
            'name.required'=>'Введите имя продукта!',
            'description.required'=>'Введите описание!',
            'price.required'=>'Введите цену!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $product = new Product($frd);
        $product->save();


        $file = Arr::get($frd,'file');
        if($file instanceof UploadedFile) {
            $product->uploadFile($file);
        }

        return redirect()->route('crm.products.index');
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
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        SEOMeta::setTitle('Редактировать записи');
        SEOMeta::setDescription('Страница редактирования записи продукта');
        $category = $product->getCategory();
        $categoryList = Category::getCategoryList();
        return view('crm.products.edit', compact('product', 'categoryList', 'category'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Product $product)
    {
        $frd = $request->all();
        $rules = [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ];

        $messages = [
            'name.required'=>'Введите имя продукта!',
            'description.required'=>'Введите описание!',
            'price.required'=>'Введите цену!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $product->update($frd);

        $file = Arr::get($frd,'file');
        if($file instanceof UploadedFile) {
            $product->uploadFile($file);
        }

        return redirect()->route('crm.products.index');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('crm.products.index');
    }

}
