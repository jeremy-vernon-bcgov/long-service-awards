
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>

<body>

    <div style="text-align: center">
        <img src="{{url('img/email-badge.png')}}">
        <h1 class="header">The Province of British Columbia</h1>
        <h1 class="sub-head">is pleased to invite</h1>
        <h1 class="name">{{$data['name']}}</h1>
        <h2 class="info">to the Long Service Awards Ceremony</h2>
        <br>
        <p>on {{$data['ceremony']->format('l jS \of F Y')}}</p>
        <p>at Government House</p>
        <p>1401 Rockland Avenue</p>
        <p>Victoria, British Columbia</p>
        <br>
        <p>This invitation is for the intended recipient and one guest.</p>
        <p>Please respond before September 30, 2021</p>
        <p>Dress: Business attire</p>
        <br>
        <h1><a href="{{$data['rsvp_url']}}">RSVP HERE</a></h1>
            <br>
            <h2><a href="{{$data['invite_pdf_url']}}">Printable Keepsake Invitation</a></h2>
    </div>

</body>
</html>
