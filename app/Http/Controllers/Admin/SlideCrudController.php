<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SlideRequest as StoreRequest;
use App\Http\Requests\SlideRequest as UpdateRequest;

class SlideCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Slide');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/slide');
        $this->crud->setEntityNameStrings('slide', 'slides');

        /*
        |--------------------------------------------------------------------------
        | REORDERING
        |--------------------------------------------------------------------------
        */
        $this->crud->enableReorder('title', 1);
        $this->crud->allowAccess('reorder');
        $this->crud->orderBy('lft');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $typeArray = [
          'name' => 'type',
          'label' => "Type",
          'type' => 'select_from_array',
          'options' => ['App\Models\Film' => 'Film', 'custom' => 'Custom'],
          'allows_null' => false,
          'default' => 'film',
          'tab' => 'Link'
        ];

        $filmArray = [  // Select
          'label' => "Film",
          'type' => 'select',
          'name' => 'film_id', // the db column for the foreign key
          'entity' => 'film', // the method that defines the relationship in your Model
          'attribute' => 'title', // foreign key attribute that is shown to user
          'model' => "App\Models\Film", // foreign key model
          'tab' => 'Link'
        ];

        $activeArray = [
          'name' => 'active',
          'label' => 'Active?',
          'type' => 'checkbox',
          'tab' => 'Link'
        ];

        $activeColArray = [
          'name' => 'active',
          'label' => 'Active?',
          'type' => 'check'
        ];

        $customIntroArray = [
          'name' => 'separator',
          'type' => 'custom_html',
          'value' => '<div class="well">Values set here will override those pulled in automatically through content linking</div>',
          'tab' => 'Custom / Override'
        ];

        $headingArray = [
          'name' => 'heading',
          'label' => 'Heading',
          'type' => 'text',
          'tab' => 'Custom / Override'
        ];

        $titleArray = [
          'name' => 'title',
          'label' => 'Title',
          'type' => 'text',
        ];

        $subheadingArray = [
          'name' => 'subtitle',
          'label' => 'Subtitle',
          'type' => 'text',
          'tab' => 'Custom / Override'
        ];

        $urlArray = [
          'name' => 'url',
          'label' => 'URL',
          'type' => 'text',
          'tab' => 'Custom / Override'
        ];

        $thumbArray = [
            'name' => 'thumb',
            'label' => 'Thumbnail',
            'type' => 'image',
            'upload' => 'true',
            'hint' => 'Thumbnails may be cropped on the site',
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'crop' => true, // set to true to allow cropping, false to disable
            'tab' => 'Custom / Override'
        ];

        $this->crud->addFields([$typeArray,$filmArray,$activeArray,$customIntroArray,$headingArray,$subheadingArray,$urlArray,$thumbArray], 'both');
        $this->crud->addColumns([$titleArray,$typeArray,$activeColArray]);
    }


    public function store(StoreRequest $request)
    {
      // your additional operations before save here
      $redirect_location = parent::storeCrud($request);
      // your additional operations after save here
      // use $this->data['entry'] or $this->crud->entry
      $this->crud->entry->title = $this->crud->entry->getHeading();
      $this->crud->entry->save();

      return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
      // your additional operations before save here
      $redirect_location = parent::updateCrud($request);
      // your additional operations after save here
      // use $this->data['entry'] or $this->crud->entry
      $this->crud->entry->title = $this->crud->entry->getHeading();
      $this->crud->entry->save();
      return $redirect_location;
    }
}
