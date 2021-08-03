<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Role;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Laratrust\Models\LaratrustRole;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        SEOMeta::setTitle('Статьи');
        SEOMeta::setDescription('Просмотр списка постов');
        $frd = $request->all();
        $posts = Post::filter($frd)->get();
//        $posts = Post::get();
        return view('crm.posts.index',compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        SEOMeta::setTitle('Новая статья');
        SEOMeta::setDescription('Страница создания новой статьи');
        return view('crm.posts.create');
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
            'name'=>'required|min:2|max:30',
        ];

        $messages = [
            'name.required'=>'Введите название статьи!',
            'name.min'=>'Название должно быть более 2 символов!',
            'name.max'=>'Название должно быть меньше 30 символов!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $frd['super']=(int) Arr::has($frd, 'super');
        $post = new Post($frd);
        $post->save();

        $file = Arr::get($frd, 'file');
        if($file instanceof UploadedFile) {
            $post->uploadFile($file);
        }

        $files = Arr::get($frd, 'files');
        if ($files !== null) {
            $post->uploadGallery($files);
        }

        return redirect()->route('crm.posts.index');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        SEOMeta::setTitle('Редактировать запись');
        SEOMeta::setDescription('Страница редактирования записи статьи');
        return view('crm.posts.edit', compact('post'));
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Post $post)
    {
        $frd = $request->all();

        $rules = [
            'name'=>'required|min:2|max:30',
        ];

        $messages = [
            'name.required'=>'Введите название статьи!',
            'name.min'=>'Имя должно быть более 2 символов!',
            'name.max'=>'Имя должно быть меньше 30 символов!',
        ];

        Validator::make($frd,$rules,$messages)->validate();

        $frd['super']=(int) Arr::has($frd, 'super');

        $post->update($frd);

        $file = Arr::get($frd, 'file');
        if($file instanceof UploadedFile) {
            $post->uploadFile($file);
        }

        $files = Arr::get($frd, 'files');
        if ($files !== null) {
            $post->uploadGallery($files);
        }

        return redirect()->route('crm.posts.index');
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('crm.posts.index');
    }
}
