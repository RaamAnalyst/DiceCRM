<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Http\Resources\Admin\IndustryResource;
use App\Models\Industry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndustryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('industry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IndustryResource(Industry::with(['created_by'])->get());
    }

    public function store(StoreIndustryRequest $request)
    {
        $industry = Industry::create($request->all());

        return (new IndustryResource($industry))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Industry $industry)
    {
        abort_if(Gate::denies('industry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IndustryResource($industry->load(['created_by']));
    }

    public function update(UpdateIndustryRequest $request, Industry $industry)
    {
        $industry->update($request->all());

        return (new IndustryResource($industry))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Industry $industry)
    {
        abort_if(Gate::denies('industry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industry->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
