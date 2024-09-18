<?php

// app/Services/PostService.php

// namespace App\Services;

// use Illuminate\Support\Str;

// class PostService
// {
//     public function saveAll($type, $data)
//     {
//         $modelClass = $this->getModelClass($type);
//         foreach ($data as $itemData) {
//             $this->saveToDatabase($modelClass, $itemData);
//         }
//     }

//     protected function getModelClass($type)
//     {
//         $modelClass = 'App\\Models\\' . Str::studly($type);
//         if (!class_exists($modelClass)) {
//             throw new \InvalidArgumentException("Unsupported type: $type");
//         }
//         return $modelClass;
//     }

//     protected function saveToDatabase($modelClass, $itemData)
//     {
//         // Ensure $itemData is an array
//         if (is_array($itemData)) {
//             $modelClass::create($itemData);
//         } else {
//             throw new \InvalidArgumentException("Data must be an array.");
//         }
//     }
// }


// app/Http/Controllers/PostController.php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Services\PostService;

// class PostController extends Controller
// {
//     protected $postService;

//     public function __construct(PostService $postService)
//     {
//         $this->postService = $postService;
//     }

//     public function saveAll(Request $request, $type)
//     {
//         $data = $request->all(); // Ensure this is in the correct format
//         $this->postService->saveAll($type, $data);

//         return response()->json(['message' => "All {$type} data has been saved successfully."]);
//     }
// }
