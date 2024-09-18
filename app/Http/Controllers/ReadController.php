<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReadService;
use App\Services\Path\TypeService;
use App\Services\Access\AuthService;
use Symfony\Component\Console\Input\Input;

class ReadController extends Controller
{
    protected $readService;
    protected $typeService;
    protected $urlPathService;
    public function __construct(
        ReadService $readService,
        TypeService $typeService,

    )
    {
        $this->readService = $readService;
        $this->typeService = $typeService;

    }

    //read all items
    public function getAll(Request $request)
    {
        try {
        // get the type this help the get the model
        $type = $this->typeService->type($request);

            $perPage = $request->input('perPage') ? $request->input('perPage') : 20;
            $page = $request->query('page', 1);
            $orderBy = $request->input('orderBy') ? $request->input('orderBy') : 'asc';

            // Fetch paginated data based on type
            $data = $this->readService->getAll($type, $perPage, $page, $orderBy);

            // Prepare a structured response with pagination details
            return response()->json([
                'results' => [
                    'data' => $data->items(),
                    'total' => $data->total(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'first_page_url' => $data->url(1),
                    'last_page_url' => $data->url($data->lastPage()),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                    'path' => $data->path(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'something went wrong.'
            ], 500);
        }
    }

    // controller to read single item
    public function get(Request $request,$type, $id )
    {
               // get the type this help the get the model
            //    $type = $this->typeService->type($request);
                           $type = $this->typeService->type($request);
                        //    $this->urlPathService->path($request, $type); //return 1 it has passed

                        // return $type;

        // user determine he  want with existing model
        $related = $request->input('relationship');
        // this determins numbers perPage
        $perPage = $request->input('perPage') ? $request->input('perPage') : 20;
        $page = $request->query('page', 1);
        $orderBy = $request->input('orderBy') ? $request->input('orderBy') : 'asc';
        try {
            // $related = $request->input('related') ?? null;

            $data = $this->readService->get($type, $id, $related, $perPage, $page, $orderBy);
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return $e;
            return response()->json([
                'error' => 'something went wrong.'
            ], 500);
        }
    }

    // public function get(Request $request, $type, $id)
    // {
    //     try {
    //         $data = $this->readService->get($type, $id);
    //         return response()->json(['data' => $data]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
}
