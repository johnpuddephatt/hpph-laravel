<!-- CKeditor -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <div id="quill-editor-{{ $field['name'] }}">
    </div>

    <textarea style="display: none"
    	id="quill-textarea-{{ $field['name'] }}"
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' => 'form-control quill-textarea-' . $field['name']])
    	>{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

@php
  if ($crud->tabsEnabled) {
      $fields = isset($entry) ? $crud->update_fields : $crud->create_fields;
  }
@endphp

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
<script>console.log('hello');</script>
    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
      <link href="//cdn.quilljs.com/2.0.0-dev.2/quill.snow.css" rel="stylesheet">
      <style>
        .form-group { clear: both; }
        .ql-editor { position: relative; min-height: 15em; }
        .ql-editor h2 {
          margin-bottom: .75em;
          margin-top: 1.5em;
        }
        .ql-editor p { margin-bottom: .75em; }
        .ql-editor img { display: block; }
        .progress-container { position: absolute; top: 0; bottom: 0; right: 0; left: 0; background-color: rgba(50,50,50,.5); display: flex; align-items: center; flex-direction: row; padding: 3rem; }
        .progress-container .progress { width: 100%; margin-bottom: 0; }

        .ql-table .ql-picker-label {
          background: none;
              border: none;
              cursor: pointer;
              display: inline-block;
              float: left;
              height: 24px;
              padding: 3px 5px;
              width: 48px;
        }
        .ql-table.ql-picker svg {
          position: static !important;
          margin: 0 !important;
        }
      </style>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')

      <script src="//cdn.quilljs.com/2.0.0-dev.2/quill.js"></script>
      {{-- <script src="//cdn.quilljs.com/1.3.7/quill.min.js"></script> --}}
      <script>
      // tables




      // Image uploading
        const cloudName_{{ $field['name'] }} = '{{ config('app.cloudinary')}}';
        const unsignedUploadPreset = '{{ config('app.cloudinary_upload_preset')}}';

        function dragenter() {
          e.stopPropagation();
          e.preventDefault();
        }

        function dragover() {
          e.stopPropagation();
          e.preventDefault();
        }

        function drop() {
          e.stopPropagation();
          e.preventDefault();
          if(!quill.hasFocus()) {
            // quill.focus();
          }
          var dt = e.dataTransfer;
          var files = dt.files;

          handleFiles(files,this);
        }

        var handleFiles = function(files,editor) {
          for (var i = 0; i < files.length; i++) {
            saveToServer(files[i]); // call the function to upload the file
          }
        };

        function saveToServer(file,quill,editor) {
          quill.enable(false);
          var url = `https://api.cloudinary.com/v1_1/${cloudName_{{ $field['name'] }}}/upload`;
          var xhr = new XMLHttpRequest();
          var fd = new FormData();
          const range = quill_{{ $field['name'] }}.getSelection() || {index: quill_{{ $field['name'] }}.getLength(), length: 0};
          xhr.open('POST', url, true);
          xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

          // Reset the upload progress bar
          var progressBar = `<div class="progress-container"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" id="progress"></div></div></div>`;

          editor.insertAdjacentHTML('beforeend',progressBar);
          document.getElementById('progress').style.width = 0;

          // Update progress (can be used to show progress indicator)
          xhr.upload.addEventListener("progress", function(e) {
            var progress = Math.round((e.loaded * 100.0) / e.total);
            document.getElementById('progress').style.width = progress + "%";
          });

          xhr.onreadystatechange = function(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
              // File uploaded successfully
              document.querySelector('.progress-container').remove();

              var response = JSON.parse(xhr.responseText);
              // https://res.cloudinary.com/cloudName/image/upload/v1483481128/public_id.jpg
              var url = response.secure_url;
              // Create a thumbnail of the uploaded image, with 740px width
              var tokens = url.split('/');
              tokens.splice(-3, 0, 'w_740,c_scale,q_75');
              var imgURL = tokens.join('/');
              insertToEditor(quill, imgURL, range);
            }
            else if (xhr.readyState == 4){
              var response = JSON.parse(xhr.responseText);
              alert(response.error.message);
              document.querySelector('.progress-container').remove();
              quill.enable(true);
            }
          };

          fd.append('upload_preset', unsignedUploadPreset);
          fd.append('tags', 'browser_upload'); // Optional - add tag for image admin in Cloudinary
          fd.append('file', file);
          xhr.send(fd);
        }

        function insertToEditor(quill, url, range) {
          // push image url to rich editor.
          // quill.editor.insertEmbed(range.index, 'image', url);
          var Delta = Quill.import('delta');
          quill.updateContents(new Delta()
                      .retain(range.index)
                      .delete(range.length)
                      .insert({ image: url }));

          quill.enable(true);
        }
      </script>





    @endpush

