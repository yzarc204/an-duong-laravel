<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <ul>
        <li>Email: {{ auth()->user()->email }}</li>
        <li>Tên: {{ auth()->user()->name }}</li>
    </ul>
</body>

</html>
