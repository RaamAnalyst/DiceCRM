@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.industry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.industries.update", [$industry->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="industry">{{ trans('cruds.industry.fields.industry') }}</label>
                <input class="form-control {{ $errors->has('industry') ? 'is-invalid' : '' }}" type="text" name="industry" id="industry" value="{{ old('industry', $industry->industry) }}">
                @if($errors->has('industry'))
                    <span class="text-danger">{{ $errors->first('industry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.industry.fields.industry_helper') }}</span>
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