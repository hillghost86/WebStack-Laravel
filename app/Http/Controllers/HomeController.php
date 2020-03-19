<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class HomeController extends Controller
{ 
    /**
     * 新增排序功能
     */
    public function index()
    {
        $categories = Category::with(['children' => function ($query) {
            $query->orderBy('order'); //分类排序 数字越小越靠前
        }, 'sites'=> function($query){
            $query->orderBy('order','desc');   //网址排序,逆序,数字越大越靠前
        }])
            ->withCount('children')
            ->orderBy('order')
            ->get();

        return view('index')->with('categories', $categories);
    }

    public function about()
    {
        return view('about');
    }
}
