<?php

use App\Http\Controllers\Dashboard\V1\Auth\{LoginController, LogoutController, ResetPasswordController};

use App\Http\Controllers\Dashboard\V1\{AdminController,
    CalendarDayController,
    CeliacCardController,
    ClinicController,
    FaqController,
    FoodBasketRequestController,
    GuidanceManualController,
    HajjRequestController,
    JobRequestController,
    MedicalCenterController,
    MedicalConsultingController,
    NewsController,
    PatientAwarenessController,
    ReservationController,
    ScientificResearchController,
    SettingController,
    BannerController,
    BoardMemberController,
    BoardMemberMeetingController,
    CommitteeController,
    DonationController,
    CommitteeMemberController,
    ContactUsController,
    GeneralAssemblyMeetingController,
    GeneralAssemblyMemberController,
    GovernanceFileController,
    OrganizationalStructureMemberController,
    PermissionController,
    PositionController,
    RoleController,
    TranslatedBookController,
    UserController,
    GovernanceController,
    PartnerGroupController,
    PartnerController,
    PostController};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest:sanctum')->group(function () {

    Route::post('login', LoginController::class)->middleware('LoginThrottle:6,15');
    Route::group([ 'prefix' => 'reset-password' ], function () {
        Route::post('email-validation', [ ResetPasswordController::class, 'emailValidation' ]);
        Route::post('send-code', [ ResetPasswordController::class, 'sendCode' ]);
        Route::post('change-password', [ ResetPasswordController::class, 'changePassword' ]);
    });

});

