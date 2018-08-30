<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index($slug1,$slug2 = false)
    {
        if($slug2 == false) {
          $page = Page::where([['slug',$slug1],['parent_id',null]])->first();
        }
        else {
          $parent_page = Page::findBySlug($slug1);
          if($parent_page) {
            $page = Page::where([['slug',$slug2],['parent_id',$parent_page->id]])->first();
          }
          else {
            abort(404);
          }
        }

        if (!$page)
        {
            abort(404);
        }
        else {
          $parent_page_id = isset($page->parent_id) ? $page->parent_id : $page->id;
          $parent_page = Page::find($parent_page_id);
          $sibling_pages = Page::where('parent_id', $parent_page_id)->get();
          return view('pages.'.$page->template, compact('page', 'parent_page', 'sibling_pages'));
        }

    }
}