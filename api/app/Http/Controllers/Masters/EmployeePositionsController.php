<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\EmployeePositions as Model;
use App\Http\Resources\EmployeePositionResource as ModelResource;

class EmployeePositionsController extends BaseController
{
    private $module = 'Employee Position';

    // Display a listing of the resource.
    public function index(): JsonResponse
    {
        $data = Model::all();

        return $this->sendResponse(ModelResource::collection($data), $this->module. ' retrieved successfully.');
    }

    // Store a newly created resource in storage.
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'employee_id' => 'required',
            'company_id' => 'required',
            'location_id' => 'required',
            'position_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = Model::create($input);

        return $this->sendResponse(new ModelResource($data), $this->module. ' created successfully.');
    }

    // Display the specified resource.
    public function show($id): JsonResponse
    {
        $data = Model::find($id);

        if (is_null($data)) {
            return $this->sendError($this->module. ' not found.');
        }

        return $this->sendResponse(new ModelResource($data), $this->module. ' retrieved successfully.');
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'employee_id' => 'required',
            'company_id' => 'required',
            'location_id' => 'required',
            'position_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Model::findOrFail($id);
        $model->employee_id = $input['employee_id'];
        $model->company_id = $input['company_id'];
        $model->location_id = $input['location_id'];
        $model->position_id = $input['position_id'];
        $model->save();

        return $this->sendResponse(new ModelResource($model), $this->module. ' updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Request $request, $id): JsonResponse
    {
        Model::where('id', $id)->delete();
        return $this->sendResponse([], $this->module. ' deleted successfully.');
    }
}