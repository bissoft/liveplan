<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class SideBar
{
    public static $chars = [
        'Bank Transactions' => 'XeroBankTransaction',
        'Bank Transfers' => 'XeroBankTransfer',
        'Batch Payments' => 'XeroBatchPayment',
        'Branding Theme' => 'XeroBrandingTheme',
        'Budget' => 'XeroBudget',
        'Currency' => 'XeroCurrency',
        'Employee' => 'XeroEmployee',
        'Items' => 'XeroItem',
        'Journals' => 'XeroJournal',
        'Organizations' => 'XeroOrganization',
        'Over Payments' => 'XeroOverPayment',
        'PaymentService' => 'XeroPaymentService',
        'Purchase Orders' => 'XeroPurchaseOrder',
        'XeroRepeatingInvoice' => 'XeroRepeatingInvoice',
        'Reports' => 'XeroReport',
        'Tax Rates' => 'XeroTaxRate',
        'Tracking Categories' => 'XeroTrackingCategory',
        'Users' => 'XeroUser'
        ];
}
