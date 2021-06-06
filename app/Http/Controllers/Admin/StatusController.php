<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStatusRequest;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Status::with(['created_by'])->select(sprintf('%s.*', (new Status)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'status_show';
                $editGate      = 'status_edit';
                $deleteGate    = 'status_delete';
                $crudRoutePart = 'statuses';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.statuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statuses.create');
    }

    public function store(StoreStatusRequest $request)
    {
        $status = Status::create($request->all());

        return redirect()->route('admin.statuses.index');
    }

    public function edit(Status $status)
    {
        abort_if(Gate::denies('status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status->load('created_by');

        return view('admin.statuses.edit', compact('status'));
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        $status->update($request->all());

        return redirect()->route('admin.statuses.index');
    }

    public function show(Status $status)
    {
        abort_if(Gate::denies('status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status->load('created_by', 'statusProjects', 'statusTasks', 'statusLeads');

        return view('admin.statuses.show', compact('status'));
    }

    public function destroy(Status $status)
    {
        abort_if(Gate::denies('status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status->delete();

        return back();
    }

    public function massDestroy(MassDestroyStatusRequest $request)
    {
        Status::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
