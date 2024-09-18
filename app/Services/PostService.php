<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PostService
{
    // public function postAll($type)
    // {
    //     $modelClass = $this->getModelClass($type);
    //     $items = $modelClass::all();
    //     foreach ($items as $item) {
    //         $this->postToExternalService($item, $type);
    //     }
    // }

    // protected function getModelClass($type)
    // {
    //     $modelClass = 'App\\Models\\' . Str::studly($type);
    //     if (!class_exists($modelClass)) {
    //         throw new \InvalidArgumentException("Unsupported type: $type");
    //     }
    //     return $modelClass;
    // }

    // protected function postToExternalService($item, $type)
    // {
    //     $endpoint = 'https://external-service.com/api/' . $type;
    //     $response = Http::post($endpoint, $item->toArray());

    //     return $response;
    // }




    // public function saveAll($type, $data)
    // {
    //     $modelClass = $this->getModelClass($type);
    //     foreach ($data as $itemData) {
    //         $this->saveToDatabase($modelClass, $itemData);
    //     }
    // }

    // public function update($type, $id, $data)
    // {
    //     $modelClass = $this->getModelClass($type);

    //     $item = $modelClass::findOrFail($id);
    //     return $item;
    //     $item->update($data);

    // }

    // protected function getModelClass($type)
    // {
    //     $modelClass = 'App\\Models\\' . Str::studly($type);
    //     if (!class_exists($modelClass)) {
    //         throw new \InvalidArgumentException("Unsupported type: $type");
    //     }
    //     return $modelClass;
    // }


    // protected function saveToDatabase($modelClass, $itemData)
    // {
    //     // Ensure $itemData is an array
    //     if (is_array($itemData)) {
    //         $modelClass::create($itemData);
    //     } else {
    //         throw new \InvalidArgumentException("Data must be an array.");
    //     }
    // }



    public function saveAll($type, $data)
    {
        $modelClass = $this->getModelClass($type);

        foreach ($data as $itemData) {
            $this->saveToDatabase($modelClass, $itemData);
        }
    }

    public function update($type, $id, $data)
    {
        $modelClass = $this->getModelClass($type);

        $item = $modelClass::findOrFail($id);
        $item->update($data);
    }

    public function delete($type, $id)
    {
        $modelClass = $this->getModelClass($type);
      // Find the item by ID and delete it
      $item = $modelClass::findOrFail($id);
      $item->delete();
    }


    protected function getModelClass($type)
    {
        $modelClass = 'App\\Models\\' . Str::studly($type);
        if (!class_exists($modelClass)) {
            throw new \InvalidArgumentException("Unsupported type: $type");
        }
        return $modelClass;
    }

    protected function saveToDatabase($modelClass, $itemData)
    {
        if (is_array($itemData)) {
            $modelClass::create($itemData);
        } else {
            throw new \InvalidArgumentException("Data must be an array.");
        }
    }





}

