<?php

namespace App\Http\Requests;

use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules()
    {

        // get the route name used in the moment
        $type = $this->route('type');
        $id = $this->route('id'); // Assuming 'id' is the route parameter for the record ID


        // check  for the password is availlable or not
        $passwordRule = $this->isMethod('post') ? 'required|string' : 'sometimes|nullable|string';

        // depending on the route availble in the moment, is the case in the switch
        switch ($type) {
            case 'admin':   //for table admins
                return [
                    'name' => 'required|string',
                    'email' => ['required', Rule::unique('admins')->ignore($id)],
                    'email' => 'required|email',



                    'password' => $passwordRule,
                ];
            case 'user':  //for table users
                return [
                    'name' => 'required|string',
                    'image' => 'nullable',
                    'organisation_name' => 'nullable',
                    'organisation_email' => 'nullable',
                    'organisation_phone' => 'nullable',
                    'location' => 'nullable',
                    'country' => 'nullable',
                    'email' => ['required', Rule::unique('users')->ignore($id)],
                    'password' => $passwordRule,
                ];
            case 'SubCategory':  //for table users
                return [
                    'name' => 'required|string',
                    'active' => 'required|string',
                    'featured' => 'required|string',
                    'url' => 'required|string',
                    'image' => 'nullable',
                    'category_id' => 'required|exists:categories,id'

                ];

            case 'auction':  //for table users
                return [
                    'name' => 'required|string',
                    'location' => 'required|string',
                    'open_time' => 'required|string',
                    'close_time' => 'required|string',
                    'image1' => 'nullable | required',
                    'image2' => 'nullable',
                    'image3' => 'nullable',

                    // 'participate' => 'required|string',
                    'format' => 'required|string',

                    // 'auction_type' => 'required|string',
                    'site' => 'required|string',
                    'url' => 'required|string',
                ];

            case 'AuctionType':  //for table users
                return [
                    'name' => 'required|string',
                    'open_time' => 'required|string',
                    'close_time' => 'required|string',
                    'item_interval' => 'required|string',
                    'auction_id' =>  'required|exists:auctions,id',
                    'url' => 'required|string',
                ];
            case 'AuctionTime':  //for table users
                return [
                    'name' => 'required|string',
                    'open_time' => 'required|string',
                    'close_time' => 'required|string',
                    'item_interval' => 'required|string',
                    'auction_type_id' =>  'required|exists:auction_types,id',
                    'url' => 'required|string',
                ];
            case 'EquipmentCategory':  //for table users
                return [
                    'name' => 'required|string',
                    'auction_time_id' =>  'required|exists:auction_times,id',
                    'url' => 'required|string',
                ];



            case 'category':  //for table users
                return [

                    'name' => 'required|string',
                    'active' => 'required|string',
                    'featured' => 'required|string',
                    'url' => 'required|string',
                ];
            case 'attendance':   //for table attndances
                return [
                    'user_id' => 'required|',
                    'date' => 'required',
                    'status' => 'required',
                ];
            case 'PartGallary':   //for table attndances
                return [
                    'image'=> 'nullable|required',
                    'url' => 'required|string',
                    'part_id'  => 'required|exists:parts,id',
                ];
            case 'ProductGallary':   //for table attndances
                return [
                    'image'=> 'required',
                    'url' => 'required|string',
                    'product_id' => 'required|exists:products,id',
                ];
            case 'part':   //for table attndances
                return [
                    'name'=> 'nullable|string',
                    'description'=> 'nullable|string',
                    'url' => 'required|string',
                    'product_id' => 'required|exists:products,id',
                    'vendor_id' => 'required|exists:vendors,id',

                ];
            case 'product':   //for table attndances
                return [
                    'image'=> 'nullable',
                    'name'=> 'string',
                    // 'lot_number'=> 'string',
                    'country'=> 'string',
                    'city'=> 'string',
                    'meter'=> 'string',
                    'serial_number'=> 'string',
                    'features'=> 'string',
                    'note'=> 'string',
                    'year'=> 'string',
                    'manufacturer'=> 'string',
                    'asset_type'=> 'string',
                    // 'appearance'=> 'string',
                    'general'=> 'string',
                    'url' => 'required|string',
                    'function'=> 'string',
                    'dimension'=> 'string',
                    'actual_price'=> 'string',
                    'bid_price'=> 'string',
                    'equipmentcategory_id' => 'required|exists:equipment_categories,id',
                    'subcategory_id' => 'required|exists:sub_categories,id',
                    'auctiontype_id' => 'required|exists:auction_types,id',

                ];
            default:
                return [];
        }
    }
}
