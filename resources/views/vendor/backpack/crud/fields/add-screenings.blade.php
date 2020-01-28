<!-- select -->

<div @include('crud::inc.field_wrapper_attributes') >


@if (!$crud->entry)
 <div class="alert alert-warning">This is a new item. Please save before adding screenings.</div>
@else
  <div class="error"></div>
  <table class="table table-striped" id="screenings-table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Box office</th>
        <th>Tags</th>
        <th></th>
      </tr>
      <tr>
        <td><input type="date" class="form-control" id="newScreeningDate" name="newScreeningDate"
            placeholder="Enter date"></td>
        <td><input type="time" class="form-control" id="newScreeningTime" name="newScreeningTime"
            placeholder="Enter time"></td>
        <td><input type="text" class="form-control" id="newScreeningUrl" name="newScreeningUrl"
            placeholder="Enter ID"></td>
        <td>
          <select multiple id="newScreeningTags" name="newScreeningTags" class="form-control select2_multiple">
            @foreach(\App\Models\Tag::get() as $tag)
              <option form-control select2_multiple value="{{ $tag->id }}">{{ $tag->title }}</option>
            @endforeach
          </select>
        </td>
            <td>
              <button class="btn btn-primary  btn-block" id="screening-add">
                  <span class="glyphicon glyphicon-plus"></span> Add
              </button>
            </td>
      </tr>
    </thead>
    <tbody>
      @foreach ($crud->entry->screenings->sortBy('time')->sortBy('date') as $screening)
        <tr data-id="{{$screening->id}}">
          <td>{{ Carbon\Carbon::parse($screening->date)->format('d/m/Y') }}</td>
          <td>{{$screening->time}}</td>
          <td>{{$screening->url}}</td>
          <td>
            @foreach ($screening->tags as $tag)
              <span class="label label-info">{{ $tag->title }}</span>
            @endforeach
          </td>
          <td><a href="/admin/screening/{{$screening->id}}/edit" class="screening-edit btn btn-xs btn-block btn-default" data-id="{{$screening->id}}" ><span class="glyphicon glyphicon-edit"></span> Edit</a> <button class="screening-delete btn btn-xs btn-block btn-danger" data-id="{{ $screening->id }}"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
        </tr>
      @endforeach
    </tbody>

  </table>



{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType(['type'=>'select2_multiple','name'=>'screenings'], $fields))
  @push('crud_fields_styles')
      <!-- include select2 css-->
      <link href="{{ asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
  @endpush
  @push('crud_fields_scripts')
    <!-- include select2 js-->
    <script src="{{ asset('vendor/adminlte/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script>
      jQuery(document).ready(function($) {
        // trigger select2 for each untriggered select2_multiple box
        $('.select2_multiple').each(function (i, obj) {
          if (!$(obj).hasClass("select2-hidden-accessible"))
          {
            var $obj = $(obj).select2({
              theme: "bootstrap"
            });

            var options = [];
            @if (isset($field['model']))
              @foreach ($field['model']::all() as $connected_entity_entry)
                options.push({{ $connected_entity_entry->getKey() }});
              @endforeach
            @endif

            @if(isset($field['select_all']) && $field['select_all'])
              $(obj).parent().find('.clear').on("click", function () {
                $obj.val([]).trigger("change");
              });
              $(obj).parent().find('.select_all').on("click", function () {
                $obj.val(options).trigger("change");
              });
            @endif
          }
        });
      });
    </script>
  @endpush
@endif


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

  @push('crud_fields_styles')
      <!-- include select2 css-->

      <style>
      #screenings-table td,
      #screenings-table th {
        padding: 8px 4px 4px 0;
      }

      #newScreeningDate {
        width: 11.5em;
      }
      #newScreeningTime {
        width: 6.5em;
      }
      #newScreeningUrl {
        width: 6.5em;
      }
      </style>
  @endpush

  {{-- FIELD JS - will be loaded in the after_scripts section --}}
  @push('crud_fields_scripts')

    <script>
      $("#screening-add").click(function(e) {
        e.preventDefault();
        var data = {
          '_token': $('input[name=_token]').val(),
          'film_id': '{{$crud->entry->id}}',
          'date': $('input[name=newScreeningDate]').val(),
          'time': $('input[name=newScreeningTime]').val(),
          'url': $('input[name=newScreeningUrl]').val(),
          'tags': $('select[name=newScreeningTags]').val(),
        }

        $.ajax({
          type: 'post',
          url: '/admin/screening/add',
          data: data,
          success: function(data) {
              if ((data.errors)) {
                  $('.error').removeClass('hidden');
                  $('.error').empty();
                  var message = `<div class="alert alert-warning"><strong>Screening could not be added:</strong><ul>`;
                  for(var key in data.errors) {
                    var o = data.errors[key];
                    message += `<li>${o}</li>`;
                  }
                  message += `</ul></div>`;
                  $('.error').append(message);

                  new PNotify({
                    title: "Error",
                    text: "An error has occured",
                    type: "error"
                  });
              } else {
                  $('.error').remove();
                  var formattedDate = new Date(data.date);
                  var tags = '';
                  if(data.tags) {
                    for (var i = 0; i < data.tags.length; i++) {
                      tags += `<span class="label label-info">${data.tags[i]}</span> `;
                    }
                  };
                  var output = `
                  <tr data-id='${data.id}'>
                    <td>${formattedDate.getDate()}/${formattedDate.getMonth() + 1}/${formattedDate.getFullYear()}</td>
                    <td class="col-md-3">${data.time}</td>
                    <td class="col-md-3">${data.url}</td>
                    <td class="col-md-3">${tags}</td>
                    <td><a href="/admin/screening/${data.id}/edit" class='screening-edit btn btn-xs btn-block btn-default' data-id='${data.id}'><span class='glyphicon glyphicon-edit'></span> Edit</a> <button class='screening-delete btn btn-xs btn-block btn-danger' data-id='${data.id}'><span class='glyphicon glyphicon-trash'></span> Delete</button></td>
                  </tr>"`;
                  $('#screenings-table tbody').prepend(output);
                  new PNotify({
                    title: "Success",
                    text: "Screening successfully added",
                    type: "success"
                  });
              }
          },
        });
      });


      $("#screenings-table").on('click','.screening-delete',function(e) {
        if (confirm("Are you sure you want to delete?")) {

        }
        else {
          return;
        }
        e.preventDefault();
        var deleteTargetId = this.dataset.id;
        $.ajax({
          type: 'post',
          url: '/admin/screening/delete',
          data: {
            '_token': $('input[name=_token]').val(),
            'id': deleteTargetId
          },
          success: function(data) {
            var deleteTargetNode = document.querySelector('[data-id="' + deleteTargetId + '"]');
            if ((data.errors)) {
              new PNotify({
                title: "Error deleting",
                text: data.errors,
                type: "error"
              });
            }
            else {
              deleteTargetNode.parentNode.removeChild(deleteTargetNode);
              new PNotify({
                title: "Success",
                text: "Screening successfully deleted",
                type: "success"
              });
            }
          }
        });
      });

    </script>
  @endpush
@endif
@endif
</div>