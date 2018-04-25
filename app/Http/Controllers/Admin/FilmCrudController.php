<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FilmRequest as StoreRequest;
use App\Http\Requests\FilmRequest as UpdateRequest;

class FilmCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Film');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/film');
        $this->crud->setEntityNameStrings('film', 'films');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $titleArray = [   // Browse
          'name' => 'title',
          'label' => 'Title',
          'type' => 'text',
          'attributes' => [
            'class' => 'form-control input-lg'
          ],
          'tab' => 'Film details'
        ];

        $descriptionArray = [   // Browse
          'name' => 'description',
          'label' => 'Description',
          'type' => 'quill',
          'tab' => 'Film details'
        ];

        $certificateArray = [   // Browse
          'name' => 'certificate',
          'label' => 'Certificate',
          'type' => 'text',
          'tab' => 'Film details'
        ];

        $runtimeArray = [   // Browse
          'name' => 'runtime',
          'label' => 'Runtime',
          'type' => 'text',
          'tab' => 'Film details'
        ];

        $directorArray = [   // Browse
          'name' => 'director',
          'label' => 'Director',
          'type' => 'text',
          'tab' => 'Film details'
        ];

        $countryArray = [   // Browse
          'name' => 'country',
          'label' => 'Country',
          'type' => 'text',
          'tab' => 'Film details'
        ];

        $starringArray = [   // Browse
          'name' => 'starring',
          'label' => 'Starring',
          'type' => 'text',
          'tab' => 'Film details'
        ];

        $languageArray = [   // Browse
          'name' => 'language',
          'label' => 'Language',
          'type' => 'text',
          'tab' => 'Film details'
        ];

        $screeningsArray = [
          'name' => 'screenings',
          'label' => 'Screenings',
          'type' => 'add-screenings',
          'tab' => 'Screenings'
        ];

        $thumbArray = [   // Browse
            'name' => 'thumb',
            'label' => 'Thumbnail',
            'type' => 'image',
            'upload' => 'true',
            'hint' => 'Thumbnails may be cropped on the site',
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'crop' => true, // set to true to allow cropping, false to disable
            'tab' => 'Film details'
        ];

        $this->crud->addFields([$titleArray,$certificateArray,$runtimeArray,$directorArray,$countryArray,$starringArray,$languageArray,$thumbArray,$screeningsArray,$descriptionArray], 'both');

        $this->crud->addColumns([$titleArray]);


    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $request['slug'] = str_slug($request->title);
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $request['slug'] = str_slug($request->title);
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
