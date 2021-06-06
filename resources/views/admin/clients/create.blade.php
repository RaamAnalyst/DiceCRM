@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="contact_name">{{ trans('cruds.client.fields.contact_name') }}</label>
                <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', '') }}" required>
                @if($errors->has('contact_name'))
                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_email">{{ trans('cruds.client.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" required>
                @if($errors->has('contact_email'))
                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_number">{{ trans('cruds.client.fields.contact_number') }}</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', '') }}" required>
                @if($errors->has('contact_number'))
                    <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.contact_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gst_vat">{{ trans('cruds.client.fields.gst_vat') }}</label>
                <input class="form-control {{ $errors->has('gst_vat') ? 'is-invalid' : '' }}" type="text" name="gst_vat" id="gst_vat" value="{{ old('gst_vat', '') }}" required>
                @if($errors->has('gst_vat'))
                    <span class="text-danger">{{ $errors->first('gst_vat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.gst_vat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.client.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.client.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zipcode">{{ trans('cruds.client.fields.zipcode') }}</label>
                <input class="form-control {{ $errors->has('zipcode') ? 'is-invalid' : '' }}" type="text" name="zipcode" id="zipcode" value="{{ old('zipcode', '') }}">
                @if($errors->has('zipcode'))
                    <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.zipcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.client.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="industry_id">{{ trans('cruds.client.fields.industry') }}</label>
                <select class="form-control select2 {{ $errors->has('industry') ? 'is-invalid' : '' }}" name="industry_id" id="industry_id">
                    @foreach($industries as $id => $industry)
                        <option value="{{ $id }}" {{ old('industry_id') == $id ? 'selected' : '' }}>{{ $industry }}</option>
                    @endforeach
                </select>
                @if($errors->has('industry'))
                    <span class="text-danger">{{ $errors->first('industry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.industry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_type">{{ trans('cruds.client.fields.company_type') }}</label>
                <input class="form-control {{ $errors->has('company_type') ? 'is-invalid' : '' }}" type="text" name="company_type" id="company_type" value="{{ old('company_type', '') }}">
                @if($errors->has('company_type'))
                    <span class="text-danger">{{ $errors->first('company_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.company_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="department_id">{{ trans('cruds.client.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id">
                    @foreach($departments as $id => $department)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.client.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.user_helper') }}</span>
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