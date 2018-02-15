<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>New Spa Details:</h2>

<div>
    Spa Added by:<br/>
    {{ Auth::user()->name }}
    <br>
    @foreach($data as $key => $value)
        {{ $key.' = '.$value }}<br/>
    @endforeach
</div>

</body>
</html>