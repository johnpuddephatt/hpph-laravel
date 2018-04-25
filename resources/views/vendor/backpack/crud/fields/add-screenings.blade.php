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
        <th>Jack-Roe ID</th>
        <th>Labels</th>
        <th></th>
      </tr>
      <tr>
        <td><input type="date" class="form-control" id="newScreeningDate" name="newScreeningDate"
            placeholder="Enter date"></td>
        <td><input type="time" class="form-control" id="newScreeningTime" name="newScreeningTime"
            placeholder="Enter time"></td>
        <td><input type="text" class="form-control" id="newScreeningUrl" name="newScreeningUrl"
            placeholder="Enter ID"></td>
        <td><input type="text" class="form-control" id="newScreeningLabels" name="newScreeningLabels"
            placeholder="Labels"></td>
            <td>
              <button class="btn btn-primary  btn-block" id="screening-add">
                  <span class="glyphicon glyphicon-plus"></span> Add
              </button>
            </td>
      </tr>
    </thead>
    <tbody>

      @foreach (App\Models\Screening::where('film_id',$crud->entry->id)->orderBy('date', 'ASC')->get() as $screening)
        <tr data-id="{{$screening->id}}">
          <td>{{ Carbon\Carbon::parse($screening->date)->format('d/m/Y') }}</td>
          <td>{{$screening->time}}</td>
          <td>{{$screening->url}}</td>
          <td>
            @foreach ($screening->labels() as $label)
              {{ $label }},<br/>
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
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    {{-- @push('crud_fields_styles')
        {{-- YOUR CSS HERE --}}
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- YOUR JS HERE --}}


    <script>
      $("#screening-add").click(function(e) {
        e.preventDefault();
        var data = {
          '_token': $('input[name=_token]').val(),
          'film_id': '{{$crud->entry->id}}',
          'date': $('input[name=newScreeningDate]').val(),
          'time': $('input[name=newScreeningTime]').val(),
          'url': $('input[name=newScreeningUrl]').val(),
          'labels': $('input[name=newScreeningLabels]').val(),
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
                  var labels = data.labels.split(",").join(",<br/>");
                  var output = `
                  <tr data-id='${data.id}'>
                    <td>${formattedDate.getDate()}/${formattedDate.getMonth() + 1}/${formattedDate.getFullYear()}</td>
                    <td class="col-md-3">${data.time}</td>
                    <td class="col-md-3">${data.url}</td>
                    <td class="col-md-3">${labels}</td>
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