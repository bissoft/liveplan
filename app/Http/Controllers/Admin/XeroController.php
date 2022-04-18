<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Xero\XeroBalanceSheet;
use Illuminate\Http\Request;
use LangleyFoxall\XeroLaravel\OAuth2;
use League\OAuth2\Client\Token\AccessToken;
use LangleyFoxall\XeroLaravel\XeroApp;
use App\XeroAccount;
use Hamcrest\Type\IsString;
use App\XeroContact;
use App\XeroInvoice;
use App\Xero\XeroTaxRate;
use App\Xero\XeroBankTransaction;
use App\Xero\XeroBankTransfer;
use App\Xero\XeroBatchPayment;
use App\Xero\XeroBrandingTheme;
use App\Xero\XeroBudget;
use App\Xero\XeroContactGroup;
use App\Xero\XeroCurrency;
use App\Xero\XeroEmployee;
use App\Xero\XeroItem;
use App\Xero\XeroJournal;
use App\Xero\XeroOrganization;
use App\Xero\XeroOverPayment;
use App\Xero\XeroPaymentService;
use App\Xero\XeroProfitLoss;
use App\Xero\XeroPurchaseOrder;
use App\Xero\XeroRepeatingInvoice;
use App\Xero\XeroReport;
use App\Xero\XeroTrackingCategory;
use App\Xero\XeroTrailBalance;
use App\Xero\XeroUser;
use GuzzleHttp\Client;
use Mockery\Expectation;

class XeroController extends Controller
{
    private function getOAuth2()
    {
        // This will use the 'default' app configuration found in your 'config/xero-laravel-lf.php` file.
        // If you wish to use an alternative app configuration you can specify its key (e.g. `new OAuth2('other_app')`).
        return new OAuth2();
    }

    public function redirectUserToXero()
    {
        // Step 1 - Redirect the user to the Xero authorization URL.
        return $this->getOAuth2()->getAuthorizationRedirect();
    }

    public function handleCallbackFromXero(Request $request)
    {
        // Step 2 - Capture the response from Xero, and obtain an access token.
        $accessToken = $this->getOAuth2()->getAccessTokenFromXeroRequest($request);

        // Step 3 - Retrieve the list of tenants (typically Xero organisations), and let the user select one.
        $tenants = $this->getOAuth2()->getTenants($accessToken);
        $selectedTenant = $tenants[0]; // For example purposes, we're pretending the user selected the first tenant.

        // Step 4 - Store the access token and selected tenant ID against the user's account for future use.
        // You can store these anyway you wish. For this example, we're storing them in the database using Eloquent.
        $user = auth()->user();
        $user->xero_access_token = json_encode($accessToken);
        $user->xero_tenant_id = $selectedTenant->tenantId;
        $user->save();
    }

    public function refreshAccessTokenIfNecessary()
    {
        // Step 5 - Before using the access token, check if it has expired and refresh it if necessary.
        $user = auth()->user();

        $accessToken = new AccessToken(json_decode($user->xero_access_token, true));

        if ($accessToken->hasExpired()) {

            $accessToken = $this->getOAuth2()->refreshAccessToken($accessToken);
            $user->xero_access_token = json_encode($accessToken);
            $user->save();
        }
    }

