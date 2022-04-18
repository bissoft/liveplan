<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroOrganization extends Model
{
    protected $fillable = [
        'APIKey',
        'Name',
        'LegalName',
        'PaysTax',
        'Version',
        'OrganisationType',
        'BaseCurrency',
        'CountryCode',
        'IsDemoCompany',
        'OrganisationStatus',
        'RegistrationNumber',
        'EmployerIdentificationNumber',
        'TaxNumber',
        'FinancialYearEndDay',
        'FinancialYearEndMonth',
        'SalesTaxBasis',
        'SalesTaxPeriod',
        'DefaultSalesTax',
        'DefaultPurchasesTax',
        'PeriodLockDate',
        'EndOfYearLockDate',
        'CreatedDateUTC',
        'Timezone',
        'OrganisationEntityType',
        'ShortCode',
        'OrganisationID',
        'Edition',
        'Class',
        'LineOfBusiness',
        'Addresses',
        'Phones',
        'ExternalLinks',
        'PaymentTerms'
    ];
    public static $chars = [
        'APIKey',
        'Name',
        'LegalName',
        'PaysTax',
        'Version',
        'OrganisationType',
        'BaseCurrency',
        'CountryCode',
        'IsDemoCompany',
        'OrganisationStatus',
        'RegistrationNumber',
        'EmployerIdentificationNumber',
        'TaxNumber',
        'FinancialYearEndDay',
        'FinancialYearEndMonth',
        'SalesTaxBasis',
        'SalesTaxPeriod',
        'DefaultSalesTax',
        'DefaultPurchasesTax',
        'PeriodLockDate',
        'EndOfYearLockDate',
        'CreatedDateUTC',
        'Timezone',
        'OrganisationEntityType',
        'ShortCode',
        'OrganisationID',
        'Edition',
        'Class',
        'LineOfBusiness',
        'Addresses',
        'Phones',
        'ExternalLinks',
        'PaymentTerms'
    ];
    public $timestamps = false;
}
