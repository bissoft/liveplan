<?php
use app\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// Route::get('/account/edit/{id}', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@home')->name('home');
Route::resource('newsletter', 'NewsletterController');
// 2FA
Route::group(['prefix' => '2fa', 'middleware' => ['auth', 'web']], function(){
    Route::get('/','LoginSecurityController@show2faForm');
    Route::post('/generateSecret','LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa','LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa','LoginSecurityController@disable2fa')->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', 'LoginSecurityController@verify2fa')->name('2faVerify')->middleware('2fa');
});

// User
Route::group(['as' => 'client.', 'middleware' => ['auth', '2fa']], function () {
    Route::get('home', 'HomeController@redirect');
    
    Route::get('dashboard', 'HomeController@redirect')->name('home');
    Route::get('change-password', 'ChangePasswordController@create')->name('password.create');
    Route::post('change-password', 'ChangePasswordController@update')->name('password.update');
    Route::get('test', 'TestsController@index')->name('test');
    Route::post('test', 'TestsController@store')->name('test.store');
    Route::get('results/{result_id}', 'ResultsController@show')->name('results.show');
    Route::get('send/{result_id}', 'ResultsController@send')->name('results.send');

    Route::get('plan/{id}', 'StripeController@plan');
    Route::post('plan_post', 'StripeController@plan_post')->name('plan.post');
    Route::view('Payment_successfully', 'thanks');
});

Route::get('about', 'Admin\HomeController@about');
Route::get('messages', 'Admin\HomeController@about');
Route::get('contact', 'Admin\HomeController@contact');
Route::get('pricing', 'Admin\HomeController@pricing');
Route::get('blog', 'Admin\HomeController@blog');
Route::get('lang/home', 'LangController@index');
Route::get('lang/change', 'LangController@change')->name('changeLang');
Route::view('error','error');

// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth.admin', '2fa']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('paid-users/{id?}', 'HomeController@paidUsers');
    Route::get('messages', 'ChatController@index')->name('messages');
    Route::get('messages/{id}', 'ChatController@index');
    Route::get('messages/refresh-msgs/{id}', 'ChatController@refreshMsgs');
    Route::get('messages/send/msg', 'ChatController@sendMsg');
    Route::get('messages/fetch/msgs', 'ChatController@fetch')->name('fetchchat');
    Route::get('messages/new/group', 'ChatController@createGroup')->name('makegroup');

    Route::get('support/', 'Support\SupportController@index')->name('support');
    Route::get('support/resolve/{id}', 'Support\SupportController@resolve')->name('support.resolve');
    Route::get('support/comment/send', 'Support\SupportController@sendComment')->name('comment.send');
    Route::get('support/comment/fetch', 'Support\SupportController@fetchComments')->name('comment.fetch');
    Route::get('support/ask', 'Support\AskController@index')->name('support.ask');
    Route::post('support/ask', 'Support\AskController@ask');
    
    Route::get('contacts/{type?}', 'HomeController@contacts')->name('contacts');
    Route::resource('subscriptions', 'SubscriptionController');

    // Xero APIs

    // Route::group(['middleware' => ['web', 'XeroAuthenticated']], function(){
    //     Route::get('xero', function(){
    //         return Xero::getTenantName();
    //     });
    // });
    
    // Route::get('xero/connect', function(){
    //     return Xero::connect();
    // });


    Route::get('xero/redirect', 'XeroController@redirectUserToXero');
    Route::get('handle/callback', 'XeroController@handleCallbackFromXero');

    Route::get('change/organization/{id?}', 'HomeController@changeOrganization');

    Route::get('fetch/accounts', 'XeroController@fetchAccounts');
    Route::get('fetch/assetstypes', 'XeroController@fetchAsset');
    Route::get('fetch/employees', 'XeroController@fetchPayroll');
    Route::get('xeroaccounts/{id?}', 'XeroController@edit')->name('xeroaccounts.edit');
    Route::post('xeroaccount/{id?}', 'XeroController@xeroupdate')->name('xeroaccount.xeroupdate');
    Route::post('xeroaccountdel/{id?}', 'XeroController@delete')->name('xeroaccountdel.delete');
    Route::get('xeroaccountref', 'XeroController@refreshAccessTokenIfNecessary')->name('xeroaccountref.refreshAccessTokenIfNecessary');
    // Route::get('account/edit/{id}', 'XeroController@edit');
    Route::get('xero/accounts', 'XeroController@accounts')->name('xero.accounts');
    Route::get('xero/contacts', 'XeroController@contacts')->name('xero.contacts');
    Route::get('xero/invoices', 'XeroController@invoices')->name('xero.invoices');
    Route::get('xero/Sendinvoice/{id}', 'XeroController@Sendinvoices');
    Route::post('xero/Sendinvoice/{id}', 'XeroController@Sendinvoice');
    Route::get('xero/tax-rates', 'XeroController@taxRates')->name('xero.taxRates');
    Route::get('xero/bank-transactions', 'XeroController@bankTransactions')->name('xero.bankTransactions');
    Route::get('xero/bank-transfers', 'XeroController@bankTransfers')->name('xero.bankTransfers');
    Route::get('fetch/contacts', 'XeroController@fetchContacts');
    Route::get('fetch/invoices', 'XeroController@fetchInvoices');
    Route::get('fetch/tax-rates', 'XeroController@fetchTaxRates');
    Route::get('fetch/bank-transactions', 'XeroController@fetchBankTransactions');
    Route::get('fetch/bank-transfers', 'XeroController@fetchBankTransfers');
    Route::get('fetch/organisations', 'XeroController@fetchOrganisations')->name('xero.organisations');
    Route::get('xero/organisations', 'XeroController@Orgnization');
    Route::get('fetch/FetchBatchPayments', 'XeroController@FetchBatchPayments')->name('xero.fetchBatch');
    Route::get('xero/BatchPayments', 'XeroController@BatchPayments');
    Route::get('fetch/FetchEmployee', 'XeroController@FetchEmployees')->name('xero.fetchEmployee');
    Route::get('xero/employee', 'XeroController@Employees');
    Route::get('fetch/BrandingThemes', 'XeroController@FetchBrandingThemes')->name('xero.fetchBrandingThemes');
    Route::get('xero/BrandingThemes', 'XeroController@BrandingTheme');
    Route::get('fetch/currencies', 'XeroController@FetchCurrencies')->name('xero.fetchCurrencies');
    Route::get('xero/currencies', 'XeroController@Currencies');
    Route::get('fetch/items', 'XeroController@FetchItems')->name('xero.fetchItems');
    Route::get('xero/items', 'XeroController@Items');
    Route::get('fetch/journal', 'XeroController@FetchJournals')->name('xero.fetchJournals');
    Route::get('xero/journal', 'XeroController@Journals');
    Route::get('fetch/overpayment', 'XeroController@FetchOverPayments')->name('xero.fetchOverPayments');
    Route::get('xero/overpayment', 'XeroController@OverPayments');
    Route::get('fetch/paymentservice', 'XeroController@FetchPaymentServices')->name('xero.fetchPaymentServices');
    Route::get('xero/paymentservice', 'XeroController@PaymentServices');
    Route::get('fetch/prepayments', 'XeroController@FetchPrePayments')->name('xero.fetchPrePayments');
    Route::get('xero/prepayments', 'XeroController@PrePayments');
    Route::get('fetch/purchaseorder', 'XeroController@FetchPurchaseOrders')->name('xero.fetchPurchaseOrders');
    Route::get('xero/purchaseorder', 'XeroController@PurchaseOrders');
    Route::get('fetch/reportinginvoice', 'XeroController@FetchReportingInvoices')->name('xero.fetchReportingInvoices');
    Route::get('xero/reportinginvoice', 'XeroController@ReportingInvoices');
    Route::get('fetch/trackingcategory', 'XeroController@FetchTrackingCategories')->name('xero.fetchTrackingCategories');
    Route::get('xero/trackingcategory', 'XeroController@TrackingCategories');
    Route::get('fetch/budget', 'XeroController@FetchBudgets')->name('xero.fetchBudgets');
    Route::get('xero/budget', 'XeroController@Budgets');
    Route::get('fetch/user', 'XeroController@FetchUsers')->name('xero.fetchUsers');
    Route::get('xero/user', 'XeroController@Users');
    Route::get('fetch/contactgroup', 'XeroController@FetchContactGroups')->name('xero.fetchContactGroups');
    Route::get('xero/contactgroup', 'XeroController@ContactGroups');
    Route::get('fetch/balancesheet', 'XeroController@FetchBalanceSheets')->name('xero.fetchBalanceSheets');
    Route::get('xero/balancesheet', 'XeroController@BalanceSheets');
    Route::get('fetch/trailbalance', 'XeroController@FetchTrailBalances')->name('xero.fetchTrailBalances');
    Route::get('xero/trailbalance', 'XeroController@TrailBalances');
    Route::get('fetch/profitloss', 'XeroController@FetchProfitAndLoss')->name('xero.fetchProfitAndLoss');
    Route::get('xero/profitloss', 'XeroController@ProfitAndLoss');

    Route::view('invoiceemail','admin/xero/invoices/email');

    //Maunal Journals
    Route::get('xero/maunaljournal','XeroController@CreateManualJournal');
    Route::post('store/manualjournal', 'XeroController@StoreManualJournal')->name('xero.StoreManualJournal');

    // Lists
    Route::resource('lists', 'ListController');

    // Companies
    Route::resource('companies', 'CompanyController');
    Route::post('companies/add-to-list', 'CompanyController@addToList')->name('companies.addToList');

    // Account
    Route::resource('accounts', 'AccountController');
    Route::post('accounts/add-to-list', 'AccountController@addToList')->name('accounts.addToList');

    // Import
    Route::get('import/companies', 'CompanyController@importForm')->name('import.companies.form');
    Route::post('import/companies', 'CompanyController@import')->name('import.companies');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'QuestionsController');

    // Options
    Route::delete('options/destroy', 'OptionsController@massDestroy')->name('options.massDestroy');
    Route::resource('options', 'OptionsController');

    // Results
    Route::delete('results/destroy', 'ResultsController@massDestroy')->name('results.massDestroy');
    Route::resource('results', 'ResultsController');

    // Content
    Route::resource('content', 'ContentController');
    // Service
    Route::resource('service', 'ServiceController');
    Route::post('deleteService', 'ServiceController@destroy')->name('deleteService');
    // Social Media
    Route::resource('media', 'MediaController');
    Route::post('deleteMedia', 'MediaController@destroy')->name('deleteMedia');
    // Package Point
    Route::resource('packagePoint', 'PackagePointController');
    Route::post('deletePackagePoint', 'PackagePointController@destroy')->name('deletePackagePoint');
    // Package
    Route::resource('package', 'PackageController');
    Route::post('deletePackage', 'PackageController@destroy')->name('deletePackage');
    // Package
    Route::resource('packageSale', 'PackageSaleController');
    Route::post('deletePackageSale', 'PackageSaleController@destroy')->name('deletePackageSale');
    // Team
    Route::resource('team', 'TeamController');
    Route::post('deleteTeam', 'TeamController@destroy')->name('deleteTeam');
    // Article
    Route::resource('article', 'ArticleController');
    Route::post('deleteArticle', 'ArticleController@destroy')->name('deleteArticle');
    // Review
    Route::resource('review', 'ReviewController');
    Route::post('deleteReview', 'ReviewController@destroy')->name('deleteReview');
    // Newsletter
    Route::resource('newsletter', 'NewsletterController');
    Route::post('deleteNewsletter', 'NewsletterController@destroy')->name('deleteNewsletter');


    // Revenue
    Route::resource('revenue', 'Financial\RevenueController');

    //Webbooks
    //companies
    Route::resource('companies', 'Webbook\CompanyController');
    Route::post('deleteCompanies', 'Webbook\CompanyController@destroy')->name('deleteCompanies');
    Route::get('setting/{id}', 'Webbook\CompanyController@setting')->name('companies.setting');
    Route::post('setting/{id}', 'Webbook\CompanyController@update_setting')->name('companies.update_setting');
    // sync setting 
    Route::get('syncsetting/{id}', 'Webbook\CompanyController@syncsetting')->name('companies.syncsetting');
    Route::post('syncsetting/{id}', 'Webbook\CompanyController@update_syncsetting')->name('companies.update_syncsetting');

    //connection
    Route::get('connection/{id}', 'Webbook\ConnectionController@connection');
    Route::get('view-connection/{company}/{id}', 'Webbook\ConnectionController@view');
    Route::post('delete-connection/{company}/{id}', 'Webbook\ConnectionController@delete');
    
    //Tax Rate
    Route::get('taxrate/{id}', 'Webbook\TaxRateController@index');
    Route::get('view-taxrate/{company}/{id}', 'Webbook\TaxRateController@view');

    //customer
    Route::get('customer/{id}', 'Webbook\CustomerController@customer');
    Route::get('view-customer/{company}/{id}', 'Webbook\CustomerController@view');
    //attachment
    Route::get('customer-attachment/{company}/{id}', 'Webbook\AttachmentController@index');
    Route::post('fetch_attachment', 'Webbook\AttachmentController@fetch')->name('fetchAttachment');
    //Financial
    //Balancesheet
    Route::get('balancesheet/{id}', 'Webbook\FinancialController@balancesheet');
    Route::post('balancesheet', 'Webbook\FinancialController@get_balancesheet')->name('balancesheet');
    //Profit & Lost
    Route::get('profit_lost/{id}', 'Webbook\FinancialController@profit_lost');
    Route::post('profit_lost', 'Webbook\FinancialController@get_profit_lost')->name('profit_lost');
    //Cash Flow Statement
    Route::get('cashflow/{id}', 'Webbook\FinancialController@cashflow');
    Route::post('cashflow', 'Webbook\FinancialController@get_cashflow')->name('cashflow');
});


