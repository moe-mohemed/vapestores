<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    SpaPal Registration:<br/>
    <h3>hi, {{ $data['name'] }}</h3>
    <p>Thank you for registering.<br/>
        We require that you "validate" your registration to ensure that
        the email address you entered was correct. This protects against
        unwanted spam and malicious abuse.<br/>
        To activate your account, simply click on the following link:</p>

    <a target="_blank" href="{{ $data['link'] }}">{{ $data['link'] }}</a>

    <p>(Some email client users may need to copy and paste the link into your web
        browser).</p>
</div>

</body>
</html>