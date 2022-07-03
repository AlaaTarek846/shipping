<?php
/*
 * =======================
 * Routs Dashboard
 * Route Mobile
 * =======================
 */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ========================Controller Auth User
use App\Http\Controllers\AuthUser\AuthController;
use App\Http\Controllers\AuthUser\AuthUserMobileController;
use App\Http\Controllers\AuthUser\PermissionsController;
use App\Http\Controllers\AuthUser\NewPasswordController;


// ========================Controller Dashboard
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\RepresentativeController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\ProvinceController;
use App\Http\Controllers\Dashboard\AreaController;
use App\Http\Controllers\Dashboard\JobController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\CompleteStatuseController;
use App\Http\Controllers\Dashboard\PaymentTypeController;
use App\Http\Controllers\Dashboard\TransportTypeController;
use App\Http\Controllers\Dashboard\ShipmentTypeController;
use App\Http\Controllers\Dashboard\ServiceTypeController;
use App\Http\Controllers\Dashboard\ShipmentController;
use App\Http\Controllers\Dashboard\ImportExportController;
use App\Http\Controllers\Dashboard\ShipmentStatusController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\ShipmentTransferController;
use App\Http\Controllers\Dashboard\ShippingAreaPriceController;
use App\Http\Controllers\Dashboard\StorageSystemController;
use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\PivotOfferStorageController;
use App\Http\Controllers\Dashboard\ConnectController;
use App\Http\Controllers\Dashboard\PickUpController;
use App\Http\Controllers\Dashboard\ComplainController;
use App\Http\Controllers\Dashboard\UserAllController;
use App\Http\Controllers\Dashboard\CompanyShippingsAreasPrices;
use App\Http\Controllers\Dashboard\AdditionalServiceController;
use App\Http\Controllers\Dashboard\WeightController;
use App\Http\Controllers\Dashboard\WeightCompanyController;
use App\Http\Controllers\Dashboard\CompanyAccountController;
use App\Http\Controllers\Dashboard\CompanyShipmentDetailsController;
use App\Http\Controllers\Dashboard\RepresentativeAreaController;
use App\Http\Controllers\Dashboard\RepresentativeMovesController;
use App\Http\Controllers\Dashboard\MessageRepresentativeController;
use App\Http\Controllers\Dashboard\StocksController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CompanyShipmentController;
use App\Http\Controllers\Dashboard\RepresentativeAccountController;
use App\Http\Controllers\Dashboard\TotalAccountController;
use App\Http\Controllers\Dashboard\ReasonController;
use App\Http\Controllers\Dashboard\RepresentativeShipmentController;
use App\Http\Controllers\Dashboard\TreasurieController;
use App\Http\Controllers\Dashboard\IncomeController;
use App\Http\Controllers\Dashboard\ExpenseController;
use App\Http\Controllers\Dashboard\IncomeAndExpenseController;
use App\Http\Controllers\Dashboard\TransferringTreasuryController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\AdvertisementController;
use App\Http\Controllers\Dashboard\FirebaseController;
use App\Http\Controllers\Dashboard\MapController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\FilterController;
use App\Http\Controllers\Dashboard\RepresentativeExpenseController;
use App\Http\Controllers\Dashboard\ApiController;
use App\Http\Controllers\Dashboard\SuperAdminController;
use App\Http\Controllers\Dashboard\PackageController;
use App\Http\Controllers\Dashboard\PackageDetailController;
use App\Http\Controllers\Dashboard\PackageUserController;




// ========================Controller Mobile
use App\Http\Controllers\Mobile\AllhipmentController;
use App\Http\Controllers\Mobile\ShipmentTransferMController;
use App\Http\Controllers\Mobile\AllGetController;
use App\Http\Controllers\Mobile\AllCompanyController;
use App\Http\Controllers\Mobile\AllRepresentativeController;
use App\Http\Controllers\Mobile\DetailShipmentRepresentativeShipmentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
 * ===== Start Routs Dashboard
 * ===== New Route Api From 7-3-2022
 */
    Route::post('dashboard/login', [AuthController::class, 'login']);

    Route::post('dashboard/forgotPassword', [NewPasswordController::class, 'forgotPassword']);

    Route::post('dashboard/reset', [NewPasswordController::class, 'reset']);

    Route::get('getDownload', [AuthController::class, 'getDownload']);

    Route::post('store-shipment', [ApiController::class, 'store']);

    Route::get('date_area', [ApiController::class, 'api_area_shipment']);

    Route::get('date_service_type', [ApiController::class, 'api_service_type']);

    Route::get('date_shipment', [ApiController::class, 'index']);

    Route::get('dashboard/all-Package', [PackageDetailController::class, 'index']);

    Route::post('dashboard/create-PackageUser/{id}', [PackageUserController::class, 'store']);

    Route::post('dashboard/update-PackageUser/{id}', [PackageUserController::class, 'update']);

