<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Resources\Admin\LeadResource;
use App\Models\Lead;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeadResource(Lead::with(['assign_user', 'assign_client', 'status', 'created_by'])->get());
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->all());

        return (new LeadResource($lead))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lead $lead)
    {
        abort_if(Gate::denies('lead_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeadResource($lead->load(['assign_user', 'assign_client', 'status', 'created_by']));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());

        return (new LeadResource($lead))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lead $lead)
    {
        abort_if(Gate::denies('lead_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
