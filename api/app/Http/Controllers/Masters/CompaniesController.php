<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MstCompanies as Model;
use App\Http\Resources\CompanyResource as ModelResource;

class CompaniesController extends BaseController
{
    private $module = 'Companies';

    // Display a listing of the resource.
    public function index(): JsonResponse
    {
        $companys = Model::all();

        return $this->sendResponse(ModelResource::collection($companys), $this->module. ' retrieved successfully.');
    }

    // Store a newly created resource in storage.
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'code' => 'required',
            'name' => 'required',
            'legal_name' => 'required',
            'alias' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $company = Model::create($input);

        return $this->sendResponse(new ModelResource($company), $this->module. ' created successfully.');
    }

    // Display the specified resource.
    public function show($id): JsonResponse
    {
        $company = Model::find($id);

        if (is_null($company)) {
            return $this->sendError($this->module. ' not found.');
        }

        return $this->sendResponse(new ModelResource($company), $this->module. ' retrieved successfully.');
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            // 'code' => 'required',
            'name' => 'required',
            'legal_name' => 'required',
            'alias' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Model::findOrFail($id);
        $model->code = $input['code'];
        $model->name = $input['name'];
        $model->legal_name = $input['legal_name'];
        $model->alias = $input['alias'];
        $model->description = $input['description'];
        $model->save();

        return $this->sendResponse(new ModelResource($model), $this->module. ' updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Model $company): JsonResponse
    {
        // Todo Soft Delete
        $company->delete();

        return $this->sendResponse([], $this->module. ' deleted successfully.');
    }
}