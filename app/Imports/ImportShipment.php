<?php

namespace App\Imports;

use App\Models\ImportShipmentt;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
class ImportShipment implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
//        Validator::make($row->toArray(), [
//            '*.company_name' => 'required|string',
//            '*.order_number' => 'nullable|integer',
//            '*.client_name' => 'required|string',
//            '*.client_code' => 'nullable|integer',
//            '*.area' => 'required|string',
//            '*.address' => 'required',
//            '*.phone' => 'required|min:11|unique:clients',
//            '*.phone_2' => 'nullable|min:11|unique:clients',
//            '*.email' => 'required',
//            '*.name_product' => 'required',
//            '*.description_product' => 'required',
//            '*.weight' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
//            '*.size' => 'nullable|integer',
//            '*.count' => 'nullable|integer',
//            '*.price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
//            '*.delivery_date' => 'nullable|date',
//            '*.notes' => 'nullable|string',
//            '*.service_types' => 'required|string',
//            '*.additional_service' => 'nullable|string',
//        ])->validate();


        if($row['area'] && $row['client_name'] && $row['phone'] && $row['price'] && $row['service_types'] ){
            return new ImportShipmentt([
//            'company_name' => $row['company_name'],
                'order_number' => $row['order_number'],
                'client_name' => $row['client_name'],
                'client_code' => $row['client_code'],
                'area' => $row['area'],
                'address' => $row['address'],
                'phone' => $row['phone'],
                'phone_2' => $row['phone_2'],
                'email' => $row['email'],
                'name_product' => $row['name_product'],
                'description_product' => $row['description_product'],
                'weight' => $row['weight'],
                'size' => $row['size'],
                'count' => $row['count'],
                'price' => $row['price'],
                'delivery_date' => $row['delivery_date'],
                'notes' => $row['notes'],
                'service_types' => $row['service_types'],
                'additional_service' => $row['additional_service'],
            ]);
        }else{
            return;
        }


//
//        'company_name' => $row['company_name'],
//            'order_number' => $row['order_number'],
//            'client_name' => $row['client_name'],
//            'client_code' => $row['client_code'],
//            'area' => $row['area'],
//            'address' => $row['address'],
//            'phone' => $row['phone'],
//            'phone_2' => $row['phone_2'],
//            'email' => $row['email'],
//            'name_product' => $row['name_product'],
//            'description_product' => $row['description_product'],
//            'weight' => $row['weight'],
//            'size' => $row['size'],
//            'price' => $row['price'],
//            'service_types' => $row['service_types'],
//            'notes' => $row['notes'],
    }
}
