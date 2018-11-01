<!-- select from array -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <select
        name="{{ $field['name'] }}@if (isset($field['allows_multiple']) && $field['allows_multiple']==true)[]@endif"
        @include('crud::inc.field_attributes')
        @if (isset($field['allows_multiple']) && $field['allows_multiple']==true)multiple @endif
        >

        @if (isset($field['allows_null']) && $field['allows_null']==true)
            <option value="">-</option>
        @endif

        @if (count($field['options']))
            @foreach ($field['options'] as $key => $value)
                @if((old($field['name']) && (
                        $key == old($field['name']) ||
                        (is_array(old($field['name'])) &&
                        in_array($key, old($field['name']))))) ||
                        (null === old($field['name']) &&
                            ((isset($field['value']) && (
                                        $key == $field['value'] || (
                                                is_array($field['value']) &&
                                                in_array($key, $field['value'])
                                                )
                                        )) ||
                                (isset($field['default']) &&
                                ($key == $field['default'] || (
                                                is_array($field['default']) &&
                                                in_array($key, $field['default'])
                                            )
                                        )
                                ))
                        ))
                    <option data-target="{{ strtolower($value) }}" value="{{ $key }}" selected>{{ $value }}</option>
                @else
                    <option  data-target="{{ strtolower($value) }}" value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- select_template crud field JS -->
        <script>

        var selectBox_{{ $field['name'] }} = document.querySelector('select[name="{{ $field['name'] }}"]');
        var siblings_{{ $field['name'] }} = document.querySelectorAll('select');

        function showBox(targetName) {
          var target = document.querySelector('select[name="' + targetName + '_id"]');
          for(var i = 0; i < siblings_{{ $field['name'] }}.length; i++ ) {
            siblings_{{ $field['name'] }}[i].parentNode.hidden = true;
          }
          if(target) {
            target.parentNode.hidden = false;
          }
          selectBox_{{ $field['name'] }}.parentNode.hidden = false;
        }
        //Initial load
        showBox(selectBox_{{ $field['name'] }}.selectedOptions[0].dataset.target);
        // Update on change
        selectBox_{{ $field['name'] }}.addEventListener('change',()=>{
          showBox(selectBox_{{ $field['name'] }}.selectedOptions[0].dataset.target);
        });

        </script>
    @endpush

@endif
