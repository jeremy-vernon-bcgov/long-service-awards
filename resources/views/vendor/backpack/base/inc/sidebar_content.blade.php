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
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/rsvps')}}">RSVPs</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/waitlist')}}">Wait List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/accommodationsummary')}}">Accommodations</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/vipsummary')}}">Executives</a></li>
        </ul>
    </li>
    <li><i class='nav-icon la la-question'></i><strong>Awards</strong></li>
    <li class="nav-item">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="">Totals</a></li>
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

    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-question'></i> Users</a></li>


@endif;


@if(backpack_user()->hasRole('Administration'))

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
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/rsvps')}}">RSVPs</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/waitlist')}}">Wait List</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/accommodationsummary')}}">Accommodations</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/ceremony/vipsummary')}}">Executives</a></li>
    </ul>
</li>
<li><i class='nav-icon la la-question'></i><strong>Awards</strong></li>
<li class="nav-item">
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="">Totals</a></li>
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
    </ul>
</li>
<li class="nav-item">Ceremonies</li>
<li class="nav-item">
    <ul>
        <li class="nav-item">List</li>
        <li class="nav-item">RSVPs</li>
        <li class="nav-item">Wait List</li>
        <li class="nav-item">Accommodations</li>
        <li class="nav-item">Executives</li>
    </ul>
</li>
<li class="nav-item">Awards</li>
<li class="nav-item">
    <ul>
        <li class="nav-item">Totals</li>
        <li class="nav-item">By Ceremony</li>
        <li class="nav-item">By Milestone</li>
        <li class="nav-item">25-Year Certificates</li>
        <li class="nav-item">PECSF Certificates</li>
        <li class="nav-item">Watch Engraving</li>
        <li class="nav-item">Manage</li>
    </ul>
</li>

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


