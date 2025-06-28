<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticlesModel;

class ArticleListController extends Controller
{

    public function displayArticle($slug){

        $article = ArticlesModel::where('slug', $slug)->firstOrFail();

        return view('articles.display-article', compact('article'));
    }
}


