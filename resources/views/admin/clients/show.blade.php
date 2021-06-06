@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.contact_name') }}
                        </th>
                        <td>
                            {{ $client->contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $client->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.contact_number') }}
                        </th>
                        <td>
                            {{ $client->contact_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.gst_vat') }}
                        </th>
                        <td>
                            {{ $client->gst_vat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.company_name') }}
                        </th>
                        <td>
                            {{ $client->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.address') }}
                        </th>
                        <td>
                            {{ $client->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.zipcode') }}
                        </th>
                        <td>
                            {{ $client->zipcode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.city') }}
                        </th>
                        <td>
                            {{ $client->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.industry') }}
                        </th>
                        <td>
                            {{ $client->industry->industry ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.company_type') }}
                        </th>
                        <td>
                            {{ $client->company_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.department') }}
                        </th>
                        <td>
                            {{ $client->department->department ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.user') }}
                        </th>
                        <td>
                            {{ $client->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#assign_client_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assign_client_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assign_client_leads" role="tab" data-toggle="tab">
                {{ trans('cruds.lead.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="assign_client_projects">
            @includeIf('admin.clients.relationships.assignClientProjects', ['projects' => $client->assignClientProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="assign_client_tasks">
            @includeIf('admin.clients.relationships.assignClientTasks', ['tasks' => $client->assignClientTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="assign_client_leads">
            @includeIf('admin.clients.relationships.assignClientLeads', ['leads' => $client->assignClientLeads])
        </div>
    </div>
</div>

@endsection