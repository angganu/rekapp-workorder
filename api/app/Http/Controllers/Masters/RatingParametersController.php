<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MstRatingParameters as Model;
use App\Http\Resources\RatingParameterResource as ModelResource;

class RatingParametersController extends BaseController
{
    private $module = 'Rating Parameter';

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
            'location_id' => 'required',
            'area_id' => 'required',
            'room_category_id' => 'required',
            'code' => 'required',
            'name' => 'required'
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
            'location_id' => 'required',
            'area_id' => 'required',
            'room_category_id' => 'required',
            // 'code' => 'required',
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = Model::findOrFail($id);
        $model->location_id = $input['location_id'];
        $model->area_id = $input['area_id'];
        $model->room_category_id = $input['room_category_id'];
        $model->code = $input['code'];
        $model->name = $input['name'];
        $model->description = $input['description'];
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