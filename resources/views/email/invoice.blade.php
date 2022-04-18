<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>Here's invoice {{ $details['InvoiceNumber'] }} for ${{ $details['CurrencyCode'] }}.</p>
    <p>The amount outstanding of ${{ $details['CurrencyCode'] }} is due on {{ $details['DueDate'] }}.</p>
    <p>From your online bill you can print a PDF, export a CSV, or create a free login and view your outstanding bills.</p>
    <p>If you have any questions, please let us know.</p>
    <p>Thanks, <br>Demo Company (Global)</p>
</body>
</html>