/*=========
  * *= Start Rout  Ligon Dashboard
*/
    Route::group(['middleware' => ['checkdashboard','admin'], 'prefix' => 'dashboard'], function ($router) {

        /*===  Route Login Dashboard    ====*/
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/update-profile/{id}', [AuthController::class, 'updateProfile']);
        Route::post('/change-Password', [AuthController::class, 'changePassword']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('change-Password-user-profile', [NewPasswordController::class, 'changePasswordtwo']);

        /*===  Start Rout  Admin User    ====*/
        Route::get('all-super-admin', [SuperAdminController::class, 'index']);
        Route::post('create-super-admin', [SuperAdminController::class, 'store']);
        Route::post('update-super-admin/{id}', [SuperAdminController::class, 'update']);
        Route::post('show-super-admin/{id}', [SuperAdminController::class, 'show']);
        Route::post('destroy-super-admin/{id}', [SuperAdminController::class, 'destroy']);

        /*===  Route Post permissions    ====*/
        Route::post('user/{user}/syncPermissions', [PermissionsController::class, 'syncPermissions']);

        /*===  Route Get permissions    ====*/
        Route::get('permissions', [PermissionsController::class, 'getPermissions']);

        /*===  Start Rout  Client User    ====*/
        Route::get('all-client', [ClientController::class, 'index']);
        Route::post('create-client', [ClientController::class, 'store']);
        Route::post('update-client/{id}', [ClientController::class, 'update']);
        Route::post('show-client/{id}', [ClientController::class, 'show']);
        Route::post('destroy-client/{id}', [ClientController::class, 'destroy']);

        /*===  Start Rout    Company User    ====*/
        Route::get('all-company', [CompanyController::class, 'index']);
        Route::get('all-notification_company', [CompanyController::class, 'index_notification_company']);
        Route::post('create-company', [CompanyController::class, 'store']);
        Route::post('update-company/{id}', [CompanyController::class, 'update']);
        Route::post('show-company/{id}', [CompanyController::class, 'show']);
        Route::post('destroy-company/{id}', [CompanyController::class, 'destroy']);

        /*===  Start Rout  Admin User    ====*/
        Route::get('all-admin', [AdminController::class, 'index']);
        Route::post('create-admin', [AdminController::class, 'store']);
        Route::post('update-admin/{id}', [AdminController::class, 'update']);
        Route::post('show-admin/{id}', [AdminController::class, 'show']);
        Route::post('destroy-admin/{id}', [AdminController::class, 'destroy']);

        /*===  Start Rout  Representative User    ====*/
        Route::get('all-representative', [RepresentativeController::class, 'index']);
        Route::post('create-representative', [RepresentativeController::class, 'store']);
        Route::post('update-representative/{id}', [RepresentativeController::class, 'update']);
        Route::post('show-representative/{id}', [RepresentativeController::class, 'show']);
        /*=======*/
        Route::post('destroy-representative/{id}', [RepresentativeController::class, 'destroy']);

        /*===  Start Rout  Employee User    ====*/
        Route::get('all-employees', [EmployeeController::class, 'index']);
        Route::post('create-employees', [EmployeeController::class, 'store']);
        Route::post('update-employees/{id}', [EmployeeController::class, 'update']);
        Route::post('show-employees/{id}', [EmployeeController::class, 'show']);
        Route::post('destroy-employees/{id}', [EmployeeController::class, 'destroy']);
        Route::post('changeRole', [EmployeeController::class, 'changeRole']);

        /*===  Start Rout Countries    ====*/
        Route::put('countries/{id}', [CountryController::class, 'update']);
        Route::delete('countries/{id}', [CountryController::class, 'destroy']);
        Route::Resource('countries', CountryController::class);

        /*===  Start Rout provinces    ====*/
        Route::put('provinces/{id}', [ProvinceController::class, 'update']);
        Route::delete('provinces/{id}', [ProvinceController::class, 'destroy']);
        Route::Resource('provinces', ProvinceController::class);

        /*===  Start Rout Areas    ====*/
        Route::get('areas/{id}', [AreaController::class, 'show']);
        Route::put('areas/{id}', [AreaController::class, 'update']);
        Route::delete('areas/{id}', [AreaController::class, 'destroy']);
        Route::Resource('areas', AreaController::class);
        /*=======*/
        Route::get('governorate', [AreaController::class, 'governorate']);
        Route::get('areaShipmentPrice/{id}', [AreaController::class, 'area_shipment_price']);
        Route::get('cityGovernorate/{id}', [AreaController::class, 'cityGovernorate']);

        /*===  Start Rout Jobs    ====*/
        Route::put('jobs/{id}', [JobController::class, 'update']);
        Route::delete('jobs/{id}', [JobController::class, 'destroy']);
        Route::Resource('jobs', JobController::class);

        /*===  Start Rout Department    ====*/
        Route::put('departments/{id}', [DepartmentController::class, 'update']);
        Route::delete('departments/{id}', [DepartmentController::class, 'destroy']);
        Route::Resource('departments', DepartmentController::class);

        /*===  Start Rout Branches    ====*/
        Route::put('branches/{id}', [BranchController::class, 'update']);
        Route::delete('branches/{id}', [BranchController::class, 'destroy']);
        Route::Resource('branches', BranchController::class);

        /*===  Start Rout Complete Statuse    ====*/
        Route::put('complete_statuse/{id}', [CompleteStatuseController::class, 'update']);
        Route::delete('complete_statuse/{id}', [CompleteStatuseController::class, 'destroy']);
        Route::Resource('complete_statuse', CompleteStatuseController::class);

        /*===  Start Rout Payment Type    ====*/
        Route::put('payment_type/{id}', [PaymentTypeController::class, 'update']);
        Route::delete('payment_type/{id}', [PaymentTypeController::class, 'destroy']);
        Route::Resource('payment_type', PaymentTypeController::class);

        /*===  Start Rout Transport Type    ====*/
        Route::put('transport_type/{id}', [TransportTypeController::class, 'update']);
        Route::delete('transport_type/{id}', [TransportTypeController::class, 'destroy']);
        Route::Resource('transport_type', TransportTypeController::class);

        /*===  Start Rout Shipment Types    ====*/
        Route::put('shipment_type/{id}', [ShipmentTypeController::class, 'update']);
        Route::delete('shipment_type/{id}', [ShipmentTypeController::class, 'destroy']);
        Route::Resource('shipment_type', ShipmentTypeController::class);

        /*===  Start Rout Shipment Status    ====*/
        Route::get('shipment_status', [ShipmentStatusController::class, 'index']);
        Route::post('changeShipmentsStatus', [ShipmentStatusController::class, 'changeShipmentsStatus']);

        /*===  Start Rout Service Type    ====*/
        Route::put('service_type/{id}', [ServiceTypeController::class, 'update']);
        Route::delete('service_type/{id}', [ServiceTypeController::class, 'destroy']);
        Route::Resource('service_type', ServiceTypeController::class);

        /*===  Start Rout Store   ====*/
        Route::put('store/{id}', [StoreController::class, 'update']);
        Route::delete('store/{id}', [StoreController::class, 'destroy']);
        Route::Resource('store', StoreController::class);

        /*===  Start Rout Shipment Transfer   ====*/
        Route::delete('shipment_transfer/{id}', [ShipmentTransferController::class, 'destroy']);
        Route::Resource('shipment_transfer', ShipmentTransferController::class);
        Route::post('update-shipment_transfer', [ShipmentTransferController::class, 'update']);
        /*=======*/
        Route::post('changeShipmentTransfersStatus', [ShipmentTransferController::class, 'changeShipmentTransfersStatus']);

        /*===  Start Rout Shipment  Company====*/
        Route::get('shipment-current', [CompanyShipmentController::class, 'getshipmentcurrent']);
        Route::get('shipment-send', [CompanyShipmentController::class, 'getshipmentsent']);
        Route::get('shipment-finished', [CompanyShipmentController::class, 'getshipmentfinished']);
        Route::post('search_date_current', [CompanyShipmentController::class, 'searchdatecurrent']);
        Route::post('search_date_sent', [CompanyShipmentController::class, 'searchdatesent']);
        Route::post('search_date_finished', [CompanyShipmentController::class, 'searchdatefinished']);
        /*=======*/
        Route::post('create-shipment-company', [CompanyShipmentController::class, 'store']);
        Route::get('all-shipment-company', [CompanyShipmentController::class, 'index']);
        Route::post('show-shipment-company/{id}', [CompanyShipmentController::class, 'show']);
        Route::post('update-shipment-company/{id}', [CompanyShipmentController::class, 'update']);

        /*===  Start Rout Shipment   ====*/
        Route::get('all-shipment', [ShipmentController::class, 'index']);
        Route::get('edit_representative/{id}', [ShipmentController::class, 'edit_representative']);
        Route::post('create-shipment', [ShipmentController::class, 'store']);
        Route::post('update-shipment/{id}', [ShipmentController::class, 'update']);
        Route::post('update-shipment_representatives', [ShipmentController::class, 'update_shipment_representatives']);
        Route::post('show-shipment/{id}', [ShipmentController::class, 'show']);
        Route::post('destroy-shipment/{id}', [ShipmentController::class, 'destroy']);

        /*===  Start Rout Import Shipment   ====*/
        Route::post('/import-shipment/{user_id}', [ImportExportController::class, 'import']);
//        Route::get('/export-shipment',[ImportExportController::class,'exportUsers']);

        /*===  Start Rout Shipping Area Price   ====*/
        Route::put('shipping-area-price/{id}', [ShippingAreaPriceController::class, 'update']);
        Route::delete('shipping-area-price/{id}', [ShippingAreaPriceController::class, 'destroy']);
        Route::Resource('shipping-area-price', ShippingAreaPriceController::class);

        /*===  Start Rout Shipping Storage System   ====*/
        Route::put('storage-system/{id}', [StorageSystemController::class, 'update']);
        Route::delete('storage-system/{id}', [StorageSystemController::class, 'destroy']);
        Route::Resource('storage-system', StorageSystemController::class);

        /*===  Start Rout Shipping Offer   ====*/
        Route::put('offer/{id}', [OfferController::class, 'update']);
        Route::delete('offer/{id}', [OfferController::class, 'destroy']);
        Route::Resource('offer', OfferController::class);

        /*===  Start Rout Pivot Offer and Storage System   ====*/
        Route::post('Pivot-storage-system', [PivotOfferStorageController::class, 'store']);
        Route::post('Pivot-offer', [PivotOfferStorageController::class, 'storeoffer']);

        Route::get('all_Offer_Company', [PivotOfferStorageController::class, 'index_offer_company']);
        Route::get('all_Storage_system_Company', [PivotOfferStorageController::class, 'index_storage_system_company']);

        Route::get('all_Offer', [PivotOfferStorageController::class, 'index_offer']);
        Route::get('all_Storage_system', [PivotOfferStorageController::class, 'index_storage_system']);


        /*===  Start Rout pickup   ====*/
        Route::put('pickup/{id}', [PickUpController::class, 'update']);
        Route::delete('pickup/{id}', [PickUpController::class, 'destroy']);
        Route::Resource('pickup', PickUpController::class);
        /*=======*/
        Route::post('pickup-status_active/{id}', [PickUpController::class, 'status_active']);
        Route::get('all_pickUp_active', [PickUpController::class, 'all_pickUp_active']);
    //    Route::get('all-user-active', [PickUpController::class, 'all_user_active']);

        /*===  Start Rout company shipping area price   ====*/
        Route::put('company-area/{id}', [CompanyShippingsAreasPrices::class, 'update']);
        Route::delete('company-area/{id}', [CompanyShippingsAreasPrices::class, 'destroy']);
        Route::Resource('company-area', CompanyShippingsAreasPrices::class);
        /*=======*/
        Route::get('all-company-area/{id}', [CompanyShippingsAreasPrices::class, 'index']);
    //    Route::get('all-company-area/{id}', [UserAllController::class, 'index']);
    //    Route::post('create-connect-shipment', [CompanyShippingsAreasPrices::class, 'store']);

        /*===  Start Rout connect shipment   ====*/
        Route::get('all-connect-shipment', [ConnectController::class, 'index']);
        Route::post('create-connect-shipment', [ConnectController::class, 'store']);
        Route::post('update-connect-shipment/{id}', [ConnectController::class, 'update']);

        /*===  Start Rout Complain   ====*/
        Route::get('allStatusNoactiveUp', [ComplainController::class, 'allStatusNoactiveUp']);
        Route::get('allStatusUp', [ComplainController::class, 'allStatusUp']);
        /*=======*/
        Route::post('status_active_pickup/{id}', [PickUpController::class, 'status_active']);
        Route::post('complain-status-active/{id}', [ComplainController::class, 'status_active']);
        Route::get('all-complain-active', [ComplainController::class, 'all_complain_active']);
        Route::get('allStatusNoactive', [ComplainController::class, 'allStatusNoactive']);
        Route::get('allStatusComplain', [ComplainController::class, 'allStatus']);
        Route::Resource('complain', ComplainController::class);

        /*===  Start Rout User All   ====*/
        Route::get('all-user', [UserAllController::class, 'alluser']);
        Route::get('all-user-active', [UserAllController::class, 'all_user_active']);
        Route::get('all-user-no-active', [UserAllController::class, 'all_user_no_active']);
        Route::get('all-user-company', [UserAllController::class, 'all_user_company']);
        Route::post('active-user/{id}', [UserAllController::class, 'active_user']);
        Route::post('no-active-user/{id}', [UserAllController::class, 'no_active_user']);

        /*===  Start Rout Additional Service   ====*/
        Route::put('additional-service/{id}', [AdditionalServiceController::class, 'update']);
        Route::delete('additional-service/{id}', [AdditionalServiceController::class, 'destroy']);
        Route::Resource('additional-service', AdditionalServiceController::class);

        /*===  Start Rout weight shipment   ====*/
        Route::put('weight/{id}', [WeightController::class, 'update']);
        Route::delete('weight/{id}', [WeightController::class, 'destroy']);
        Route::Resource('weight', WeightController::class);

        /*===  Start Rout weight company shipment   ====*/
        Route::put('weight-company/{id}', [WeightCompanyController::class, 'update']);
        Route::delete('weight-company/{id}', [WeightCompanyController::class, 'destroy']);
        Route::Resource('weight-company', WeightCompanyController::class);
        Route::get('all-weight-company/{id}', [WeightCompanyController::class, 'index']);

        /*===  Start Rout Company Account   ====*/
        Route::put('company-account/{id}', [CompanyAccountController::class, 'update']);
        Route::delete('company-account/{id}', [CompanyAccountController::class, 'destroy']);
        Route::Resource('company-account', CompanyAccountController::class);
        /*=======*/
        Route::post('representative_account', [RepresentativeAccountController::class, 'store']);

        /*===  Start Rout Company Shipment Details   ====*/
        Route::put('company_shipment_detail/{id}', [CompanyShipmentDetailsController::class, 'update']);
        Route::delete('company_shipment_detail/{id}', [CompanyShipmentDetailsController::class, 'destroy']);
        Route::Resource('company_shipment_detail', CompanyShipmentDetailsController::class);
        Route::get('all-company_shipment_detail', [CompanyShipmentDetailsController::class, 'all_Company_Shipment_Detail']);

        /*===  Start Rout Representative Area   ====*/
        Route::put('representative-area/{id}', [RepresentativeAreaController::class, 'update']);
        Route::delete('representative-area/{id}', [RepresentativeAreaController::class, 'destroy']);
        Route::Resource('representative-area', RepresentativeAreaController::class);

        /*===  Start Rout Representative Moves   ====*/
        Route::put('representative-moves/{id}', [RepresentativeMovesController::class, 'update']);
        Route::delete('representative-moves/{id}', [RepresentativeMovesController::class, 'destroy']);
        Route::Resource('representative-moves', RepresentativeMovesController::class);
        /*=======*/
        Route::get('all-representative-moves', [CompanyShipmentDetailsController::class, 'all-representative-moves']);

        /*===  Start Rout Message Representative  ====*/
        Route::put('message_representative/{id}', [MessageRepresentativeController::class, 'update']);
        Route::delete('message_representative/{id}', [MessageRepresentativeController::class, 'destroy']);
        Route::Resource('message_representative', MessageRepresentativeController::class);
        /*=======*/
        Route::get('all-message_representative', [MessageRepresentativeController::class, 'all-representative-moves']);

        /*===  Start Rout stock  ====*/
        Route::put('stock/{id}', [StocksController::class, 'update']);
        Route::delete('stock/{id}', [StocksController::class, 'destroy']);
        Route::Resource('stock', StocksController::class);

        /*===  Start Rout Total Account Admin   ====*/
        Route::get('total-shipment-day', [TotalAccountController::class, 'index']);
        Route::get('Statu_Shipment', [TotalAccountController::class, 'index_stuts_shipment']);
        Route::get('count_shipment_month', [TotalAccountController::class, 'index_count_month_shipment']);
        Route::get('count_shipment_year', [TotalAccountController::class, 'index_count_year_shipment']);
        Route::get('total_shipment_month', [TotalAccountController::class, 'month_shipment']);
        Route::get('total_Year_shipment', [TotalAccountController::class, 'Year_shipment']);
        Route::get('customer', [TotalAccountController::class, 'customer']);
        Route::get('count_all_statu', [TotalAccountController::class, 'count_all']);

        /*===  Start Rout Total Account company   ====*/
        Route::get('total-shipment-day_company/{id}', [TotalAccountController::class, 'index_Company']);
        Route::get('index_stuts_shipment_company/{id}', [TotalAccountController::class, 'index_stuts_shipment_company']);
        Route::get('index_count_month_shipment_company/{id}', [TotalAccountController::class, 'index_count_month_shipment_company']);
        Route::get('index_count_year_shipment_company/{id}', [TotalAccountController::class, 'index_count_year_shipment_company']);
        Route::get('month_shipment_company/{id}', [TotalAccountController::class, 'month_shipment_company']);
        Route::get('Year_shipment_company/{id}', [TotalAccountController::class, 'Year_shipment_company']);
        Route::get('customer_company/{id}', [TotalAccountController::class, 'customer_company']);
        Route::get('count_company_statu/{id}', [TotalAccountController::class, 'count_Company']);

        /*===  Start Rout Firebase   ====*/
        Route::Post('firebase_message', [FirebaseController::class, 'store']);

        /*===  Start Rout Reason   ====*/
        Route::put('reason/{id}', [ReasonController::class, 'update']);
        Route::delete('reason/{id}', [ReasonController::class, 'destroy']);
        Route::Resource('reason', ReasonController::class);

        /*===  Start Rout Message   ====*/
        Route::put('message/{id}', [MessageController::class, 'update']);
        Route::delete('message/{id}', [MessageController::class, 'destroy']);
        Route::Resource('message', MessageController::class);

        /*===  Start Rout Advertisement   ====*/
        Route::put('advertisement/{id}', [AdvertisementController::class, 'update']);
        Route::delete('advertisement/{id}', [AdvertisementController::class, 'destroy']);
        Route::Resource('advertisement', AdvertisementController::class);

        /*===  Start Rout Treasurie   ====*/
        Route::get('allTreasuries', [TreasurieController::class, 'index_treasuries']);
        Route::get('id_children_treasuries/{id}', [TreasurieController::class, 'id_children_treasuries']);
        /*=========*/
        Route::put('Treasurie/{id}', [TreasurieController::class, 'update']);
        Route::delete('Treasurie/{id}', [TreasurieController::class, 'destroy']);
        Route::Resource('Treasurie', TreasurieController::class);
        /*=========*/
        Route::get('mainTreasury', [TreasurieController::class, 'mainTreasury']);

        /*===  Start Rout Income   ====*/
        Route::get('allIncome', [IncomeController::class, 'index_income']);
        /*=========*/
        Route::put('income/{id}', [IncomeController::class, 'update']);
        Route::delete('income/{id}', [IncomeController::class, 'destroy']);
        Route::Resource('income', IncomeController::class);
        /*=========*/
        Route::get('mainIncome', [IncomeController::class, 'mainIncome']);

        /*===  Start Rout Expense   ====*/
        Route::get('allexpense', [ExpenseController::class, 'index_expense']);
        /*=========*/
        Route::put('expense/{id}', [ExpenseController::class, 'update']);
        Route::delete('expense/{id}', [ExpenseController::class, 'destroy']);
        Route::Resource('expense', ExpenseController::class);
        /*=========*/
        Route::get('mainExpense', [ExpenseController::class, 'mainExpense']);

        /*===  Start Rout Income And Expense   ====*/
        Route::put('income_and_expense/{id}', [IncomeAndExpenseController::class, 'update']);
        Route::delete('income_and_expense/{id}', [IncomeAndExpenseController::class, 'destroy']);
        Route::Resource('income_and_expense', IncomeAndExpenseController::class);
        /*=========*/
        Route::post('filter_income_and_expense', [IncomeAndExpenseController::class, 'felltr_income_and_expense']);
        Route::get('income_and/{id}', [IncomeAndExpenseController::class, 'index_income']);
        Route::get('and_expense/{id}', [IncomeAndExpenseController::class, 'index_expense']);

        /*===  Start Rout Transferring Treasury   ====*/
        Route::put('transferring_treasury/{id}', [TransferringTreasuryController::class, 'update']);
        Route::delete('transferring_treasury/{id}', [TransferringTreasuryController::class, 'destroy']);
        Route::Resource('transferring_treasury', TransferringTreasuryController::class);

        /*===  Start Rout Account Representative   ====*/
        Route::get('details_account_representative/{id}', [RepresentativeShipmentController::class, 'index']);
        Route::get('day_total_representative', [RepresentativeShipmentController::class, 'Representative_Account_Detail']);
        Route::get('filter_day_total_representative', [RepresentativeShipmentController::class, 'Filter_Representative_Account_Detail']);
        Route::get('account_detail_representative/{id}', [RepresentativeShipmentController::class, 'index_account']);
        Route::get('total_account/{id}', [RepresentativeShipmentController::class, 'Total_account']);

        /*===  Start Rout Company Shipment Details  ====*/
        Route::get('company_detail/{id}', [CompanyShipmentDetailsController::class, 'index_detail']);
        Route::get('account_detail/{id}', [CompanyShipmentDetailsController::class, 'index_account']);
        Route::get('total_account_company/{id}', [CompanyShipmentDetailsController::class, 'total_account']);

        /*===  Start Rout MapController   ====*/
        Route::put('map/{id}', [MapController::class, 'update']);
        Route::delete('map/{id}', [MapController::class, 'destroy']);
        Route::Resource('map', MapController::class);

        /*===  Start Rout representative_expense   ====*/
        Route::get('representative_expense_filter', [RepresentativeExpenseController::class, 'index_filter']);
        Route::put('representative_expense/{id}', [RepresentativeExpenseController::class, 'update']);
        Route::delete('representative_expense/{id}', [RepresentativeExpenseController::class, 'destroy']);
        Route::Resource('representative_expense', RepresentativeExpenseController::class);

        Route::get('all-role', [RoleController::class, 'index']);

        Route::get('notification_company', [CompanyController::class, 'index_notification_company']);

        Route::get('notification_representative', [RepresentativeController::class, 'index_notification_representative']);

        Route::post('filter_collection_representative', [FilterController::class, 'filter_collection_representative']);
        Route::post('filter_collection_shipment_status', [FilterController::class, 'filter_collection_shipment_status']);
        Route::post('filter_collection_shipment_date', [FilterController::class, 'filter_collection_shipment_date']);
        Route::post('filter_collection_shipment_to_day', [FilterController::class, 'filter_collection_shipment_to_day']);

        Route::post('updateUsreApiK/{id}', [ApiController::class, 'update']);


        Route::put('Package/{id}', [PackageController::class, 'update']);
        Route::delete('Package/{id}', [PackageController::class, 'destroy']);
        Route::Resource('Package', PackageController::class);

        Route::put('packageDetail/{id}', [PackageDetailController::class, 'update']);
        Route::delete('packageDetail/{id}', [PackageDetailController::class, 'destroy']);
        Route::Resource('packageDetail', PackageDetailController::class);

        Route::put('PackageUser/{id}', [PackageUserController::class, 'update']);
        Route::delete('PackageUser/{id}', [PackageUserController::class, 'destroy']);
        Route::Resource('PackageUser', PackageUserController::class);


        /*===  Start Rout  Admin User    ====*/
        Route::get('all-PackageUser', [PackageUserController::class, 'index']);



    });


/*
 * ===== ENd Routs
 * ===== New Route Api From
 */
//========================================
/*
 * ===== Start Routs Mobile
 * ===== New Route Api From
 */

/*=========
  ***** = Forgot password Login Mobile
*/
    Route::post('mobile/forgotpassword', [AuthUserMobileController::class, 'forgotpassword']);
    Route::post('mobile/login', [AuthUserMobileController::class, 'login']);
    Route::post('mobile/check-phone', [AuthUserMobileController::class, 'checkphone']);

    Route::get('mobile/out-province-area-shipment', [AllhipmentController::class, 'province_area']);

    /*===  route used in register client &  company      ====*/
    Route::get('mobile/city', [AllGetController::class, 'index']);

    /*===  route used in register  company      ====*/
    Route::post('mobile/register-company', [AuthUserMobileController::class, 'registercompany']);

    /*===  route used in register  client       ====*/
    Route::post('mobile/register', [AuthUserMobileController::class, 'register']);

    /*===  route used in login  Representative  ====*/
    Route::post('mobile/loginRepresentative', [AuthUserMobileController::class, 'loginRepresentative']);


    /*=========
       ***** = Group Mobile
    */

    Route::group(['middleware' => ['checkmobile','admin'], 'prefix' => 'mobile'], function ($router) {


        Route::post('/logout', [AuthUserMobileController::class, 'logout']);
        Route::post('/refresh', [AuthUserMobileController::class, 'refresh']);
        Route::post('/change-Password', [AuthUserMobileController::class, 'changePassword']);
        Route::get('/user-profile', [AuthUserMobileController::class, 'userProfile']);

        /*===  route used in update  client          ====*/
        Route::post('/update-profile/{id}', [AuthUserMobileController::class, 'updateProfile']);

        /*===  route used in update   company        ====*/
        Route::post('/update-company-profile/{id}', [AuthUserMobileController::class, 'update_company_Profile']);

        /*===  route used in update representative   ====*/
        Route::post('/update_representative/{id}', [AuthUserMobileController::class, 'update_representative']);


        /*===  Import Shipment  Mobile   ====*/
        Route::post('/import-shipment/{user_id}', [ImportExportController::class, 'import']);

        /*=========
         ***** = Create Shipment  Mobile
        */
        Route::get('province-area-shipment', [AllhipmentController::class, 'province_area']);
        Route::get('service-type-shipment', [AllhipmentController::class, 'service_type']);
        Route::get('shipment_statu-shipment', [AllhipmentController::class, 'shipment_statu']);
        Route::get('additional-service', [AllhipmentController::class, 'additionalService']);
        Route::get('all-shipment', [AllhipmentController::class, 'index']);
        Route::post('create-shipment', [AllhipmentController::class, 'store']);
        Route::post('update-shipment/{id}', [AllhipmentController::class, 'update']);
        Route::post('show-shipment/{id}', [AllhipmentController::class, 'show']);
        Route::post('destroy-shipment/{id}', [AllhipmentController::class, 'destroy']);
        Route::get('reason', [ReasonController::class, 'index']);


        /*===  Route province & Area price   ====*/
        Route::get('area_shipment', [AllhipmentController::class, 'area_shipment']);

        /*===  Route count  shipment Status Chart  ====*/
        Route::get('shipmentStatusChart', [AllhipmentController::class, 'shipmentStatusChart']);

        /*===  Route All  shipment return  Status 8,9,10,11    ====*/
        Route::get('shipmentreturn', [AllhipmentController::class, 'index_return']);


        /*=========
          ***** =  Add  Request  Mobile
        */
        Route::get('all-transport-type', [PickUpController::class, 'transporttype']);

        /*===  Route Pick Up    ====*/
        Route::put('pickup/{id}', [PickUpController::class, 'update']);
        Route::delete('pickup/{id}', [PickUpController::class, 'destroy']);
        Route::Resource('pickup', PickUpController::class);

        /*===  Route Connect    ====*/
        Route::get('all-connect', [ConnectController::class, 'index']);

        /*===  Route complain    ====*/
        Route::put('complain/{id}', [ComplainController::class, 'update']);
        Route::delete('complain/{id}', [ComplainController::class, 'destroy']);
        Route::Resource('complain', ComplainController::class);


        /*=========
          ***** =  offer &&  storage system  Mobile
        */
        Route::get('all-offer', [OfferController::class, 'index']);
        Route::get('all-storage-system', [StorageSystemController::class, 'index']);
        Route::post('pivot-create-storage-system', [PivotOfferStorageController::class, 'store']);
        Route::post('pivot-create-offer', [PivotOfferStorageController::class, 'storeoffer']);
        Route::get('getOfferCompany', [PivotOfferStorageController::class, 'getOfferCompany']);
        Route::get('getStoragesystem', [PivotOfferStorageController::class, 'getStoragesystem']);


        /*===  Route weight    ====*/
        Route::get('weight', [WeightController::class, 'index']);

        /*===  Route weight    ====*/
        Route::get('company_area_Price', [CompanyShippingsAreasPrices::class, 'company_area_Price']);


        /*===  Route Account Company    ====*/
        Route::get('all-company-account', [AllCompanyController::class, 'all_company_account']);


        /*===  Route Account  Representative & All  Shipment Statu ====*/
        Route::get('shipmentStatuRepresentative', [AllRepresentativeController::class, 'shipmentStatuRepresentative']);
        Route::get('shipmentRepresentative', [AllRepresentativeController::class, 'shipmentRepresentative']);
        Route::get('totalGetShipmentRepresentative', [AllRepresentativeController::class, 'totalGetShipmentRepresentative']);
        Route::get('representative_account', [RepresentativeAccountController::class, 'index']);
        Route::Post('shipmentRepresentativesearch', [AllRepresentativeController::class, 'shipmentRepresentativesearch']);
        Route::post('updateshipmentRepresentative/{id}', [RepresentativeAccountController::class, 'update']);
        Route::post('shipmentStatuFilter', [AllRepresentativeController::class, 'shipmentStatuFilter']);
        Route::get('shipmentStatu6', [AllRepresentativeController::class, 'shipmentStatu6']);

        /*===  Route Account  Representative & All  Shipment Statu ====*/
        Route::get('detail/{id}', [DetailShipmentRepresentativeShipmentController::class, 'index']);

        Route::get('all-Message', [MessageController::class, 'index']);
        Route::get('all-advertisement', [AdvertisementController::class, 'index']);

        /*===  Route Map ====*/
        Route::post('map', [MapController::class, 'store']);
        Route::get('all-map', [MapController::class, 'index']);

        Route::get('notification_company', [CompanyController::class, 'index_notification_company']);

        Route::get('notification_representative', [RepresentativeController::class, 'index_notification_representative']);


    });


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
