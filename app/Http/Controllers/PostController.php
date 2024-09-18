<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\Path\TypeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveDataRequest;

class PostController extends Controller
{
    //declare the valiable
    protected $postService;

    protected $typeService;



    public function __construct(
        PostService $postService,
        TypeService $typeService
    ) {
        $this->postService = $postService;
        $this->typeService = $typeService;
    }

    public function saveAll(SaveDataRequest $request,)
    {

        // get the type this help the get the model
        $type = $this->typeService->type($request);

        // get the validated object
        $validated = $request->validated();
        // convert the validated object  to an array

    
        $responseData = [$validated];

        try {
            $this->postService->saveAll($type, $responseData);
            return response()->json([
                'success' => true,
                'message' => "All {$type} data has been saved successfully."
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => 'something went wrong.'
            ], 500);
        }
    }




    // controller to update user
    public function update(SaveDataRequest $request, $type, $id)
    {
        // get the type this help the get the model
        $type = $this->typeService->type($request); //return 1 it has passed

        $validated = $request->validated();

        try {
            $this->postService->update($type, $id, $validated);
            return response()->json([
                'success' => true,
                'message' => "{$type} data with ID {$id} has been updated successfully."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'something went wrong.'
            ], 500);
        }
    }





    public function delete(Request $request, $type, $id)
    {
        try {

            $type = $this->typeService->type($request); //return 1 it has passed

            $this->postService->delete($type, $id);

            return response()->json([
                'success' => true,
                'message' => "{$type} data with ID {$id} has been deleted successfully."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong. '
            ], 500);
        }
    }
}