Route::group(['middleware' => ['auth', '2fa']], function () {
    Route::get('profile', 'ProfileController@index');
    Route::post('profile', 'ProfileController@updateProfile');
    Route::post('update-profile', 'ProfileController@update');

    Route::get('stripe', 'StripeController@stripe');
    Route::post('stripe', 'StripeController@stripePost')->name('stripe.post');
    Route::get('plans', 'StripeController@retrievePlans');
    Route::get('plans/create', 'StripeController@createPlanForm');
    Route::post('plans/create', 'StripeController@createPlan');
    Route::get('subscriptions', 'StripeController@retrieveSubscriptions');

    Route::get('subscribe', 'StripeController@subscribe');
    Route::get('subscribed', 'StripeController@subscribed');

    Route::get( '/service/create', 'ServicesController@create');
    Route::post( '/service/store', 'ServicesController@store');
    Route::get( '/service/view', 'ServicesController@view');
    Route::get( '/service/edit/{id}', 'ServicesController@edit');
    Route::post( '/service/update/{id}', 'ServicesController@update');
    Route::post( '/service/delete/{id}', 'ServicesController@delete');
    // Features Routes
    Route::get( '/feature/create', 'FeatureController@create');
    Route::post( '/feature/store', 'FeatureController@store');
    Route::get( '/feature/view', 'FeatureController@view');
    Route::get( '/feature/edit/{id}', 'FeatureController@edit');
    Route::get( '/feature/add', 'FeatureController@add');
    Route::post( '/feature/update/{id}', 'FeatureController@update');
    Route::post( '/feature/delete/{id}', 'FeatureController@delete');
    // Banner Routes
    Route::get( '/banner/create', 'BannerController@create');
    Route::post( '/banner/store', 'BannerController@store');
    Route::get( '/banner/view', 'BannerController@view');
    Route::get( '/banner/add', 'BannerController@add');
    Route::get( '/banner/edit/{id}', 'BannerController@edit');
    Route::post( '/banner/update/{id}', 'BannerController@update');
    Route::post( '/banner/delete/{id}', 'BannerController@delete');
    //About us Routes

    Route::get( '/about/view', 'AboutController@view');
    Route::get( '/about/add', 'AboutController@add');
    Route::post( '/about/store', 'AboutController@store');
    Route::get( '/about/edit/{id}', 'AboutController@edit');
    Route::post('/about/update/{id}', 'AboutController@update');
    Route::post('/about/delete/{id}', 'AboutController@delete');

    //Get in touch
    Route::get('/getInTouch/view', 'GetInTouchController@view');
    Route::get('/getintouch/add', 'GetInTouchController@add');
    Route::post( '/getintouch/store', 'GetInTouchController@store');
    Route::get( '/getintouch/edit/{id}', 'GetInTouchController@edit');
    Route::post('/getintouch/update/{id}', 'GetInTouchController@update');
    Route::post('/getintouch/delete/{id}', 'GetInTouchController@delete');

    //latestidea
    Route::get('/latestidea/view', 'LatestIdeaController@view');
    Route::get( '/latestidea/add', 'LatestIdeaController@add');
    Route::post( '/latestidea/store', 'LatestIdeaController@store');
    Route::get( '/latestidea/edit/{id}', 'LatestIdeaController@edit');
    Route::post( '/latestidea/update/{id}', 'LatestIdeaController@update');
    Route::post( '/latestidea/delete/{id}', 'LatestIdeaController@delete');
    //choose
    Route::get('/choose/view', 'ChooseController@view');
    Route::get( '/choose/add', 'ChooseController@add');
    Route::post( '/choose/store', 'ChooseController@store');
    Route::get( '/choose/edit/{id}', 'ChooseController@edit');
    Route::get( '/choose/edit/{id}', 'ChooseController@edit');
    Route::post( '/choose/update/{id}', 'ChooseController@update');
    Route::post( '/choose/delete/{id}', 'ChooseController@delete');

    // Pricing Plan
    Route::get('/pricing/view', 'PriceController@view');
    Route::get( '/price/add', 'PriceController@add');
    Route::post( '/price/store', 'PriceController@store');
    Route::get( '/price/edit/{id}', 'PriceController@edit');
    Route::post( '/price/update/{id}', 'PriceController@update');
    Route::post( '/price/delete/{id}', 'PriceController@delete');

    //
    // testimonial
    Route::get('/testimonial/view', 'TestimonialController@view');
    Route::get( '/testimonial/add', 'TestimonialController@add');
    Route::post( '/testimonial/store', 'TestimonialController@store');
    Route::get( '/testimonial/edit/{id}', 'TestimonialController@edit');
    Route::post( '/testimonial/update/{id}', 'TestimonialController@update');
    Route::post( '/testimonial/delete/{id}', 'TestimonialController@delete');
    // Account

    // FAQ
    Route::get('/faq/view', 'FaqController@view');
    Route::get( '/faq/add', 'FaqController@add');
    Route::post( '/faq/store', 'FaqController@store');
    Route::get( '/faq/edit/{id}', 'FaqController@edit');
    Route::post( '/faq/update/{id}', 'FaqController@update');
    Route::post( '/faq/delete/{id}', 'FaqController@delete');

    // Have a Project Mind?
    Route::get('/project/view', 'ProjectController@view');
    Route::get( '/project/add', 'ProjectController@add');
    Route::post( '/project/store', 'ProjectController@store');
    Route::get( '/project/edit/{id}', 'ProjectController@edit');
    Route::post( '/project/update/{id}', 'ProjectController@update');
    Route::post( '/project/delete/{id}', 'ProjectController@delete');
});

Route::post('webhook', 'StripeController@webhook');

//
// Account
// Route::get('settings/', 'AccountController@edit')->name('settings');
// Route::get('foo', function () {
//     return 'Hello World';
// });


