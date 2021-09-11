<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Confirm Brand Delete</title>

    <style type="text/css">
        body {
            height: auto;
            display: block;
            padding: 10px;
            background-color: transparent;
        }
    </style>
</head>
<body>
<h1>Confirm Brand Delete - {{ config('app.name') }}</h1>
<div>
    <p>If you are sure that you want to delete the brand - "{{ $brand->brand }}"
        and all of its model than follow this link
        <a href="{{ config('app.url') . '/api/email/confirm-brand-deleting/' .  $brand->id . '/' . $brand->token->confirmation_token}}">Delete Brand</a>
    </p>
</div>
</body>
</html>
