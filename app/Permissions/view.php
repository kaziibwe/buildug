<?php
namespace App\Permissions;

class View {

    public function view(){

        $viewMap = [
            'category' => 'admin.manageCategory.manageCategory',
            'product' => 'admin.manageProduct.manageProduct',
            'user' => 'admin.manageUser.manageUser',
            // Add more type-to-view mappings here as needed
        ];
        // return $viewMap;
    }

}
