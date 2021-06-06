<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\Admin\StatusResource;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StatusResource(Status::with(['created_by'])->get());
    }

    public function store(StoreStatusRequest $request)
    {
        $status = Status::create($request->all());

        return (new StatusResource($status))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Status $status)
    {
        abort_if(Gate::denies('status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StatusResource($status->load(['created_by']));
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        $status->update($request->all());

        return (new StatusResource($status))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Status $status)
    {
        abort_if(Gate::denies('status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
