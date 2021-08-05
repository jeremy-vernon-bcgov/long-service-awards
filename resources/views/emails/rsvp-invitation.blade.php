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
<!--
<p> [Image placeholder] </p>
<p> The government of British Columbia</p>
<p> is pleased to invite </p>
<br />
<p> { $data['name'] }</p>
<br />
<p> to the Long Service Awards Ceremony </p>
<br />
<p>
    on { date_format($data['ceremony'], 'l, F j') } at { date_format($data['ceremony'], 'h:i:s a') }
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
<p>Print a <a href=" { route('generate-pdf', $data['id'] )  } ">keepsake invitation</a></p>
<br />
<br />
<h3><a href="{ $data['attendee_id'] }"><button>RSVP Here</button></a></h3>

-->

<p class=3D"MsoNormal"><o:p>&nbsp;</o:p></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%">
    <span style=3D"font-size:18.0pt">[Image placeholder]
    <o:p></o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%">
    <span style=3D"font-size:18.0pt">The Province of British Columbia<o:p></o:p>
</span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%">
    <span style=3D"font-size:18.0pt">is pleased to invite
    <o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">{$recipient->first_name} {$recipient->last_name}<o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">to the Long Service Awards Ceremony
    <o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">on {$ceremony->scheduled_datetime}
    <o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">at Government House<o:p></o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">1401 Rockland Ave<o:p></o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">Victoria, British Columbia<o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"text-align:center;line-height:0%">
    <span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">This invitation is for the intended recipient and one guest.<=
    o:p></o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">Doors open at 5:45pm.<o:p></o:p></span></p>
<p align=3D"center" style=3D"text-align:center;line-height:0%">
    <span style=3D"font-size:18.0pt">Dress: Business casual<o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<h3 align=3D"center" style=3D"text-align:center;line-height:0%">Printable invitation:<o:p></o:p></h3>
<p align=3D"center" style=3D"text-align:center;line-height:0%"><span style=3D"font-size:18.0pt">Print a
    <a href=3D"%20https:/lsaapp.gww.gov.bc.ca/generate-pdf/1757%20">keepsake invitation</a><o:p></o:p></span></p>
<p class=3D"MsoNormal" align=3D"center" style=3D"margin-bottom:18.0pt;text-align:center;line-height:0%">
<span style=3D"font-size:18.0pt"><o:p>&nbsp;</o:p></span></p>
<h3 align=3D"center" style=3D"text-align:center;line-height:0%"><a href=3D"https://lsaapp.gww.gov.bc.ca/rsvp/1757">RSVP Here</a><o:p></o:p></h3>
</body>

</html>