Route::middleware([ 'auth:sanctum', 'dashboard' ])->group(function () {

    //-------------------------------------------------- Banner ---------------------------------------------------------
    Route::post('banners/change-activation/{banner}', [ BannerController::class, 'changeActivation' ]);
    Route::apiResource('banners', BannerController::class);


    //-------------------------------------------------- User ---------------------------------------------------------
    Route::post('users/change-activation/{user}', [ UserController::class, 'changeActivation' ]);
    Route::apiResource('users', UserController::class)->except([ 'update', 'store' ]);

    Route::post('posts/change-activation/{post}', [ PostController::class, 'changeActivation' ]);
    Route::apiResource('posts', PostController::class);

    Route::post('logout', LogoutController::class);
    //------------------------------------------------- Roles ----------------------------------------------------------
    Route::get('permissions', PermissionController::class);
    Route::post('roles/change-activation/{role}', [ RoleController::class, 'changeActivation' ]);
    Route::apiResource('roles', RoleController::class);
//------------------------------------------------- Partners -----------------------------------------------------------
    Route::apiResource('partner-groups', PartnerGroupController::class);
    Route::apiResource('partners', PartnerController::class);

//------------------------------------------------- Governance ---------------------------------------------------------
    Route::prefix('/governance-lists')->group(function () {
        Route::get('/files/{governanceList}', [ GovernanceFileController::class, 'index' ]);
        Route::apiResource('/files', GovernanceFileController::class)->except('index');
        Route::get('/', [ GovernanceController::class, 'index' ]);
        Route::get('/{governanceList}', [ GovernanceController::class, 'show' ]);
    });
//------------------------------------------------- Board of Directories -----------------------------------------------
    Route::prefix('/board-of-directories')->group(function () {
        Route::apiResource("members", BoardMemberController::class)->except('show');
        Route::apiResource('files', BoardMemberMeetingController::class);
    });
//------------------------------------------------- General Assembly ---------------------------------------------------
    Route::prefix('/general-assembly')->group(function () {
        Route::apiResource("members", GeneralAssemblyMemberController::class)->except('show');
        Route::apiResource('files', GeneralAssemblyMeetingController::class);
    });
//------------------------------------------------- Organizational Structure -------------------------------------------
    Route::prefix('/organizational-structure')->group(function () {
        Route::apiResource("members", OrganizationalStructureMemberController::class)->except('show');
    });
//------------------------------------------------- Committees ---------------------------------------------------------
    Route::prefix("/committees")->group(function () {
        Route::post('/update-all', [ CommitteeController::class, 'updateAll' ]);
        Route::controller(CommitteeMemberController::class)->prefix("members")->group(function () {
            Route::get("/{committee}", 'members');
            Route::post("/{committee}", 'store');
            Route::put("/{committee}/{member}", 'update');
            Route::delete("/{member}", 'destroy');
        });

    });

    Route::apiResource('committees', CommitteeController::class)->only('index', 'show', 'update');

//------------------------------------------------ Positions -----------------------------------------------------------
    Route::get('positions', [ PositionController::class, 'index' ]);
//------------------------------------------------ Contacts -----------------------------------------------------------
    Route::apiResource('contacts', ContactUsController::class)->only('index', 'update', 'destroy');
    //------------------------------------------------ donations -------------------------------------------------------
    Route::apiResource('donations', DonationController::class);
//------------------------------------------------ Settings -----------------------------------------------------------
    Route::get('about-settings', [ SettingController::class, 'index' ]);
    Route::put('about-settings', [ SettingController::class, 'update' ]);
    Route::get('general-settings', [ SettingController::class, 'getGeneralSettings' ]);
    Route::put('general-settings', [ SettingController::class, 'updateGeneralSettings' ]);

    Route::get('clinic-settings', [ SettingController::class, 'getClinicSettings' ]);
    Route::put('clinic-settings', [ SettingController::class, 'updateClinicSettings' ]);

    Route::get('about-the-disease-settings', [ SettingController::class, 'getAboutTheDiseaseSettings' ]);
    Route::put('about-the-disease-settings', [ SettingController::class, 'updateAboutTheDiseaseSettings' ]);

    Route::get('information-about-treatment', [ SettingController::class, 'getInformationAboutTreatment' ]);
    Route::put('information-about-treatment', [ SettingController::class, 'updateInformationAboutTreatment' ]);

//----------------------------------------------- Admin ----------------------------------------------------------------
    Route::post('admins/change-activation/{admin}', [ AdminController::class, 'changeActivation' ]);
    Route::apiResource('admins', AdminController::class);

    //------------------------------------------------ Consulting Services -------------------------------------------------
    Route::get('medical-consulting', [ MedicalConsultingController::class, 'index' ]);

    //-------------------------------------------------- Scientific Research -------------------------------------------
    Route::apiResource('scientific-researches', ScientificResearchController::class);
    //-------------------------------------------------- Translated Book -------------------------------------------
    Route::apiResource('translated-books', TranslatedBookController::class);
    //-------------------------------------------------- Guidance Manual -------------------------------------------
    Route::apiResource('guidance-manual', GuidanceManualController::class);
    //-------------------------------------------------- Patient Awareness -------------------------------------------
    Route::apiResource('patient-awareness', PatientAwarenessController::class);

    //-------------------------------------------------- Clinic -------------------------------------------
    Route::post('clinics/change-activation/{clinic}', [ ClinicController::class, 'changeActivation' ]);
    Route::apiResource('clinics', ClinicController::class);

    //-------------------------------------------------- Calendar Day -------------------------------------------
    Route::controller(CalendarDayController::class)->prefix('calendar-days')->group(function () {
        Route::get('list', 'list');
        Route::post('enable-days', 'enableDays');
        Route::post('disable-days', 'disableDays');
    });

    //-------------------------------------------------- Faq Awareness -------------------------------------------
    Route::apiResource('faqs', FaqController::class);


    //-------------------------------------------------- Reservations -------------------------------------------
    Route::post('cancel-reservation/{reservation}', [ ReservationController::class, 'cancel' ]);
    Route::apiResource('reservations', ReservationController::class)->except('store', 'destroy');


    //-------------------------------------------------- Celiac Card -------------------------------------------
    Route::get('cardOwners', [ CeliacCardController::class, 'cardOwners' ]);
    Route::apiResource('celiac-cards', CeliacCardController::class)->except('store');

    //-------------------------------------------------- job request -------------------------------------------
    Route::post('change-activation-job-request-settings', [ JobRequestController::class, 'changeSettings' ]);
    Route::get('accepted-jobs', [ JobRequestController::class, 'acceptedJobs' ]);
    Route::apiResource('job-requests', JobRequestController::class)->except('store', 'destroy', 'update');

    // -------------------------------------------------- food baskets request -------------------------------------------

    Route::get('accepted-food-baskets', [ FoodBasketRequestController::class, 'acceptedRequests' ]);
    Route::apiResource('food-baskets', FoodBasketRequestController::class)->except('store', 'destroy');


    // -------------------------------------------------- Hajj request -------------------------------------------

    Route::get('accepted-hajj-requests', [ HajjRequestController::class, 'acceptedRequests' ]);
    Route::post('change-activation-hajj-settings', [ HajjRequestController::class, 'changeSettings' ]);
    Route::apiResource('hajj-requests', HajjRequestController::class)->except('store', 'destroy');

    // -------------------------------------------------- News -------------------------------------------

    Route::apiResource('news', NewsController::class);

    // -------------------------------------------------- Medical Center -------------------------------------------

    Route::apiResource('medical-centers', MedicalCenterController::class);



});


