<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <ul>
        <li> Payment ID : {{ $info->payment_id }} </li>
        <li> Payment Type : {{ $info->payment_type }} </li>
        <li> Total Amount : {{ $info->total }} </li>
        <li> Status Code  : {{ $info->status_code }} </li>
    </ul>

</body>
</html>
