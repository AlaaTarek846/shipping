<?php

namespace App\Traits;

use App\Models\CompanyShipmentDetails;
use App\Models\DetailShipmentRepresentative;
use App\Models\RepresentativeAccountDetail;
use App\Models\RepresentativeArea;
use App\Models\Representative;
use App\Models\RepresentativeIncome;
use App\Models\Shipment;
use App\Models\ShipmentTransfer;

trait ShipmentTrait
{
    //calculate Status = 1
    public function calculateStatus1(Shipment $shipment)
    {
        $shipment->update([
            "store_id" => null,
            "representative_id" => null,
            "shipment_status_id" => 1,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = null;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 1;
        $data['store_id'] = null;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }

        //check calculate company
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }

        return 1;
    }

    //calculate Status = 2
    public function calculateStatus2(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 2,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 2;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }
        //check calculate company
        $calcIncome = RepresentativeIncome::where('shipment_id', $shipment->id)->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }

        return 1;
    }

    //calculate Status = 3
    public function calculateStatus3(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 3,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 3;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }
        //check calculate company
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }

        return 1;
    }

    //calculate Status = 4
    public function calculateStatus4(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 4,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 4;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }
        //check calculate company
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }

        return 1;
    }

    //calculate Status = 5
    public function calculateStatus5(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 5,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 5;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }
        //check calculate company
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }
        return 1;
    }

    //calculate Status = 6
    public function calculateStatus6(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 6,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 6;
        $data['store_id'] = $store_id;
        $this->createModel($data);


        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }

        //check calculate company
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }

        return 1;
    }

    //calculate Status = 7
    public function calculateStatus7(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 7,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 7;
        $data['store_id'] = $store_id;
        $this->createModel($data);


        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        $representative_commission = RepresentativeArea::where([
            ["area_id", $shipment->area_id],
            ["representative_id", $shipment->representative_id],
        ])->first();

        $representative_all_commission = Representative::where(
            "id", $shipment->representative_id,
        )->first();

        if ($representative_commission) {
            if ($calc) {
                $calc->update([
                    "collection_balance" => $shipment->total_shipment,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $shipment->total_shipment,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $representative_commission->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }
        } else {
            if ($calc) {
                $calc->update([
                    "collection_balance" => $shipment->total_shipment,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $shipment->total_shipment,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }

        }

        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {

            $calcCompany->update([
                "shipment_price" => $shipment->product_price,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);

        } else {

            CompanyShipmentDetails::create([
                "shipment_price" => $shipment->product_price,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        }
        //check calculate RepresentativeIncome
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->update([
                "amount" => $shipment->total_shipment,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }else{
            RepresentativeIncome::create([
                "amount" => $shipment->total_shipment,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }

        return 1;
    }

    //calculate Status = 8
    public function calculateStatus8(Shipment $shipment, $return_price, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 8,
            "return_price" => $return_price,
        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 8;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        $representative_commission = RepresentativeArea::where([
            ["area_id", $shipment->area_id],
            ["representative_id", $shipment->representative_id],
        ])->first();

        $representative_all_commission = Representative::where(
            "id", $shipment->representative_id,
        )->first();

        if ($representative_commission) {

            if ($calc) {
                $calc->update([
                    "collection_balance" => $shipment->return_price + $shipment->shipping_price,
                    "commission" => $representative_all_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $shipment->return_price + $shipment->shipping_price,
                    "commission" => $representative_all_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }

        } else {

            if ($calc) {
                $calc->update([
                    "collection_balance" => $shipment->return_price + $shipment->shipping_price,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $shipment->return_price + $shipment->shipping_price,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }

        }

        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->update([
                "shipment_price" => $shipment->return_price,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        } else {
            CompanyShipmentDetails::create([
                "shipment_price" => $shipment->return_price,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        }

        //check calculate RepresentativeIncome
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->update([
                "amount" => $shipment->return_price + $shipment->shipping_price,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }else{
            RepresentativeIncome::create([
                "amount" => $shipment->return_price + $shipment->shipping_price,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }

        return 1;
    }

    //calculate Status = 9
    public function calculateStatus9(Shipment $shipment, $return_price, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 9,
            "return_price" => $return_price,
        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 9;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        $representative_commission = RepresentativeArea::where([
            ["area_id", $shipment->area_id],
            ["representative_id", $shipment->representative_id],
        ])->first();

        $representative_all_commission = Representative::where(
            "id", $shipment->representative_id,
        )->first();

        if ($representative_commission) {
            if ($calc) {
                $calc->update([
                    "collection_balance" => $return_price,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $return_price,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }
        } else {
            if ($calc) {
                $calc->update([
                    "collection_balance" => $return_price,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $return_price,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }

        }

        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->update([
                "shipment_price" => $return_price - $shipment->shipping_price,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        } else {
            CompanyShipmentDetails::create([
                "shipment_price" => $return_price - $shipment->shipping_price,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        }

        //check calculate RepresentativeIncome
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->update([
                "amount" => $return_price,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }else{
            RepresentativeIncome::create([
                "amount" => $return_price,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }

        return 1;
    }

    //calculate Status = 10
    public function calculateStatus10(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 10,
        ]);

        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 10;
        $data['store_id'] = $store_id;
        $this->createModel($data);

        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        $representative_commission = RepresentativeArea::where([
            ["area_id", $shipment->area_id],
            ["representative_id", $shipment->representative_id],
        ])->first();

        $representative_all_commission = Representative::where(
            "id", $shipment->representative_id,
        )->first();
        if ($representative_commission) {
            if ($calc) {
                $calc->update([
                    "collection_balance" => $shipment->shipping_price,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $shipment->shipping_price,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }
        } else {
            if ($calc) {
                $calc->update([
                    "collection_balance" => $shipment->shipping_price,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => $shipment->shipping_price,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }
        }

        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->update([
                "shipment_price" => 0,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        } else {
            CompanyShipmentDetails::create([
                "shipment_price" => 0,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        }

        //check calculate RepresentativeIncome
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->update([
                "amount" => $shipment->shipping_price,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }else{
            RepresentativeIncome::create([
                "amount" => $shipment->shipping_price,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }

        return 1;
    }

    //calculate Status = 11
    public function calculateStatus11(Shipment $shipment, $store_id, $representative_id)
    {
        $shipment->update([
            "store_id" => $store_id,
            "representative_id" => $representative_id,
            "shipment_status_id" => 11,
        ]);


        $data = [];
        $data['representative_id'] = $representative_id;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 11;
        $data['store_id'] = $store_id;
        $this->createModel($data);
        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        $representative_commission = RepresentativeArea::where([
            ["area_id", $shipment->area_id],
            ["representative_id", $shipment->representative_id],
        ])->first();

        $representative_all_commission = Representative::where(
            "id", $shipment->representative_id,
        )->first();
        if ($representative_commission) {
            if ($calc) {
                $calc->update([
                    "collection_balance" => 0,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => 0,
                    "commission" => $representative_commission->receipt_commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }
        } else {
            if ($calc) {
                $calc->update([
                    "collection_balance" => 0,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            } else {
                RepresentativeAccountDetail::create([
                    "collection_balance" => 0,
                    "commission" => $representative_all_commission->commission,
                    "representative_id" => $shipment->representative_id,
                    "shipment_status_id" => $shipment->shipment_status_id,
                    "shipment_id" => $shipment->id,
                ]);
            }
        }

        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->update([
                "shipment_price" =>$shipment->shipping_price * -1,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        } else {
            CompanyShipmentDetails::create([
                "shipment_price" =>$shipment->shipping_price * -1,
                "company_id" => $shipment->user->company->id,
                "shipment_status_id" => $shipment->shipment_status_id,
                "shipment_id" => $shipment->id,
            ]);
        }

        //check calculate RepresentativeIncome
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->update([
                "amount" => 0,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }else{
            RepresentativeIncome::create([
                "amount" => 0,
                "representative_id" => $shipment->representative_id,
                "shipment_id" => $shipment->id,
            ]);

        }

        return 1;
    }


    //calculate Status = 12
    public function calculateStatus12(Shipment $shipment)
    {
        $shipment->update([
            "store_id" => null,
            "representative_id" => null,
            "shipment_status_id" => 12,
            "return_price" => 0.00,

        ]);

        $data = [];
        $data['representative_id'] = null;
        $data['shipment_id'] = $shipment->id;
        $data['shipment_status_id'] = 12;
        $data['store_id'] = null;
        $this->createModel($data);


        //check calculate wallet mandop
        $calc = RepresentativeAccountDetail::where([
            ['shipment_id', $shipment->id],
            ['representative_account_id', null],
        ])->first();

        if ($calc) {
            $calc->delete();
        }
        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }

        //check calculate company
        $calcCompany = CompanyShipmentDetails::where([
            ['shipment_id', $shipment->id],
            ['company_account_id', null],
        ])->first();

        if ($calcCompany) {
            $calcCompany->delete();
        }

        //check calculate company
        $calcIncome = RepresentativeIncome::where([
            ['shipment_id', $shipment->id],
        ])->first();

        if ($calcIncome) {
            $calcIncome->delete();
        }


        return 1;
    }

    //create model DetailShipmentRepresentative
    public function createModel($dateails_shipment){


        DetailShipmentRepresentative::create([

            'representative_id' => $dateails_shipment['representative_id'],
            'shipment_id' => $dateails_shipment['shipment_id'],
            'shipment_status_id' => $dateails_shipment['shipment_status_id'],
            'store_id' => $dateails_shipment['store_id'],
        ]);

        return 1;

    }


}
