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
</head>
<body>

<div class="confirmation-bundle">
    {{-- User declined. --}}
    @if($recipient->attendee->status === 'declined')
        <div class="confirmation-message">
            <p>Following the ceremonies in October, your award will be mailed to: </p>
        </div>
        <div class="confirmation-address">
            <p>
                {{$recipient->office_prefix ?? ''}}
                {{$recipient->office_suite ?? ''}}
                {{$recipient->office_address ?? ''}}
                {{$recipient->office_posta_code ?? ''}}
                {{$recipient->officeCommunity->name ?? ''}}
            </p>
            <div class="confirmation-message">
                <p>Your Long Service Awards contact will arrange for it to be presented to you.</p>
                <p>If you have any questions, please check our <a href="https://longserviceawards.gww.gov.bc.ca/" target="_blank">website</a>, connect with your <a href="https://longserviceawards.gww.gov.bc.ca/contacts/" target="_blank">workplace Long Service Award contact</a> or <a href="mailto:LongServiceAwards@gov.bc.ca ">email the Long Service Awards team</a>.</p>
            </div>

        </div>
    {{-- User accepts --}}
    @else
        <div class="confirmation-message">
            <p>The ceremony will take place at Government House, and business attire is recommended. Doors open at 5:45 p.m. Your invitation is not required for entry to the ceremony. Doors open at 5:45 p.m. Your invitation is not required for entry to the ceremony.</p>
            <p>Visit the <a href="https://longserviceawards.gww.gov.bc.ca/ceremony/" target="_blank">Long Service Awards website</a> for up-to-date ceremony information.</p>
        </div>
        <div class="confirmation-data">
            {{-- TODO: Need to if most of these depending on data. --}}
            <p>Name:</p>
            <p>Ministry:</p>
            <p>Selected award:</p>
            <p>My accessibility requirements are:</p>
            <p>My guests accessibility requirements are:</p>
            <p>My dietary requirements are:</p>
            <p>My guest's dietary requirements are:</p>
            <p> I have updated my contact information: </p> {{-- If retired or if preferred email has been set. --}}
        </div>
        <div class="confirmation message">
            <p>If you need to make changes to your RSVP information or cancel your attendance, please <a href="mailto:LongServiceAwards@gov.bc.ca">email the Long Service Awards</a> team as soon as possible.</p>
            <p>For information about travel reimbursement and taking time off, visit the <a href="https://longserviceawards.gww.gov.bc.ca/" target="_blank">Long Service Awards website</a> or email your <a href="https://longserviceawards.gww.gov.bc.ca/contacts/" target="_blank">workplace contact</a>. If you have questions about the ceremony, <a href="mailto:LongServiceAwards@gov.bc.ca">email the Long Service Awards team</a>.</p>
        </div>

    @endif

    {{-- User accepted. --}}

</div>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


</body>
</html>
