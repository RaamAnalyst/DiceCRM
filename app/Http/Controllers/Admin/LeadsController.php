<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLeadRequest;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Status;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LeadsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lead::with(['assign_user', 'assign_client', 'status', 'created_by'])->select(sprintf('%s.*', (new Lead)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'lead_show';
                $editGate      = 'lead_edit';
                $deleteGate    = 'lead_delete';
                $crudRoutePart = 'leads';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('lead_title', function ($row) {
                return $row->lead_title ? $row->lead_title : "";
            });
            $table->addColumn('assign_user_name', function ($row) {
                return $row->assign_user ? $row->assign_user->name : '';
            });

            $table->addColumn('status_status', function ($row) {
                return $row->status ? $row->status->status : '';
            });

            $table->editColumn('qualified', function ($row) {
                return $row->qualified ? Lead::QUALIFIED_RADIO[$row->qualified] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'assign_user', 'status']);

            return $table->make(true);
        }

        return view('admin.leads.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assign_users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assign_clients = Client::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.leads.create', compact('assign_users', 'assign_clients', 'statuses'));
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lead->id]);
        }

        return redirect()->route('admin.leads.index');
    }

    public function edit(Lead $lead)
    {
        abort_if(Gate::denies('lead_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assign_users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assign_clients = Client::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lead->load('assign_user', 'assign_client', 'status', 'created_by');

        return view('admin.leads.edit', compact('assign_users', 'assign_clients', 'statuses', 'lead'));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());

        return redirect()->route('admin.leads.index');
    }

    public function show(Lead $lead)
    {
        abort_if(Gate::denies('lead_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->load('assign_user', 'assign_client', 'status', 'created_by');

        return view('admin.leads.show', compact('lead'));
    }

    public function destroy(Lead $lead)
    {
        abort_if(Gate::denies('lead_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeadRequest $request)
    {
        Lead::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lead_create') && Gate::denies('lead_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lead();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
