<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Enrollment Invoice</title>
    <style>
        @font-face {
            font-family: 'sans-serif';
            font-style: normal;
            font-weight: 400;
        }
        
        * {
            font-family:  sans-serif;
        }
        
        body {
            margin: 40px;
            line-height: 1.8;
        }
        
        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="text-align: center">Enrollment Invoice</h1>
        <div style="display: flex; justify-content: space-between">
            <div>
                <p><strong>Invoice Number:</strong> #{{ $record->id }}</p>
                <p><strong>Date:</strong> {{ now()->format('Y-m-d') }}</p>
            </div>
            <div>
                <p><strong>Authority:</strong> Modern Learning Institute</p>
                <p><strong>Classification:</strong> Educational Invoices</p>
            </div>
        </div>
    </div>

    <div>
        <h3>Student Information:</h3>
        <p><strong>Name:</strong> {{ $record->user->name }}</p>
        <p><strong>Email:</strong> {{ $record->user->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Course</strong></td>
                <td>{{ $record->course->title }}</td>
            </tr>
            <tr>
                <td><strong>Duration (hours)</strong></td>
                <td>{{ $record->preferred_total_hours }}</td>
            </tr>
            <tr>
                <td><strong>Payment Method</strong></td>
                <td>{{ $record->preferred_payment_method }}</td>
            </tr>
            <tr>
                <td><strong>Total Price</strong></td>
                <td>{{ number_format($record->total_price, 2) }} SAR</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 40px">
        <p><strong>Payment Terms:</strong></p>
        <ul style="list-style: none; padding-left: 20px">
            <li>• Payment should be made within 7 days of the invoice date.</li>
            <li>• Payment should be made through the approved channels.</li>
            <li>• The invoice is eligible for bank transfer.</li>
        </ul>
    </div>

    <div style="margin-top: 50px; text-align: right">
        <p>_________________________</p>
        <p>Finance Manager Signature</p>
    </div>
</body>
</html>