@endif

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
<script>

  if(typeof DividerBlot === 'undefined') {
    let BlockEmbed = Quill.import('blots/block/embed');
    class DividerBlot extends BlockEmbed {};
    DividerBlot.blotName = 'divider';
    DividerBlot.tagName = 'hr';
    Quill.register(DividerBlot);
  }

  const tabletruth_{{ $field['name'] }} = {{ strpos($field['toolbar'],"['table']") ? 'true' : 'false' }};

  const editor_{{ $field['name'] }} = document.getElementById('quill-editor-{{ $field['name'] }}');

  editor_{{ $field['name'] }}.addEventListener("dragenter", dragenter, false);
  editor_{{ $field['name'] }}.addEventListener("dragover", dragover, false);
  editor_{{ $field['name'] }}.addEventListener("drop", drop, false);

  var quill_{{ $field['name'] }} = new Quill(editor_{{ $field['name'] }}, {
    theme: 'snow',
    modules: {

      table: tabletruth_{{ $field['name'] }},
      toolbar: {
        container: [{!! $field['toolbar'] !!}],
        handlers: {
          image: selectLocalImage,
          divider: function(value) {
            this.quill.format('divider', true);
          },
          table: function (value) {
                if (value) {
                  switch(value) {
                    case 'Insert table':
                      // do something;
                      quilltable_{{ $field['name'] }}.insertTable(2, 2);
                      break;
                    case 'Insert Row Above':
                      // do something;
                      quilltable_{{ $field['name'] }}.insertRowAbove();
                      break;
                    case 'Insert Row Below':
                      // do something;
                      quilltable_{{ $field['name'] }}.insertRowBelow();
                      break;
                    case 'Insert Column Left':
                      // do something;
                      quilltable_{{ $field['name'] }}.insertColumnLeft();
                      break;
                    case 'Insert Column Right':
                      // do something;
                      quilltable_{{ $field['name'] }}.insertColumnRight();
                      break;
                    case 'Delete Row':
                      // do something;
                      quilltable_{{ $field['name'] }}.deleteRow();
                      break;
                    case 'Delete Column':
                      // do something;
                      quilltable_{{ $field['name'] }}.deleteColumn();
                      break;
                    case 'Delete Table':
                      // do something;
                      quilltable_{{ $field['name'] }}.deleteTable();
                      break;

                  }
                }
            }
        }
      }
    },
  });

  const quilltable_{{ $field['name'] }} = quill_{{ $field['name'] }}.getModule('table');

  function selectLocalImage() {
    const input_{{ $field['name'] }} = document.createElement('input');
    input_{{ $field['name'] }}.setAttribute('type', 'file');
    input_{{ $field['name'] }}.click();

    // Listen upload local image and save to server
    input_{{ $field['name'] }}.onchange = () => {
      const file = input_{{ $field['name'] }}.files[0];

      // file type is only image.
      if (/^image\//.test(file.type)) {
        saveToServer(file,quill_{{ $field['name'] }},editor_{{ $field['name'] }});
      } else {
        alert('You can only upload images.');
      }
    };
  }

  var editorContent_{{ $field['name'] }} = editor_{{ $field['name'] }}.querySelector('.ql-editor');
  var textarea_{{ $field['name'] }} = document.getElementById('quill-textarea-{{ $field['name'] }}');

  document.forms[0].addEventListener('submit',function(){
    textarea_{{ $field['name'] }}.value = editorContent_{{ $field['name'] }}.innerHTML;
  });

  editorContent_{{ $field['name'] }}.innerHTML = textarea_{{ $field['name'] }}.value;

   // We need to manually supply the HTML content of our custom dropdown list
    const tablePickerItems_{{ $field['name'] }} = Array.prototype.slice.call(document.querySelectorAll('.ql-table .ql-picker-item'));
    tablePickerItems_{{ $field['name'] }}.forEach(item => item.textContent = item.dataset.value);
    const tableLabel_{{ $field['name'] }} = document.querySelector('.ql-toolbar .ql-table .ql-picker-label');
    if(tableLabel_{{ $field['name'] }}) {
      tableLabel_{{ $field['name'] }}.insertAdjacentHTML('afterbegin','<svg viewBox="0 0 18 18"> <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect> <rect class="ql-fill" height="2" width="3" x="5" y="5"></rect> <rect class="ql-fill" height="2" width="4" x="9" y="5"></rect> <g class="ql-fill ql-transparent"> <rect height="2" width="3" x="5" y="8"></rect> <rect height="2" width="4" x="9" y="8"></rect> <rect height="2" width="3" x="5" y="11"></rect> <rect height="2" width="4" x="9" y="11"></rect> </g> </svg>');
    }
    const tableButton_{{ $field['name'] }} = document.querySelector('.ql-table.ql-picker');

    const dividerButton_{{ $field['name'] }} = document.querySelector('.ql-toolbar .ql-divider');
    if(dividerButton_{{ $field['name'] }}) {
      dividerButton_{{ $field['name'] }}.insertAdjacentHTML('afterbegin','<svg viewBox="0 0 18 18"><rect class="ql-stroke" height="1" width="18" x="0" y="8"></rect></svg>');
    }

</script>
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
