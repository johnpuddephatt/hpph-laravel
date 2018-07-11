<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index($slug1,$slug2 = '')
    {
        if(!$slug2) {
          $page = Page::where([['slug',$slug1],['parent_id',null]])->first();

        }
        else {

          $parent_page = Page::findBySlug($slug1);

          $page = Page::where([['slug',$slug2],['parent_id',$parent_page->id]])->first();

        }
        $parent_page_id = $page->parent_id ? $page->parent_id : $page->id;
        $parent_page = Page::find($parent_page_id);
        $sibling_pages = Page::where('parent_id', $parent_page_id)->get();
        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }
        return view('pages.'.$page->template, compact('page', 'parent_page', 'sibling_pages'));
    }
}