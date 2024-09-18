<?php
namespace App\Services;

use Illuminate\Support\Str;

class ReadService
{

    // service to getAll items
    public function getAll($type,$perPage, $page,$orderBy)
    {
        $modelClass = $this->getModelClass($type);

        // return $modelClass::paginate($perPage, ['*'], 'page', $page);
        return $modelClass::orderBy('id', $orderBy)->paginate($perPage, ['*'], 'page', $page);


    }


    // service to get asingle item
    public function get($type, $id, $related,$perPage, $page,$orderBy)
    {
        // Get the model class based on the type
        $modelClass = $this->getModelClass($type);
        // Fetch the specific item
        $data = $modelClass::findOrFail($id);

        // Check if the relationship exists
        if (method_exists($data, $related)) {
            // Fetch the related data
            $relations = $data->$related()->orderBy('id', $orderBy)->paginate($perPage, ['*'], 'page', $page);

            if($relations->count()==0){
                $output = [
                    $type => $data
                ];
                // return $output;

            }else{

            $output = [
                $type => $data,
                'results' => [
                    'data' => $relations->items(),
                    'total' => $relations->total(),
                    'per_page' => $relations->perPage(),
                    'current_page' => $relations->currentPage(),
                    'last_page' => $relations->lastPage(),
                    'first_page_url' => $relations->url(1),
                    'last_page_url' => $relations->url($relations->lastPage()),
                    'next_page_url' => $relations->nextPageUrl(),
                    'prev_page_url' => $relations->previousPageUrl(),
                    'path' => $relations->path(),
                    'from' => $relations->firstItem(),
                    'to' => $relations->lastItem(),
                ]
            ];
            }

        } else {
            // Handle the case where the relationship does not exist
            $output = [
                $type => $data
            ];
        }

        return $output;
    }



   // a method to get the model from the type value of the url
    protected function getModelClass($type)
    {
        $modelClass = 'App\\Models\\' . Str::studly($type);
        if (!class_exists($modelClass)) {
            throw new \InvalidArgumentException("Unsupported type: $type");
        }
        return $modelClass;
    }



}
