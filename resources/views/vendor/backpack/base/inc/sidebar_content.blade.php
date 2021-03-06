<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@if(backpack_user()->hasRole('Superuser'))

    <li class="nav-item">Recipients</li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{backpack_url('recipient')}}">List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/organization/recipienttotals')}}">Totals By Organization</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/recipient/flaggednames')}}">Flagged Names</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/recipient/orgcheck')}}">Org/Branch Check</a></li>
        </ul>
    </li>
    <li class="nav-item">Ceremonies</li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{backpack_url('ceremony')}}">List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/assign')}}">Assign</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('recipientceremony') }}">Invitations</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/rsvpstatus')}}">RSVPs</a></li>
            <li class="nav-item">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{url('ceremony/response-by-ceremony')}}"> - by Ceremony</a></li>
                   <!-- <li class="navi-tem"><a class="nav-link" href="{{url('ceremony/response-by-organization')}}"> - by Organization</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="{{url('recipient/rsvpstatus')}}"> - Summary</a></li>
                </ul>

            </li>
            <li class="nav-item"><a class="nav-link disabled" href="{{url('/ceremony/waitlist')}}">Wait List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/accommodations')}}">Accommodations</a></li>
            <li class="nav-item"><a class="nav-link disabled" href="{{url('/ceremony/vipsummary')}}">Executives</a></li>
        </ul>
    </li>
    <li><i class='nav-icon la la-question'></i><strong>Awards</strong></li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{url('recipient/award')}}">Selections</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/award/totals') }}">Totals</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/bracelets')}}">Bracelets</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/watches')}}">Watches</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/25certs')}}">25 Year Certs</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/pecsf-certs')}}">PECSF Certs</a></li>
        </ul>
    </li>
    <li><i class='nav-icon la la-question'></i><strong>Manage</strong></li>
    <ul class="nav">
        <li class="nav-item"><a class="nav-link disabled" href="{{ backpack_url('user')}}">Organization Contacts</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('organization') }}'>Organizations</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('dietaryrestriction') }}'> Dietary Restrictions</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('accessibilityoption') }}'>Accessibility Options</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('pecsfcharity') }}'>PECSF Charities</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('pecsfregion') }}'>PECSF Regions</a></li>
    </ul>

    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-question'></i> Users</a></li>


@endif


@if(backpack_user()->hasRole('Administration'))

<li class="nav-item">Recipients</li>
<li class="nav-item">
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="{{backpack_url('recipient')}}">List</a></li>
        <li class="nav-item"><a class="nav-link" href="{{backpack_url('recipient-ceremony')}}">Totals by Ceremony</a> </li>
        <li class="nav-item"><a class="nav-link" href="{{url('/recipient/flaggednames')}}">Flagged Names</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/recipient/orgcheck')}}">Org/Branch Check</a></li>
    </ul>
</li>
<li class="nav-item">Ceremonies</li>
<li class="nav-item">
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="{{backpack_url('ceremony')}}">List</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/assign')}}">Assign</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('recipientceremony') }}">Invitations</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/rsvpstatus')}}">RSVPs</a></li>
        <li class="nav-item">
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="{{url('ceremony/response-by-ceremony')}}"> - by Ceremony</a></li>
                <!-- <li class="navi-tem"><a class="nav-link" href="{{url('ceremony/response-by-organization')}}"> - by Organization</a></li> -->
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link disabled" href="{{url('/ceremony/waitlist')}}">Wait List</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/accommodations')}}">Accommodations</a></li>
        <li class="nav-item"><a class="nav-link disabled" href="{{url('/ceremony/vipsummary')}}">Executives</a></li>
    </ul>
</li>
<li><i class='nav-icon la la-question'></i><strong>Awards</strong></li>
<li class="nav-item">
    <ul class="nav">
        <li class='nav-item'><a class='nav-link' href='{{backpack_url('award')}}'>list</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/award/totals') }}">Totals</a></li>
        <li class="nav-item"><a class="nav-link" href="">By Ceremony</a></li>
        <li class="nav-item"><a class="nav-link" href="">By Milestone</a></li>
        <li class="nav-item"><a class="nav-link" href="">25-Year Certificates</a></li>
        <li class="nav-item"><a class="nav-link" href="">Watch Engraving</a></li>
    </ul>
</li>
<li><i class='nav-icon la la-question'></i><strong>Manage</strong></li>
<ul class="nav">
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user')}}">Organization Contacts</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('organization') }}'>Organizations</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('dietaryrestriction') }}'> Dietary Restrictions</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('accessibilityoption') }}'>Accessibility Options</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pecsfcharity') }}'>PECSF Charities</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pecsfregion') }}'>PECSF Regions</a></li>
</ul>


@endif

@if(backpack_user()->hasRole('Protocol'))

    <li class="nav-item">Recipients</li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{backpack_url('recipient')}}">List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/organization/recipienttotals')}}">Totals By Organization</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/recipient/flaggednames')}}">Flagged Names</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/recipient/orgcheck')}}">Org/Branch Check</a></li>
        </ul>
    </li>
    <li class="nav-item">Ceremonies</li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{backpack_url('ceremony')}}">List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/assign')}}">Assign</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('recipientceremony') }}">Invitations</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/rsvpstatus')}}">RSVPs</a></li>
            <li class="nav-item">
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="{{url('ceremony/response-by-ceremony')}}"> - by Ceremony</a></li>
              <!--  <li class="navi-tem"><a class="nav-link" href="{{url('ceremony/response-by-organization')}}"> - by Organization</a></li> -->
            </ul>
            </li>
            <li class="nav-item"><a class="nav-link disabled" href="{{url('/ceremony/waitlist')}}">Wait List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/accommodations')}}">Accommodations</a></li>
            <li class="nav-item"><a class="nav-link disabled" href="{{url('/ceremony/vipsummary')}}">Executives</a></li>
        </ul>
    </li>
    <li><i class='nav-icon la la-question'></i><strong>Awards</strong></li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{url('recipient/award')}}">Selections</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/award/totals') }}">Totals</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/bracelets')}}">Bracelets</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/watches')}}">Watches</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/25certs')}}">25 Year Certs</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/award/pecsf-certs')}}">PECSF Certs</a></li>
        </ul>
    </li>
    <li><i class='nav-icon la la-question'></i><strong>Manage</strong></li>
    <ul class="nav">
        <li class="nav-item"><a class="nav-link disabled" href="{{ backpack_url('user')}}">Organization Contacts</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('organization') }}'>Organizations</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('dietaryrestriction') }}'> Dietary Restrictions</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('accessibilityoption') }}'>Accessibility Options</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('pecsfcharity') }}'>PECSF Charities</a></li>
        <li class='nav-item'><a disabled class='nav-link disabled' href='{{ backpack_url('pecsfregion') }}'>PECSF Regions</a></li>
    </ul>

    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-question'></i> Users</a></li>
@endif

@if(backpack_user()->hasRole('Contact'))

    <li class="nav-item">Recipients</li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{backpack_url('recipient')}}">List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/organization/recipienttotals')}}">Totals By Organization</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/recipient/flaggednames')}}">Flagged Names</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/recipient/orgcheck')}}">Org/Branch Check</a></li>
        </ul>
    </li>
@endif

