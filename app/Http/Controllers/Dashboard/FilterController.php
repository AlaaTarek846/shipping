<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RepresentativeAccountDetail;
use App\Models\Shipment;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FilterController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;



    public function filter_collection_shipment_to_day(Request $request)
    {

        $get_all_Shipment = Shipment::
        where(function ($q) use($request){
            $q->when($request->date,function ($q){
                $q->whereDate('created_at', now()->format('Y-m-d'));
            });
        })
        ->where(function ($q) use($request){
            $q->when($request->start_date && $request->end_date,function ($q) use($request){
                $q->whereDate('created_at',">=",$request->start_date)
                ->whereDate('created_at',"<=",$request->end_date);

            });
        })->where(function ($q) use($request){
            $q->when($request->shipment_status_id ,function ($q) use($request){
               $q->where([['shipment_status_id',$request->shipment_status_id],['admin_id',$this->idAdmin()]]);
            });
        })->where(function ($q) use($request){
            $q->when($request->representative_id ,function ($q) use($request){
               $q->where([['representative_id',$request->representative_id],['admin_id',$this->idAdmin()]]);
            });
        })
        ->where(function ($q) use($request){
            $q->when($request->search,function ($q) use($request){
                $q
                ->whereHas('user',function ($q) use($request){
                    $q->whereHas('company',function ($q) use($request){
                        $q->where('name','like','%'.$request->search."%");
                    });
                })
                ->orWhereHas('client',function ($q) use($request){
                    $q->where('name','like','%'.$request->search."%")
                    ->orWhere('phone','like','%'.$request->search."%");
                })
                ->orWhereHas('area',function ($q) use($request){
                    $q->where('name','like','%'.$request->search."%");
                })
                ->orWhereHas('shipmentstatu',function ($q) use($request){
                    $q->where('name','like','%'.$request->search."%");
                })
                ->orWhereHas('serviceType',function ($q) use($request){
                    $q->where('type','like','%'.$request->search."%");
                })->orWhere('name_shipment','like','%'.$request->search."%");
            });

        })

            ->latest()->paginate(20);


        return $this->returnData('search_date', $get_all_Shipment, 'successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
