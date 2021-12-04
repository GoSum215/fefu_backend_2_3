<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getList()
    {
        $news = News::query()
            ->where('published_at', '<=', 'NOW')
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(5);
        return view('news_list', ['news' => $news]);
    }
    public function getDetails(string $slug)
    {
        $newsItem = News::query()
            ->where('slug', $slug)
            ->where('published_at', '<=', 'NOW')
            ->where('is_published', true)
            ->first();
        if($newsItem === null) {
            abort(404);
        }
        return view('news_item', ['newsItem' => $newsItem]);
    }
}