    public function fetchAccounts()
    {
        try {

            $user = auth()->user();

            $this->refreshAccessTokenIfNecessary();

            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $accounts = $xero->accounts;

            if ($accounts) {

                foreach ($accounts as $account) {

                    XeroAccount::updateOrcreate([
                        'AccountID' => $account->AccountID
                    ], [
                        'Code' => $account->Code,
                        'Name' => $account->Name,
                        'BankAccountNumber' => $account->BankAccountNumber,
                        'Status' => $account->Status,
                        'Description' => $account->Description,
                        'BankAccountType' => $account->BankAccountType,
                        'CurrencyCode' => $account->CurrencyCode,
                        'TaxType' => $account->TaxType,
                        'AccountID' => $account->AccountID,
                        'Class' => $account->Class,
                        'SystemAccount' => $account->SystemAccount,
                        'ReportingCode' => $account->ReportingCode,
                        'ReportingCodeName' => $account->ReportingCodeName
                    ]);
                }
            }

            return redirect()->route('admin.xero.accounts');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function accounts()
    {
        try {
            $accounts = XeroAccount::class;
            $user = auth()->user();
            if ($user->xero_organization_id) {
                $accounts = $accounts::where('OrganizationID', $user->xero_organization_id);
            }
            if (isset($_REQUEST['BankAccountNumber']) && $_REQUEST['BankAccountNumber']) {
                $accounts = $accounts::where('BankAccountNumber', $_REQUEST['BankAccountNumber']);
            }
            if (isset($_REQUEST['name']) && $_REQUEST['name']) {
                if (gettype($accounts) == 'string')
                    $accounts = $accounts::where('Name', 'LIKE', '%' . $_REQUEST['name'] . '%');
                else
                    $accounts = $accounts->where('Name', 'LIKE', $_REQUEST['name']);
            }
            if (isset($_REQUEST['account_id']) && $_REQUEST['account_id']) {
                if (gettype($accounts) == 'string')
                    $accounts = $accounts::where('AccountID', 'LIKE', '%' . $_REQUEST['account_id'] . '%');
                else
                    $accounts = $accounts->where('AccountID', 'LIKE', $_REQUEST['account_id']);
            }
            if (isset($_REQUEST['reporting_code']) && $_REQUEST['reporting_code']) {
                if (gettype($accounts) == 'string')
                    $accounts = $accounts::where('ReportingCode', 'LIKE', $_REQUEST['reporting_code']);
                else
                    $accounts = $accounts->where('ReportingCode', 'LIKE', $_REQUEST['reporting_code']);
            }
            if (isset($_REQUEST['class']) && $_REQUEST['class']) {
                if (gettype($accounts) == 'string')
                    $accounts = $accounts::where('Class', $_REQUEST['class']);
                else
                    $accounts = $accounts->where('Class', $_REQUEST['class']);
            }
            if (isset($_REQUEST['system_account']) && $_REQUEST['system_account']) {
                if (gettype($accounts) == 'string')
                    $accounts = $accounts::where('SystemAccount', $_REQUEST['system_account']);
                else
                    $accounts = $accounts->where('SystemAccount', $_REQUEST['system_account']);
            }
            if (gettype($accounts) == 'string')
                $accounts = $accounts::paginate('10');
            else $accounts = $accounts->paginate('10');
            return view('admin.xero.accounts', compact('accounts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit($id)
    {
        $edit_account = XeroAccount::where('id', $id)->first();

        return view('admin.xero.edit_xeraccount', compact('edit_account'));
    }

    public function xeroupdate(Request $request, $id)
    {
        try {
            $data = $request->all();
            xeroAccount::where('id', $id)->update([
                'Code' => $data['Code'], 'Name' => $data['Name'], 'BankAccountNumber' => $data['BankAccountNumber'],
                'Status' => $data['Status'],
                'BankAccountType' => $data['BankAccountType'],
                'CurrencyCode' => $data['CurrencyCode'],
                'TaxType' => $data['TaxType'],
                'AccountID' => $data['AccountID'],
                'Class' => $data['Class'],
                'SystemAccount' => $data['SystemAccount'],
                'ReportingCode' => $data['ReportingCode'],
                'ReportingCodeName' => $data['ReportingCodeName'],

            ]);

            return redirect('admin/xero/accounts')->with('message', 'XeroAccount Updated Successfully!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        
    }
    public function delete($id)
    {
        xeroAccount::where('id', $id)->delete();
        return redirect('admin/xero/accounts')->with('message', 'XeroAccount Deleted ');
    }
    public function fetchAsset()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );


            $assets = $xero->assettypes;
            dd($assets);

            return redirect()->route('admin.xero.accounts');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function fetchPayroll()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $accounts = $xero->employees;
            //dd($accounts);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function bankTransaction()
    {
        return view('admin.xero.bank-transaction.index');
    }

    public function contacts()
    {
        $accounts = XeroContact::paginate('10');

        return view('admin.xero.contacts.index', compact('accounts'));
    }

    public function fetchContacts()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $contacts = $xero->contacts;

            if ($contacts) {

                foreach ($contacts as $contact) {

                    XeroContact::updateOrCreate([
                        'ContactID' => $contact->ContactID
                    ], [
                        'ContactID' => $contact->ContactID,
                        'ContactNumber' => $contact->ContactNumber,
                        'AccountNumber' => $contact->AccountNumber,
                        'ContactStatus' => $contact->ContactStatus,
                        'Name' => $contact->Name,
                        'FirstName' => $contact->FirstName,
                        'LastName' => $contact->LastName,
                        'EmailAddress' => $contact->EmailAddress,
                        'SkypeUserName' => $contact->SkypeUserName,
                        'BankAccountDetails' => $contact->BankAccountDetails,
                        // 'CompanyNumber' => $contact->CompanyNumber,
                        'TaxNumber' => $contact->TaxNumber,
                        'AccountsReceivableTaxType' => $contact->AccountsReceivableTaxType,
                        'AccountsPayableTaxType' => $contact->AccountsPayableTaxType,
                        // 'Addresses' => $contact->Addresses,
                        // 'Phones' => $contact->Phones

                    ]);
                }
            }

            return redirect()->route('admin.xero.contacts');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function invoices()
    {
        $invoices = XeroInvoice::paginate('10');

        return view('admin.xero.invoices.index', compact('invoices'));
    }

    public function fetchInvoices()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $invoices = $xero->invoices;

            if ($invoices) {

                foreach ($invoices as $invoice) {

                    XeroInvoice::updateOrCreate([
                        'InvoiceID' => $invoice->InvoiceID
                    ], [
                        'Type' => $invoice->Type,
                        'ContactID' => $invoice->Contact->ContactID,
                        'LineItems' => null,
                        'Date' => $invoice->Date,
                        'DueDate' => $invoice->DueDate,
                        'LineAmountTypes' => $invoice->LineAmountTypes,
                        'InvoiceNumber' => $invoice->InvoiceNumber,
                        'CurrencyCode' => $invoice->CurrencyCode,
                        'Status' => $invoice->Status
                    ]);
                }
            }

            return redirect()->route('admin.xero.invoices');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Sendinvoices($id)
    {
        $invoice = XeroInvoice::find($id);

        return view('admin.xero.invoices.email', compact('invoice'));
    }
    public function Sendinvoice(Request $request, $id)
    {
        try {
            $invoice = XeroInvoice::find($id);
            $details = [
                'InvoiceNumber' => $invoice->InvoiceNumber,
                'DueDate' => $invoice->DueDate,
                'CurrencyCode' => $invoice->CurrencyCode
            ];

            \Mail::to($request->email)->send(new InvoiceMail($details));
            return redirect('admin/xero/invoices')->with('message', 'Invoice email has sent!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function taxRates()
    {
        $tax_rates = XeroTaxRate::paginate('10');

        return view('admin.xero.tax_rates', compact('tax_rates'));
    }

    public function fetchTaxRates()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $taxRates = $xero->taxRates;

            if ($taxRates) {

                foreach ($taxRates as $taxRate) {

                    XeroTaxRate::updateOrCreate([
                        'TaxType' => $taxRate->TaxType
                    ], [
                        'Name' => $taxRate->Name,
                        'TaxType' => $taxRate->TaxType,
                    ]);
                }
            }

            return redirect()->route('admin.xero.taxRates');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function bankTransactions()
    {
        $bank_transactions = XeroBankTransaction::paginate('10');

        return view('admin.xero.bank_transactions', compact('bank_transactions'));
    }

    public function fetchBankTransactions()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $bankTransactions = $xero->bankTransactions;

            if ($bankTransactions) {

                foreach ($bankTransactions as $bankTransaction) {

                    XeroBankTransaction::updateOrCreate([
                        'BankTransactionID' => $bankTransaction->BankTransactionID
                    ], [
                        'Type' => $bankTransaction->Type,
                        'ContactID' => $bankTransaction->Contact->ContactID,
                        'BankAccount' => $bankTransaction->BankAccount->Code . '-' . $bankTransaction->BankAccount->AccountID,
                        'Total' => $bankTransaction->Total,
                        'BankTransactionID' => $bankTransaction->BankTransactionID,
                    ]);
                }
            }

            return redirect()->route('admin.xero.bankTransactions');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function bankTransfers()
    {
        $bank_transfers = XeroBankTransfer::paginate('10');

        return view('admin.xero.bank_transfers', compact('bank_transfers'));
    }

    public function fetchBankTransfers()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );

            $bankTransfers = $xero->bankTransfers;

            if ($bankTransfers) {

                foreach ($bankTransfers as $bankTransfer) {

                    XeroBankTransfer::updateOrCreate([
                        'BankTransferID' => $bankTransfer->BankTransferID
                    ], [
                        'FromBankAccount' => $bankTransfer->FromBankAccount->AccountID,
                        'ToBankAccount' => $bankTransfer->ToBankAccount->AccountID,
                        'Amount' => $bankTransfer->Amount,
                        'Date' => $bankTransfer->Date,
                        'BankTransferID' => $bankTransfer->BankTransferID,
                    ]);
                }
            }

            return redirect()->route('admin.xero.bankTransfers');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Organizations
    public function fetchOrganisations()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            $organizations = $xero->organisations;
            if ($organizations) {

                foreach ($organizations as $organisation) {

                    XeroOrganization::updateOrCreate(
                        [
                            'OrganisationID' => $organisation->OrganisationID,
                        ],
                        [
                            'Name' => $organisation->Name,
                            'LegalName' => $organisation->LegalName,
                            'PaysTax' => $organisation->PaysTax,
                            'OrganisationType' => $organisation->OrganisationType,
                            'BaseCurrency' => $organisation->BaseCurrency,
                            'CountryCode' => $organisation->CountryCode,
                            'IsDemoCompany' => $organisation->IsDemoCompany,
                            'OrganisationStatus' => $organisation->OrganisationStatus,
                            'OrganisationEntityType' => $organisation->OrganisationEntityType,
                            'RegistrationNumber' => $organisation->RegistrationNumber,
                            'TaxNumber' => $organisation->TaxNumber,
                            'FinancialYearEndDay' => $organisation->FinancialYearEndDay,
                            'FinancialYearEndMonth' => $organisation->FinancialYearEndMonth,
                            'SalesTaxBasis' => $organisation->SalesTaxBasis,
                            'SalesTaxPeriod' => $organisation->SalesTaxPeriod,
                            'DefaultSalesTax' => $organisation->DefaultSalesTax,
                            'DefaultPurchasesTax' => $organisation->DefaultPurchasesTax,
                            'CreatedDateUTC' => $organisation->CreatedDateUTC,
                            'Timezone' => $organisation->Timezone,
                            'ShortCode' => $organisation->ShortCode,
                            'OrganisationID' => $organisation->OrganisationID,
                            // 'Edition' => $organisation->Edition,
                            // 'Class' => $organisation->Class,
                            'PeriodLockDate' => $organisation->PeriodLockDate,
                            'Addresses' => json_encode($organisation->Addresses),
                            'ExternalLinks' => json_encode($organisation->ExternalLinks),
                        ]
                    );
                }
            }

            return redirect('admin/xero/organisations');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function Orgnization()
    {
        $data_organization = XeroOrganization::paginate('10');

        return view('admin.xero.organizations', compact('data_organization'));
    }

    // Batch Payments
    public function FetchBatchPayments()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            $BatchPayment = $xero->batchPayments;
            if ($BatchPayment) {

                foreach ($BatchPayment as $item) {

                    XeroBatchPayment::updateOrCreate(
                        [
                            'BatchPaymentID' => $item->BatchPaymentID,
                        ],
                        [
                            'Account_ID' => json_encode($item->Account),
                            'Payments' => json_encode($item->Payments),
                            'BatchPaymentID' => $item->BatchPaymentID,
                            'Date' => $item->Date,
                            'Type' => $item->Type,
                            'Status' => $item->Status,
                            'TotalAmount' => $item->TotalAmount,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                            'IsReconciled' => $item->IsReconciled,
                        ]
                    );
                }
            }

            return redirect('admin/xero/BatchPayments');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function BatchPayments()
    {
        $BatchPayments = XeroBatchPayment::paginate('10');

        return view('admin.xero.batch_payments', compact('BatchPayments'));
    }
    
    // Pre Payments
    public function FetchPrePayments()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            
            $payments = $BatchPayment = $xero->payments;
            
            return view('admin.xero.payments', compact('payments'));
            if ($BatchPayment) {

                foreach ($BatchPayment as $item) {

                    XeroBatchPayment::updateOrCreate(
                        [
                            'BatchPaymentID' => $item->BatchPaymentID,
                        ],
                        [
                            'Account_ID' => json_encode($item->Account),
                            'Payments' => json_encode($item->Payments),
                            'BatchPaymentID' => $item->BatchPaymentID,
                            'Date' => $item->Date,
                            'Type' => $item->Type,
                            'Status' => $item->Status,
                            'TotalAmount' => $item->TotalAmount,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                            'IsReconciled' => $item->IsReconciled,
                        ]
                    );
                }
            }

            return redirect('admin/xero/BatchPayments');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function PrePayments()
    {
        $BatchPayments = XeroBatchPayment::paginate('10');

        return view('admin.xero.batch_payments', compact('BatchPayments'));
    }

    // Employees
    public function FetchEmployees()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $employee = $xero->employees;
            if ($employee) {

                foreach ($employee as $item) {

                    XeroEmployee::updateOrCreate(
                        [
                            'EmployeeID' => $item->EmployeeID,
                        ],
                        [
                            'EmployeeID' => $item->EmployeeID,
                            'Status' => $item->Status,
                            'FirstName' => $item->FirstName,
                            'LastName' => $item->LastName,
                            'External_Link' => json_encode($item->ExternalLink),
                        ]
                    );
                }
            }

            return redirect('admin/xero/employee');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Employees()
    {
        $employee = XeroEmployee::paginate('10');

        return view('admin.xero.employee', compact('employee'));
    }

    // Branding Themes
    public function FetchBrandingThemes()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            $brandingThemes = $xero->brandingThemes;
            if ($brandingThemes) {

                foreach ($brandingThemes as $item) {

                    XeroBrandingTheme::updateOrCreate(
                        [
                            'BrandingThemeID' => $item->BrandingThemeID,
                        ],
                        [
                            'BrandingThemeID' => $item->BrandingThemeID,
                            'Name' => $item->Name,
                            'LogoUrl' => $item->LogoUrl,
                            'Type' => $item->Type,
                            'SortOrder' => $item->SortOrder,
                            'CreatedDateUTC' => $item->CreatedDateUTC,
                        ]
                    );
                }
            }

            return redirect('admin/xero/BrandingThemes');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function BrandingTheme()
    {
        $brandingTheme = XeroBrandingTheme::paginate('10');

        return view('admin.xero.branding_theme', compact('brandingTheme'));
    }

    // Currencies
    public function FetchCurrencies()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $currency = $xero->currencies;
            if ($currency) {

                foreach ($currency as $item) {

                    XeroCurrency::updateOrCreate(
                        [
                            'Code' => $item->Code,
                        ],
                        [
                            'Code' => $item->Code,
                            'Description' => $item->Description,
                        ]
                    );
                }
            }

            return redirect('admin/xero/currencies');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Currencies()
    {
        $currencies = XeroCurrency::paginate('10');

        return view('admin.xero.currency', compact('currencies'));
    }

    // Items
    public function FetchItems()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $fetchitem = $xero->items;
            if ($fetchitem) {

                foreach ($fetchitem as $item) {

                    XeroItem::updateOrCreate(
                        [
                            'ItemID' => $item->ItemID,
                        ],
                        [
                            'ItemID' => $item->ItemID,
                            'Code' => $item->Code,
                            'Name' => $item->Name,
                            'IsSold' => $item->IsSold,
                            'IsPurchased' => $item->IsPurchased,
                            'Description' => $item->Description,
                            'PurchaseDescription' => $item->PurchaseDescription,
                            'PurchaseDetails' => json_encode($item->PurchaseDetails),
                            'SalesDetails' => json_encode($item->SalesDetails),
                            'IsTrackedAsInventory' => $item->IsTrackedAsInventory,
                            'InventoryAssetAccountCode' => $item->InventoryAssetAccountCode,
                            'TotalCostPool' => $item->TotalCostPool,
                            'QuantityOnHand' => $item->QuantityOnHand,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                        ]
                    );
                }
            }

            return redirect('admin/xero/items');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Items()
    {
        $items = XeroItem::paginate('10');

        return view('admin.xero.items', compact('items'));
    }

    // Journals
    public function FetchJournals()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $journal = $xero->journals;
            if ($journal) {

                foreach ($journal as $item) {

                    XeroJournal::updateOrCreate(
                        [
                            'JournalID' => $item->JournalID,
                        ],
                        [
                            'JournalID' => $item->JournalID,
                            'JournalDate' => $item->JournalDate,
                            'JournalNumber' => $item->JournalNumber,
                            'CreatedDateUTC' => $item->CreatedDateUTC,
                            'Reference' => $item->Reference,
                            'SourceID' => $item->SourceID,
                            'SourceType' => $item->SourceType,
                            'JournalLines' => json_encode($item->JournalLines),
                        ]
                    );
                }
            }

            return redirect('admin/xero/journals');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Journals()
    {
        $journal = XeroJournal::paginate('10');

        return view('admin.xero.journal', compact('journal'));
    }

    // Over Payments
    public function FetchOverPayments()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $overpayments = $xero->overpayments;
            if ($overpayments) {

                foreach ($overpayments as $item) {

                    XeroOverPayment::updateOrCreate(
                        [
                            'OverpaymentID' => $item->OverpaymentID,
                        ],
                        [
                            'Type' => $item->Type,
                            'Contact' => json_encode($item->Contact),
                            'Date' => $item->Date,
                            'Status' => $item->Status,
                            'LineAmountTypes' => $item->LineAmountTypes,
                            'SubTotal' => $item->SubTotal,
                            'TotalTax' => $item->TotalTax,
                            'Total' => $item->Total,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                            'CurrencyCode' => $item->CurrencyCode,
                            'OverpaymentID' => $item->OverpaymentID,
                            'CurrencyRate' => $item->CurrencyRate,
                            'RemainingCredit' => $item->RemainingCredit,
                            'Allocations' => json_encode($item->Allocations),
                            'HasAttachments' => $item->HasAttachments,
                        ]
                    );
                }
            }

            return redirect('admin/xero/overpayment');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function OverPayments()
    {
        $overpayments = XeroOverPayment::paginate('10');

        return view('admin.xero.overpayment', compact('overpayments'));
    }

    // Payment Services
    public function FetchPaymentServices()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $paymentservice = $xero->paymentServices;
            if ($paymentservice) {

                foreach ($paymentservice as $item) {

                    XeroPaymentService::updateOrCreate(
                        [
                            'PaymentServiceID' => $item->PaymentServiceID,
                        ],
                        [
                            'PaymentServiceID' => $item->PaymentServiceID,
                            'PaymentServiceName' => $item->PaymentServiceName,
                            'PaymentServiceUrl' => $item->PaymentServiceUrl,
                            'PayNowText' => $item->PayNowText,
                            'PaymentServiceType' => $item->PaymentServiceType,
                        ]
                    );
                }
            }

            return redirect('admin/xero/paymentservice');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function PaymentServices()
    {
        $paymentservice = XeroPaymentService::paginate('10');

        return view('admin.xero.payment_service', compact('paymentservice'));
    }

    // Purchase Orders
    public function FetchPurchaseOrders()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $purchaseorder = $xero->purchaseOrders;
            if ($purchaseorder) {

                foreach ($purchaseorder as $item) {

                    XeroPurchaseOrder::updateOrCreate(
                        [
                            'PurchaseOrderID' => $item->PurchaseOrderID,
                        ],
                        [
                            'Contact' => json_encode($item->Contact),
                            'Date' => $item->Date,
                            'DeliveryDate' => $item->DeliveryDate,
                            'LineAmountTypes' => $item->LineAmountTypes,
                            'PurchaseOrderNumber' => $item->PurchaseOrderNumber,
                            'Reference' => $item->Reference,
                            'LineItems' => json_encode($item->LineItems),
                            'BrandingThemeID' => $item->BrandingThemeID,
                            'CurrencyCode' => $item->CurrencyCode,
                            'Status' => $item->Status,
                            'SentToContact' => $item->SentToContact,
                            'DeliveryAddress' => $item->DeliveryAddress,
                            'AttentionTo' => $item->AttentionTo,
                            'Telephone' => $item->Telephone,
                            'DeliveryInstructions' => $item->DeliveryInstructions,
                            'ExpectedArrivalDate' => $item->ExpectedArrivalDate,
                            'PurchaseOrderID' => $item->PurchaseOrderID,
                            'CurrencyRate' => $item->CurrencyRate,
                            'SubTotal' => $item->SubTotal,
                            'TotalTax' => $item->TotalTax,
                            'Total' => $item->Total,
                            'TotalDiscount' => $item->TotalDiscount,
                            'HasAttachments' => $item->HasAttachments,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                        ]
                    );
                }
            }

            return redirect('admin/xero/purchaseorder');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function PurchaseOrders()
    {
        $purchaseorder = XeroPurchaseOrder::paginate('10');

        return view('admin.xero.purchase_order', compact('purchaseorder'));
    }

    // Reporting Invoice
    public function FetchReportingInvoices()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $reportinginvoice = $xero->repeatingInvoices;
            if ($reportinginvoice) {

                foreach ($reportinginvoice as $item) {
                    XeroRepeatingInvoice::updateOrCreate(
                        [
                            'RepeatingInvoiceID' => $item->RepeatingInvoiceID,
                        ],
                        [
                            'Type' => $item->Type,
                            'Contacts' => json_encode($item->Contact),
                            'Schedule' => json_encode($item->Schedule),
                            'LineItems' => json_encode($item->LineItems),
                            'LineAmountTypes' => $item->LineAmountTypes,
                            'Reference' => $item->Reference,
                            'BrandingThemeID' => $item->BrandingThemeID,
                            'CurrencyCode' => $item->CurrencyCode,
                            'Status' => $item->Status,
                            'SubTotal' => $item->SubTotal,
                            'TotalTax' => $item->TotalTax,
                            'Total' => $item->Total,
                            'RepeatingInvoiceID' => $item->RepeatingInvoiceID,
                            'HasAttachments' => $item->HasAttachments,
                        ]
                    );
                }
            }

            return redirect('admin/xero/reportinginvoice');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function ReportingInvoices()
    {
        $reportinginvoice = XeroRepeatingInvoice::paginate('10');

        return view('admin.xero.reporting_invoice', compact('reportinginvoice'));
    }

    // Tracking Categories
    public function FetchTrackingCategories()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $trackingCategory = $xero->trackingCategories;
            if ($trackingCategory) {
                foreach ($trackingCategory as $index => $item) {
                    XeroTrackingCategory::updateOrCreate(
                        [
                            'TrackingCategoryID' => $item->TrackingCategoryID,
                        ],
                        [
                            'Name' => $item->Name,
                            'Options' => json_encode($item->Options),
                            'Status' => $item->Status,
                            'TrackingCategoryID' => $item->TrackingCategoryID,
                        ]
                    );
                }
            }

            return redirect('admin/xero/trackingcategory');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function TrackingCategories()
    {
        $trackingcategory = XeroTrackingCategory::paginate('10');

        return view('admin.xero.tracking_category', compact('trackingcategory'));
    }

    // Budgets
    public function FetchBudgets()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $budget = $xero->Budgets;
            if ($budget) {
                foreach ($budget as $item) {
                    XeroBudget::updateOrCreate(
                        [
                            'BudgetID' => $item->BudgetID,
                        ],
                        [
                            'BudgetID' => $item->BudgetID,
                            'Type' => $item->Type,
                            'Description' => $item->Description,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                            'Tracking' => json_encode($item->Tracking),
                            'BudgetLines' => json_encode($item->BudgetLines),
                        ]
                    );
                }
            }

            return redirect('admin/xero/budget');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Budgets()
    {
        $budget = XeroBudget::paginate('10');

        return view('admin.xero.budget', compact('budget'));
    }

    // User
    public function FetchUsers()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $user = $xero->users;
            if ($user) {
                foreach ($user as $item) {
                    XeroUser::updateOrCreate(
                        [
                            'UserID' => $item->UserID,
                        ],
                        [
                            'UserID' => $item->UserID,
                            'EmailAddress' => $item->EmailAddress,
                            'FirstName' => $item->FirstName,
                            'LastName' => $item->LastName,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,
                            'IsSubscriber' => $item->IsSubscriber,
                            'OrganisationRole' => $item->OrganisationRole,
                        ]
                    );
                }
            }

            return redirect('admin/xero/user');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function Users()
    {
        $user = XeroUser::paginate('10');

        return view('admin.xero.user', compact('user'));
    }

    // Contact Groups
    public function FetchContactGroups()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $contactGroup = $xero->contactGroups;
            if ($contactGroup) {
                foreach ($contactGroup as $item) {
                    XeroContactGroup::updateOrCreate(
                        [
                            'ContactGroupID' => $item->ContactGroupID,
                        ],
                        [
                            'ContactGroupID' => $item->ContactGroupID,
                            'Name' => $item->Name,
                            'Status' => $item->Status,
                        ]
                    );
                }
            }

            return redirect('admin/xero/contactgroup');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function ContactGroups()
    {
        $contactGroup = XeroContactGroup::paginate('10');

        return view('admin.xero.contact_group', compact('contactGroup'));
    }

    // Balance Sheets
    public function FetchBalanceSheets()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $balanceSheet = $xero->reportBalanceSheets;
            if ($balanceSheet) {
                foreach ($balanceSheet as $item) {
                    XeroBalanceSheet::updateOrCreate(
                        [
                            'ReportID' => $item->ReportID,
                        ],
                        [
                            'ReportID' => $item->ReportID,
                            'ReportName' => $item->ReportName,
                            'ReportType' => $item->ReportType,
                            'ReportTitles' => json_encode($item->ReportTitles),

                            'ReportDate' => $item->ReportDate,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,

                            'Rows' => json_encode($item->Rows),
                        ]
                    );
                }
            }

            return redirect('admin/xero/balancesheet');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function BalanceSheets()
    {
        $balanceSheet = XeroBalanceSheet::paginate('10');

        return view('admin.xero.balance_sheet', compact('balanceSheet'));
    }

    // Trail Balances
    public function FetchTrailBalances()
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $trailBalance = $xero->reportTrialBalances;
            if ($trailBalance) {
                foreach ($trailBalance as $item) {
                    XeroTrailBalance::updateOrCreate(
                        [
                            'ReportID' => $item->ReportID,
                        ],
                        [
                            'ReportID' => $item->ReportID,
                            'ReportName' => $item->ReportName,
                            'ReportType' => $item->ReportType,
                            'ReportTitles' => json_encode($item->ReportTitles),

                            'ReportDate' => $item->ReportDate,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,

                            'Rows' => json_encode($item->Rows),
                        ]
                    );
                }
            }

            return redirect('admin/xero/trailbalance');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function TrailBalances()
    {
        $trailBalance = XeroTrailBalance::paginate('10');

        return view('admin.xero.trail_balance', compact('trailBalance'));
    }

    // Profit and Loss
    public function FetchProfitAndLoss(Request $request)
    {
        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            // dd($xero);
            $profitLoss = $xero->reportProfitLosses->where('fromDate', '=', $request->fromDate && 'toDate', '=', $request->toDate);
            if ($profitLoss) {
                foreach ($profitLoss as $item) {
                    XeroProfitLoss::updateOrCreate(
                        [
                            'ReportID' => $item->ReportID,
                        ],
                        [
                            'ReportID' => $item->ReportID,
                            'ReportName' => $item->ReportName,
                            'ReportType' => $item->ReportType,
                            'ReportTitles' => json_encode($item->ReportTitles),

                            'ReportDate' => $item->ReportDate,
                            'UpdatedDateUTC' => $item->UpdatedDateUTC,

                            'Rows' => json_encode($item->Rows),
                        ]
                    );
                }
            }

            return redirect('admin/xero/profitloss');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function ProfitAndLoss()
    {
        $profitLoss  = XeroProfitLoss::paginate('10');

        return view('admin.xero.profit_and_loss', compact('profitLoss'));
    }

    // Manual Journals
    public function CreateManualJournal()
    {
        return view('admin/xero/manualjournal/create');
    }
    public function StoreManualJournal(Request $request)
    {

        try {

            $user = auth()->user();
            $this->refreshAccessTokenIfNecessary();
            $xero = new XeroApp(
                new AccessToken(json_decode($user->xero_access_token, true)),
                $user->xero_tenant_id
            );
            $tracking = [
                'Name' => $request->Name,
                'Option' => $request->Option,
            ];
            $JournalLines =  ['JournalLine' => [
                'Description' => $request->Description,
                'LineAmount' => $request->LineAmount,
                'AccountCode' => $request->AccountCode,
                'TaxType' => $request->TaxType,
                'Tracking' => $tracking,
            ]];
            $data = [
                'Date' => $request->Date,
                'Status' => $request->Status,
                'Narration' => $request->Narration,
                'LineAmountTypes' => $request->LineAmountTypes,
                'JournalLines' => $JournalLines,
                'ShowOnCashBasisReports' => $request->ShowOnCashBasisReports,
            ];
            // dd(json_encode($data));
            $client = new Client();


            $res = $client->post(
                'https://api.xero.com/api.xro/2.0/ManualJournals',
                [
                    'headers' => [
                        'Authorization' => json_decode($user->xero_access_token, true),
                    ],
                    'form_params' => [
                        // json_encode($data),
                        // 'Url' => 'Url',  
                        'Date' => $request->Date,
                        'Status' => $request->Status,
                        'Narration' => $request->Narration,
                        'LineAmountTypes' => $request->LineAmountTypes,
                        'JournalLines' => json_encode($JournalLines),
                        'ShowOnCashBasisReports' => $request->ShowOnCashBasisReports,
                    ]
                ]
            );
            dd('ok');
            // $manualJournal = $xero->manualJournals->store($data);

            return redirect('admin/xero/manualjournal')->with('success', 'Manual Journal has created!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Validation Error from Api');
        }
    }
}
