<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Employees as Model;
use App\Http\Resources\EmployeeResource as ModelResource;

class EmployeesController extends BaseController
{
    private $module = 'Employee';

    // Display a listing of the resource.
    public function index(): JsonResponse
    {
        $data = Model::orderBy(
            ((request()->order_column)? request()->order_column:'id'),
            ((request()->order_direction)? request()->order_direction : 'DESC')
        );

        $data = $this->filterData($data);
        $data = $data->get();        

        return $this->sendResponse(ModelResource::collection($data), $this->module. ' retrieved successfully.');
    }

    public function filterData($data){
        if(request()->filter_keyword){
            $data = $data->where(function($query){
                $query->where('nik','like','%'.request()->filter_keyword.'%')
                    ->orWhere('name','like','%'.request()->filter_keyword.'%')
                    ->orWhere('phone','like','%'.request()->filter_keyword.'%')
                    ->orWhere('email','like','%'.request()->filter_keyword.'%')
                    ->orWhere('address','like','%'.request()->filter_keyword.'%');
            });
        }
        
        if(isset(request()->filter_gender)){
            $data = $data->where('gender',request()->filter_gender);
        }

        if(request()->filter_date){
            $data = $data->whereBetween('created_at',request()->filter_date);
        }

        return $data;
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
        $model->date_disabled = (isset($input['date_disabled']))? $input['date_disabled'] : null;
        $model->is_active = (isset($input['is_active']))? $input['is_active'] : $model->is_active;
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