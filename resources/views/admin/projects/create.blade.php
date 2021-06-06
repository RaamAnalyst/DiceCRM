@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="project_title">{{ trans('cruds.project.fields.project_title') }}</label>
                <input class="form-control {{ $errors->has('project_title') ? 'is-invalid' : '' }}" type="text" name="project_title" id="project_title" value="{{ old('project_title', '') }}" required>
                @if($errors->has('project_title'))
                    <span class="text-danger">{{ $errors->first('project_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.project_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="project_description">{{ trans('cruds.project.fields.project_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('project_description') ? 'is-invalid' : '' }}" name="project_description" id="project_description">{!! old('project_description') !!}</textarea>
                @if($errors->has('project_description'))
                    <span class="text-danger">{{ $errors->first('project_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.project_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assign_user_id">{{ trans('cruds.project.fields.assign_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assign_user') ? 'is-invalid' : '' }}" name="assign_user_id" id="assign_user_id">
                    @foreach($assign_users as $id => $assign_user)
                        <option value="{{ $id }}" {{ old('assign_user_id') == $id ? 'selected' : '' }}>{{ $assign_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('assign_user'))
                    <span class="text-danger">{{ $errors->first('assign_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.assign_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assign_client_id">{{ trans('cruds.project.fields.assign_client') }}</label>
                <select class="form-control select2 {{ $errors->has('assign_client') ? 'is-invalid' : '' }}" name="assign_client_id" id="assign_client_id">
                    @foreach($assign_clients as $id => $assign_client)
                        <option value="{{ $id }}" {{ old('assign_client_id') == $id ? 'selected' : '' }}>{{ $assign_client }}</option>
                    @endforeach
                </select>
                @if($errors->has('assign_client'))
                    <span class="text-danger">{{ $errors->first('assign_client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.assign_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="deadline">{{ trans('cruds.project.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}" required>
                @if($errors->has('deadline'))
                    <span class="text-danger">{{ $errors->first('deadline') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.project.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.status_helper') }}</span>
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
                xhr.open('POST', '/admin/projects/ckmedia', true);
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
                data.append('crud_id', '{{ $project->id ?? 0 }}');
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

@endsection