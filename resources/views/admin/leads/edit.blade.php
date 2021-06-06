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
                    @foreach($assign_users as $id => $assign_user)
                        <option value="{{ $id }}" {{ (old('assign_user_id') ? old('assign_user_id') : $lead->assign_user->id ?? '') == $id ? 'selected' : '' }}>{{ $assign_user }}</option>
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
                    @foreach($assign_clients as $id => $assign_client)
                        <option value="{{ $id }}" {{ (old('assign_client_id') ? old('assign_client_id') : $lead->assign_client->id ?? '') == $id ? 'selected' : '' }}>{{ $assign_client }}</option>
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
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $lead->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
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
                xhr.open('POST', '/admin/leads/ckmedia', true);
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

@endsection