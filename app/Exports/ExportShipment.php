<?php

namespace App\Exports;

use App\Models\ImportShipmentt;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportShipment implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ImportShipmentt::all();
    }
}
