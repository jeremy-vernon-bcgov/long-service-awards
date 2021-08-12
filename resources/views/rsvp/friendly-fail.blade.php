<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Long Service Awards - RSVP</title>

    <style></style>

</head>
<body>
    <p>
        Sorry, we cannot process that request.

    Error Code :
    @if(!isset($attendee->status))
        PORCUPINE
    @endif

    @if (isset($attendee->status) && $attendee->status == 'assigned')
        CAPYBARA
    @endif

    @if(isset($attendee->status) && $attendee->status == 'declined')
         WOMBAT
    @endif

    @if(isset($attendee->status) && $attendee->status == 'attending')
        PANDA
    @endif

    @if(isset($attendee->status) && $attendee->status == 'invited')
        CATERPILLAR
    @endif

    @if(isset($attendee->status) && $attendee->stauts == 'waitlisted')
        HONEYBADGER
    @endif
    </p>
</body>
</html>
