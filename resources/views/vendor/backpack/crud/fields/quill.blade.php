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
      <link href="//cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
      <style>
        .ql-editor { position: relative; min-height: 15em; }
        .ql-editor p { margin-bottom: .75em; }
        .ql-editor img { display: block; }
        .progress-container { position: absolute; top: 0; bottom: 0; right: 0; left: 0; background-color: rgba(50,50,50,.5); display: flex; align-items: center; flex-direction: row; padding: 3rem; }
        .progress-container .progress { width: 100%; margin-bottom: 0; }
      </style>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
      <script src="//cdn.quilljs.com/1.3.4/quill.min.js"></script>
      <script>
        const cloudName_{{ $field['name'] }} = 'letsdance';
        const unsignedUploadPreset = 'hxep6y90';

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
          console.log(editor);
          for (var i = 0; i < files.length; i++) {
            saveToServer(files[i]); // call the function to upload the file
          }
        };

        function saveToServer(file,quill,editor) {
          console.log(editor);
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
          console.log(editor);
          document.getElementById('progress').style.width = 0;

          // Update progress (can be used to show progress indicator)
          xhr.upload.addEventListener("progress", function(e) {
            var progress = Math.round((e.loaded * 100.0) / e.total);
            document.getElementById('progress').style.width = progress + "%";
            console.log(progress);
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
              tokens.splice(-2, 0, 'w_740,c_scale,q_75');
              var imgURL = tokens.join('/');
              insertToEditor(quill, imgURL, range);
            }
            else if (xhr.readyState == 4){
              var response = JSON.parse(xhr.responseText);
              alert(response.error.message);
              document.querySelector('.progress-container').remove();
              editor.enable(true);
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

  const editor_{{ $field['name'] }} = document.getElementById('quill-editor-{{ $field['name'] }}');

  editor_{{ $field['name'] }}.addEventListener("dragenter", dragenter, false);
  editor_{{ $field['name'] }}.addEventListener("dragover", dragover, false);
  editor_{{ $field['name'] }}.addEventListener("drop", drop, false);

  var quill_{{ $field['name'] }} = new Quill(editor_{{ $field['name'] }}, {
    theme: 'snow',
    modules: {
      toolbar: {
        container: [{!! $field['toolbar'] !!}],
        handlers: {
          image: selectLocalImage,
        }
      }
    },
  });

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
        console.log(file);
      } else {
        console.warn('You could only upload images.');
      }
    };
  }

  var editorContent_{{ $field['name'] }} = editor_{{ $field['name'] }}.querySelector('.ql-editor');
  var textarea_{{ $field['name'] }} = document.getElementById('quill-textarea-{{ $field['name'] }}');

   document.forms[0].addEventListener('submit',function(){
     textarea_{{ $field['name'] }}.value = editorContent_{{ $field['name'] }}.innerHTML;
   });

   editorContent_{{ $field['name'] }}.innerHTML = textarea_{{ $field['name'] }}.value;

</script>
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
