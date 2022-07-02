<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
//            'users' => 'c,r,u,d',
//            'additional_services' => 'c,r,u,d',
//            'admins' => 'c,r,u,d',
//            'advertisements' => 'c,r,u,d',
//            'areas' => 'c,r,u,d',
//            'branches' => 'c,r,u,d',
//            'clients' => 'c,r,u,d',
//            'companies' => 'c,r,u,d',
//            'company_accounts' => 'c,r,u,d',
//            'company_shipment_details' => 'c,r,u,d',
//            'company_shipping_area_prices' => 'c,r,u,d',
//            'complains' => 'c,r,u,d',
//            'connects' => 'c,r,u,d',
//            'countries' => 'c,r,u,d',
//            'departments' => 'c,r,u,d',
//            'detail_shipment_representatives' => 'c,r,u,d',
//            'employees' => 'c,r,u,d',
//            'expenses' => 'c,r,u,d',
//            'incomes' => 'c,r,u,d',
//            'import_shipmentts' => 'c,r,u,d',
//            'jobs' => 'c,r,u,d',
//            'income_and_expenses' => 'c,r,u,d',
//            'maps' => 'c,r,u,d',
//            'messages' => 'c,r,u,d',
//            'message_representatives' => 'c,r,u,d',
//            'offers' => 'c,r,u,d',
//            'offer_companies' => 'c,r,u,d',
//            'payment_types' => 'c,r,u,d',
//            'pick_ups' => 'c,r,u,d',
//            'provinces' => 'c,r,u,d',
//            'reasons' => 'c,r,u,d',
//            'representatives' => 'c,r,u,d',
//            'representative_accounts' => 'c,r,u,d',
//            'representative_account_details' => 'c,r,u,d',
//            'representative_areas' => 'c,r,u,d',
//            'representative_moves' => 'c,r,u,d',
//            'shipments' => 'c,r,u,d',
//            'shipment_status' => 'c,r,u,d',
//            'shipment_transfers' => 'c,r,u,d',
//            'shipment_types' => 'c,r,u,d',
//            'shipping_area_prices' => 'c,r,u,d',
//            'storage_systems' => 'c,r,u,d',
//            'storage_system_companies' => 'c,r,u,d',
//            'stores' => 'c,r,u,d',
//            'transferring_treasuries' => 'c,r,u,d',
//            'transport_types' => 'c,r,u,d',
//            'treasuries' => 'c,r,u,d',
//            'weights' => 'c,r,u,d',
//            'weight_companies' => 'c,r,u,d',
        ],

        // صلاحية محاسب
        'accountant' => [],

        // صلاحية امين مخزن
        'Store_keeper' => [],

        // صلاحية خدمة عملاء
        'Customer_Service' => [],

        // صلاحية مشرف مناديب
        'Staff_Supervisor' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
