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

        // $this->crud->setDefaultPageLength(0); // number of rows shown in table view

        $this->crud->enableExportButtons();

        // $this->crud->enableBulkActions();
        // $this->crud->addBulkDeleteButton();

        $this->crud->addFilter([
          'type' => 'simple',
          'name' => 'futureScreenings',
          'label'=> 'Current only'
        ],
        false,
        function() { // if the filter is active
          $this->crud->addClause('hasFutureScreenings'); // apply the "hasFutureScreenings" eloquent scope
        });

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
          'tab' => 'Overview',
          'searchLogic' => function ($query, $column, $searchTerm) {
            $terms = explode(',',$searchTerm);
            foreach ($terms as $term) {
              if($term != null) {
                $query->orWhere('title', 'like', '%'.trim($term).'%');
              }
            }
          }
        ];

        $slugArray = [
          'name' => 'slug',
          'label' => 'Film slug',
          'type' => 'text',
          'tab' => 'Overview',
          'hint' => 'Leave blank to generate automatically. Changing this will break existing URLs.'
        ];

        $subtitleArray = [
          'name' => 'subtitle',
          'label' => 'Event subtitle',
          'type' => 'text',
          'tab' => 'Overview'
        ];

        $altLanguageTitleArray = [
          'name' => 'alt_language_title',
          'label' => 'Alternative language title',
          'type' => 'text',
          'tab' => 'Overview'
        ];

        $venueArray = [
          'label' => "Venue",
          'type' => 'select2',
          'name' => 'venue_id', // the method that defines the relationship in your Model
          'entity' => 'venue', // the method that defines the relationship in your Model
          'attribute' => 'title', // foreign key attribute that is shown to user
          'model' => "App\Models\Venue", // foreign key model
          'tab' => 'Overview'
        ];

        $descriptionArray = [
          'name' => 'description',
          'label' => 'Description',
          'type' => 'quill',
          'tab' => 'Overview',
          'toolbar' => "[{ 'header': '3' }],['bold', 'italic'],['image','link','video'],[{ 'list': 'bullet' }]"
        ];

        $shortDescriptionArray = [
          'name' => 'short_description',
          'label' => 'Short description',
          'type' => 'textarea',
          'tab' => 'Overview'
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
          'type' => 'select_from_array',
          'options' => ['0' => 'No','1' => 'Single','3' => 'Triple'],
          'allows_null' => false,
          'default' => '0',
          'tab' => 'Details'
        ];

        $runtimeArray = [
          'name' => 'runtime',
          'label' => 'Runtime',
          'type' => 'text',
          'tab' => 'Details',
          'suffix' => 'minutes',
        ];

        $reviewsArray = [
          'name' => 'reviews',
          'label' => 'Reviews',
          'type' => 'table',
          'tab' => 'Overview',
          'entity_singular' => 'review', // used on the "Add X" button
          'columns' => [
              'text' => 'Review',
              'author' => 'Author',
              'rating' => 'Rating (1-5)',
              'url' => 'URL'
          ],
          'max' => 4, // maximum rows allowed in the table
          'min' => 0, // minimum rows allowed in the table
        ];

        $trailerDurationArray = [
          'name' => 'trailer_duration',
          'label' => 'Trailer duration',
          'type' => 'text',
          'tab' => 'Screenings',
          'suffix' => 'minutes',
          'hint' => 'Use this to override the default trailer duration, which is used to calculate screening end times.'
        ];

        $customComingSoonArray = [
          'name' => 'custom_coming_soon',
          'label' => 'Custom coming soon message',
          'type' => 'text',
          'tab' => 'Screenings',
          'hint' => 'Use this to override the default coming soon message, shown on films which have had no screenings added.'
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
          'tab' => 'Screenings',
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

        $trailerArray = [
          'name' => 'trailer',
          'type' => 'video',
          'label' => 'Trailer',
          'hint' => 'Link to YouTube or Vimeo',
          'tab' => 'Overview'
        ];

        $embedArray = [
          'name' => 'embed',
          'label' => 'Embed code',
          'type' => 'textarea',
          'tab' => 'Overview',
          'hint' => 'Enter embed code for custom players etc. Will appear below film description.',
        ];

        $dateCol = [
          'name' => 'created_at',
          'label' => 'Date created',
          'type' => 'datetime',
        ];

        $strandArray = [
          'label' => "Strand",
          'type' => 'select2_multiple',
          'name' => 'strands', // the method that defines the relationship in your Model
          'entity' => 'strands', // the method that defines the relationship in your Model
          'attribute' => 'title', // foreign key attribute that is shown to user
          'model' => "App\Models\Strand", // foreign key model
          'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
          'tab' => 'Overview'
        ];

        $seasonArray = [
          'label' => "Season",
          'type' => 'select2_multiple',
          'name' => 'seasons', // the method that defines the relationship in your Model
          'entity' => 'seasons', // the method that defines the relationship in your Model
          'attribute' => 'title', // foreign key attribute that is shown to user
          'model' => "App\Models\Season", // foreign key model
          'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
          'tab' => 'Overview'
        ];

        $audioDescriptionArray = [
          'name' => 'audio_description',
          'label' => 'Audio description',
          'type' => 'checkbox',
          'tab' => 'Screenings'
        ];

        $freeArray = [
          'name' => 'free',
          'label' => 'Free',
          'type' => 'checkbox',
          'tab' => 'Screenings'
        ];

        // $screeningsCol  = [
        //   'name' => 'screenings_count',
        //   'label' => 'Screenings',
        //   'orderable' => false,
        //   'type' => 'closure',
        //   'function' => function($entry) {
        //     return $entry->screenings->count();
        //   }
        // ];

        $this->crud->addFields([$titleArray,$slugArray,$venueArray,$subtitleArray,$altLanguageTitleArray,$strandArray,$seasonArray,$certificateArray,$runtimeArray,$directorArray,$countryArray,$starringArray,$languageArray,$thumbArray,$trailerArray,$embedArray,$screeningsArray,$trailerDurationArray,$customComingSoonArray,$shortDescriptionArray,$descriptionArray,$reviewsArray,$fRatingArray,$yearArray,$associationArray,$formatArray,$ticketsArray,$audioDescriptionArray,$freeArray], 'both');

        $this->crud->addColumns([$titleArray,$dateCol]);

        if (!$this->request->has('order')) {
          $this->crud->orderBy('title');
        }
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        if(!$request->slug) {
          $request['slug'] = str_slug($request->title);
        }
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        \Cache::forget('homeSlides');
        \Cache::forget('searchData');

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        \Cache::forget('homeSlides');
        \Cache::forget('searchData');
        return $redirect_location;
    }

}


