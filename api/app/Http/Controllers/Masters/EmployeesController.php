<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Employess as Model;
use App\Http\Resources\EmployeeResource as ModelResource;

class EmployeesController extends BaseController
{
    private $module = 'Employee';

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
            'nik' => 'required',
            'name' => 'required',
            // 'gender' => 'required',
            // 'phone' => 'required',
            // 'email' => 'required',
            // 'address' => 'required',
            'date_active' => 'required'
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
            'nik' => 'required',
            'name' => 'required',
            // 'gender' => 'required',
            // 'phone' => 'required',
            // 'email' => 'required',
            // 'address' => 'required',
            'date_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Model::findOrFail($id);
        $model->nik = $input['nik'];
        $model->name = $input['name'];
        $model->gender = $input['gender'];
        $model->phone = $input['phone'];
        $model->email = $input['email'];
        $model->address = $input['address'];
        $model->date_active = $input['date_active'];
        $model->date_disabled = $input['date_disabled'];
        $model->is_active = $input['is_active'];
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