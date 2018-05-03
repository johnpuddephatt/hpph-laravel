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

        $titleArray = [
          'name' => 'title',
          'label' => 'Title',
          'type' => 'text',
          'attributes' => [
            'class' => 'form-control input-lg'
          ],
          'tab' => 'Overview'
        ];

        $subtitleArray = [
          'name' => 'subtitle',
          'label' => 'Subtitle',
          'type' => 'text',
          'tab' => 'Overview'
        ];

        $descriptionArray = [
          'name' => 'description',
          'label' => 'Description',
          'type' => 'quill',
          'tab' => 'Overview',
          'toolbar' => "['bold', 'italic'],['image','link','video'],[{ 'list': 'bullet' }]"
        ];

        $certificateArray = [
          'name' => 'certificate',
          'label' => 'Certificate',
          'type' => 'text',
          'tab' => 'Details',
        ];

        $yearArray = [
          'name' => 'year',
          'label' => 'Year',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $associationArray = [
          'name' => 'association',
          'label' => 'Association',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $formatArray = [
          'name' => 'format',
          'label' => 'Format',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $fRatingArray = [
          'name' => 'f_rating',
          'label' => 'F-Rating',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $runtimeArray = [
          'name' => 'runtime',
          'label' => 'Runtime',
          'type' => 'text',
          'tab' => 'Details',
          'suffix' => 'minutes',
        ];

        $directorArray = [
          'name' => 'director',
          'label' => 'Director',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $countryArray = [
          'name' => 'country',
          'label' => 'Country',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $starringArray = [
          'name' => 'starring',
          'label' => 'Starring',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $ticketsArray = [
          'name' => 'tickets',
          'label' => 'Tickets',
          'type' => 'quill',
          'tab' => 'Details',
          // 'toolbar' => "[{ header: [1, 2, false] }],['bold', 'italic']"
          'toolbar' => "['bold', 'italic'],['link'],[{ 'list': 'bullet' }]"
        ];

        $languageArray = [
          'name' => 'language',
          'label' => 'Language',
          'type' => 'text',
          'tab' => 'Details'
        ];

        $screeningsArray = [
          'name' => 'screenings',
          'label' => 'Screenings',
          'type' => 'add-screenings',
          'tab' => 'Screenings'
        ];

        $thumbArray = [
            'name' => 'thumb',
            'label' => 'Thumbnail',
            'type' => 'image',
            'upload' => 'true',
            'hint' => 'Thumbnails may be cropped on the site',
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'crop' => true, // set to true to allow cropping, false to disable
            'tab' => 'Overview'
        ];

        $this->crud->addFields([$titleArray,$subtitleArray,$certificateArray,$runtimeArray,$directorArray,$countryArray,$starringArray,$languageArray,$thumbArray,$screeningsArray,$descriptionArray,$fRatingArray,$yearArray,$associationArray,$formatArray,$ticketsArray], 'both');

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
