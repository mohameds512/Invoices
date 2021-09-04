<table>
    <thead>
        <tr>#</tr>
        <tr>invoice_num</tr>
        <tr>invoices_date</tr>
    </thead>
    <tbody>
        @foreach ($invoices as $index=>$invoice)
        <tr>{{$index +1}} </tr>
        <tr>{{$invoice->invoices_number}}</tr>
        <tr>{{$invoice->invoices_date}}</tr>
        @endforeach
    </tbody>
</table>
