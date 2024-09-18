<?php
namespace App\Permissions;

class Permission
{
    public function Permission(){
        return [
                'admin' => [
                    'index/admin',
                    'post-all/admin',
                    'get-all/category',
                    'get/category',
                    'delete/category',
                    'update-all/category',
                    'post-all/category',


                    'get-all/SubCategory',
                    'get/SubCategory',
                    'delete/SubCategory',
                    'update-all/SubCategory',
                    'post-all/SubCategory',

                    'get-all/auction',
                    'get/auction',
                    'delete/auction',
                    'update-all/auction',
                    'post-all/auction',

                    'get-all/AuctionType',
                    'get/AuctionType',
                    'delete/AuctionType',
                    'update-all/AuctionType',
                    'post-all/AuctionType',

                    'get-all/AuctionTime',
                    'get/AuctionTime',
                    'delete/AuctionTime',
                    'update-all/AuctionTime',
                    'post-all/AuctionTime',


                    'get-all/EquipmentCategory',
                    'get/EquipmentCategory',
                    'delete/EquipmentCategory',
                    'update-all/EquipmentCategory',
                    'post-all/EquipmentCategory',
                ],
                'user' => [
                    'post-all/attendance',
                    'post-all/user',
                    'update-all/user',
                    'get-all/user',
                    'get/user',
                    'get/attendance',

                    'get/wallet',

                    'get-all/category',
                    'get/category',

                    'get-all/auction',
                    'get/auction',

                    'get-all/AuctionType',
                    'get/AuctionType',

                    'get-all/EquipmentCategory',
                    'get/EquipmentCategory',

                    'get-all/SubCategory',
                    'get/SubCategory',


                ],

                'vendor' => [
                    'index/vendor',
                    'get-all/product',
                    'get/product',
                    'post-all/product',
                    'delete/product',
                    'update-all/product',

                    'get-all/part',
                    'get/part',
                    'post-all/part',
                    'delete/part',
                    'update-all/part',


                    'get-all/ProductGallary',
                    'get/ProductGallary',
                    'post-all/ProductGallary',
                    'delete/ProductGallary',
                    'update-all/ProductGallary',

                    'get-all/PartGallary',
                    'get/PartGallary',
                    'post-all/PartGallary',
                    'delete/PartGallary',
                    'update-all/PartGallary',

                ],
                // Additional roles/permissions can be added here
        ];
    }
}
