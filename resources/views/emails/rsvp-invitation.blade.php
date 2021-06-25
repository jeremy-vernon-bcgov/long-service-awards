<!DOCTYPE html>

<html>

<head>
    <style>
        body {
            text-align:center;
            font-size: large;
            line-height: 0.5;
        }

    </style>

    <title></title>

</head>

<body>
<p> [Image placeholder] </p>
<p> The government of British Columbia</p>
<p> is pleased to invite </p>
<br />
<p> {{ $data['name'] }}</p>
<br />
<p> to the Long Service Awards Ceremony </p>
<br />
<p>
    on {{ date_format($data['ceremony'], 'l, F j') }} at {{ date_format($data['ceremony'], 'h:i:s a') }}
</p>
<br />
<p> at Government House</p>
<p>1401 Rockland Ave</p>
<p> Victoria, British Columbia</p>
<br />
<p>This invitation is for the intended recipient and one guest.</p>
<p>Doors open at 5:45pm.</p>
<p>Dress: Business casual</p>
<br />
<h3>Printable invitation:</h3>
<p>Print a <a href=" {{ route('generate-pdf', '30')  }} ">keepsake invitation</a></p>
<br />
<strong><a href="{{ $data['attendee_id'] }}">RSVP Here</a></strong>
</body>

</html>
