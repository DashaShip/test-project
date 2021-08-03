<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class SitePostController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Post $post)
    {
        SEOMeta::setTitle('Статьи');
        SEOMeta::setDescription('Просмотр страницы со статьями');
        $posts = Post::get();
        return view('site.site-posts', compact('posts'));
    }

    public function show(Post $post)
    {
        SEOMeta::setTitle($post->getName());
        SEOMeta::setDescription($post->getDescription());
        return view('site.site-posts', compact('post'));
    }

}
