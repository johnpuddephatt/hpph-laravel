<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

    private function standard()
    {

        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Meta'
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Meta'
                    ]);
        $this->crud->addField([
                        'name' => 'meta_keywords',
                        'type' => 'textarea',
                        'label' => trans('backpack::pagemanager.meta_keywords'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Meta'
                    ]);
        $this->crud->addField([
                        'name' => 'content',
                        'label' => trans('backpack::pagemanager.content'),
                        'type' => 'quill',
                        'placeholder' => trans('backpack::pagemanager.content_placeholder'),
                        'tab' => 'Content',
                        'toolbar' => "[{ 'header': '2' }],['bold', 'italic'],['image','link','video'],[{ 'list': 'bullet' }]"
                    ]);
        $this->crud->addField([
                        'name' => 'thumb',
                        'label' => 'Thumbnail',
                        'type' => 'image',
                        'upload' => 'true',
                        'hint' => 'Thumbnails may be cropped on the site',
                        'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
                        'crop' => true, // set to true to allow cropping, false to disable
                        'tab' => 'Content'
                    ]);
    }

    private function simple()
    {
        $this->crud->addField([
                        'name' => 'content',
                        'label' => trans('backpack::pagemanager.content'),
                        'type' => 'quill',
                        'toolbar' => "['bold', 'italic'],['image','link','video'],[{ 'list': 'bullet' }]",
                        'placeholder' => trans('backpack::pagemanager.content_placeholder'),
                    ]);
    }
}
