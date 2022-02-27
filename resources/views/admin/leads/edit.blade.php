@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lead.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.leads.update", [$lead->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lead_title">{{ trans('cruds.lead.fields.lead_title') }}</label>
                <input class="form-control {{ $errors->has('lead_title') ? 'is-invalid' : '' }}" type="text" name="lead_title" id="lead_title" value="{{ old('lead_title', $lead->lead_title) }}" required>
                @if($errors->has('lead_title'))
                    <span class="text-danger">{{ $errors->first('lead_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.lead_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lead_description">{{ trans('cruds.lead.fields.lead_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('lead_description') ? 'is-invalid' : '' }}" name="lead_description" id="lead_description">{!! old('lead_description', $lead->lead_description) !!}</textarea>
                @if($errors->has('lead_description'))
                    <span class="text-danger">{{ $errors->first('lead_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.lead_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assign_user_id">{{ trans('cruds.lead.fields.assign_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assign_user') ? 'is-invalid' : '' }}" name="assign_user_id" id="assign_user_id">
                    @foreach($assign_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assign_user_id') ? old('assign_user_id') : $lead->assign_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assign_user'))
                    <span class="text-danger">{{ $errors->first('assign_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.assign_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assign_client_id">{{ trans('cruds.lead.fields.assign_client') }}</label>
                <select class="form-control select2 {{ $errors->has('assign_client') ? 'is-invalid' : '' }}" name="assign_client_id" id="assign_client_id">
                    @foreach($assign_clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assign_client_id') ? old('assign_client_id') : $lead->assign_client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assign_client'))
                    <span class="text-danger">{{ $errors->first('assign_client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.assign_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="deadline">{{ trans('cruds.lead.fields.deadline') }}</label>
                <input class="form-control datetime {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline', $lead->deadline) }}" required>
                @if($errors->has('deadline'))
                    <span class="text-danger">{{ $errors->first('deadline') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.lead.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $lead->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.lead.fields.qualified') }}</label>
                @foreach(App\Models\Lead::QUALIFIED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('qualified') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="qualified_{{ $key }}" name="qualified" value="{{ $key }}" {{ old('qualified', $lead->qualified) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="qualified_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('qualified'))
                    <span class="text-danger">{{ $errors->first('qualified') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.qualified_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="leads_doc">{{ trans('cruds.lead.fields.leads_doc') }}</label>
                <div class="needsclick dropzone {{ $errors->has('leads_doc') ? 'is-invalid' : '' }}" id="leads_doc-dropzone">
                </div>
                @if($errors->has('leads_doc'))
                    <span class="text-danger">{{ $errors->first('leads_doc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.leads_doc_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.leads.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $lead->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedLeadsDocMap = {}
Dropzone.options.leadsDocDropzone = {
    url: '{{ route('admin.leads.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="leads_doc[]" value="' + response.name + '">')
      uploadedLeadsDocMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLeadsDocMap[file.name]
      }
      $('form').find('input[name="leads_doc[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lead) && $lead->leads_doc)
          var files =
            {!! json_encode($lead->leads_doc) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="leads_doc[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection