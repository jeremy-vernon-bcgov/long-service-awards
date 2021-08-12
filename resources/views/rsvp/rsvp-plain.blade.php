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

    <style>

        .xxl {
            font-size: 42pt;
        }
        .very-lorge {
            font-size: 30pt;
        }
        .lorge {
            font-size: 18pt;
        }
        .medium {
            font-size: 12pt;
        }
        .center {
            text-align: center;
        }
        #recipient-name {
            line-height: 40pt;
        }
        .left {
            text-align: left;
        }
        .grey-bg {
            background-color: #F3F3F3;
        }
    </style>

</head>
<body>


    <div>

<div class="container">
        <div class="row">
            <div class="col-1">
            &nbsp;
            </div>
            <div class="col-10 center grey-bg">
                <img src="{{url('/img/banner-w-coat.svg')}}" style="margin-top: 10pt">
                <p class="very-lorge" id="introduction">The Province of British Columbia is pleased to invite</p>
                <p class="xxl" id="recipient-name">{{$recipient->first_name . ' ' . $recipient->last_name}}</p>
                <p class="lorge" id="introduction-ceremony">to the Long Service Awards Ceremony on </p>
                <p class="very-lorge">{{ date_format($scheduled_datetime, 'l, F j') }}
                    at {{ date_format($scheduled_datetime, 'g:i a') }} </p>

                <div class="row left">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-5">
                        <p class="lorge">Government House</p>
                        <p class="medium">1401 Rockland Avenue<br>Victoria, British Columbia</p>
                    </div>
                    <div class="col-5">
                        <p class="medium">This invitation is for the intended recipient and one guest.</p>
                        <p class="medium">Doors open at 5:45pm. and dress is business attire.</p>

                    </div>
                    <div class="col-1">&nbsp;</div>
                </div>


                <br>


            </div>
            <div class="col-1">
                &nbsp;
            </div>

        </div>

    @if($errors->any())
        <div class="row">
            <div class="col-1">&nbsp;</div>
            <div class="col-10">

                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger"><p>{{$error}}</p></div>
                    @endforeach

            </div>
            <div class="col-1">&nbsp;</div>
        </div>
    @endif


    <form method="post" action="{{url('/rsvp')}}">
            @csrf
        <div class="row">
                <div class="col-1">
                    <span>&nbsp;</span>
                </div>
                <div class="col-10">
                    <p class="lorge">RSVP Below</p>

                    <p>Will you attend?</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rsvp" id="rsvp-true" value="true" required>
                        <label class="form-check-label" for="rsvp-true">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rsvp" id="rsvp-false" value="false" required>
                        <label class="form-check-label" for="rsvp-false">No</label>
                    </div>

                    <br><br>

                    <div class="isAttending collapse">
                        <p>Will you bring a guest?</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guest" value="true">
                            <label class="form-check-label" for="guest-true">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guest" value="false" id="guest-false">
                            <label class="form-check-label" for="guest-false">No</label>
                        </div>

                    </div>
                </div>
                <div class="col-1">&nbsp;</div>

        </div>

           <div class="isAttending collapse">
               <div class="row" style="margin-top: 10pt">
                <div class="col-1">&nbsp;</div>
                <div class="col-10 grey-bg">
                    <div class="row">
                        <div class="col-1">&nbsp;</div>
                        <div class="col-9">
                            <h3 style="margin-top: 10pt">Inclusivity</h3>
                            <p>The Long Service Awards ceremonies are welcoming and accessible events.</p>
                            <p>Contact <a href="mailto:LongServiceAwards@gov.bc.ca" target="_blank">LongServiceAwards@gov.bc.ca</a> with questions.</p>

                            <h3>Accessibility Requirements</h3>
                            <p>To ensure you and your guest can enjoy the festivities, please share your accessibility requirements
                                with us.</p>
                            <p>If you'd like a preview of accessible facilities at Government House including ramps, elevators and
                                washroom facilities, visit the <a href="https://longserviceawards.gww.gov.bc.ca/ceremony/%5d" target="_blank">Ceremony page</a>.</p>
                            <p>If you have questions or wish to connect with a member of the Long Service Awards team directly,
                                contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a></p>
                        </div>
                        <div class="col-1">&nbsp;</div>
                    </div>

                </div>
                <div class="col-1">&nbsp;</div>
               </div>
               <div class="row">
                   <div class="col-1">&nbsp;</div>
                   <div class="col-10">
                       <p>Do you require accessibility considerations?</p>

                       <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="recip_access" value="true" id="recip_access-true">
                           <label for="recip_access-true">Yes</label>
                       </div>
                       <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="recip_access" value="false" id="recip_access-false">
                           <label for="recip_access-false">No</label>
                       </div>
                   </div>
                   <div class="col-1">&nbsp;</div>




                </div>
            </div>

            <div class="recipAccess collapse">

                <div class="row">

                    <div class="col-1">&nbsp;</div>
                    <div class="col-10 grey-bg">
                        <p>I require:</p>

                        @foreach($access as $option)
                            <div class="form-check">
                                <input type="checkbox" id="recip_{{$option->short_name}}"
                                       name="recip_{{$option->short_name}}" value="true">
                                <label class="block" for="{{$option->short_name}}">{{$option->description}}</label>
                            </div>
                        @endforeach
                        <p>If you have additional requirements or considerations please contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a>.</p>
                    </div>
                    <div class="col-1">&nbsp;</div>


                </div>

            </div>


            <div class="hasGuest collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <p>Does your guest require accessibility considerations?</p>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guest_access" value="true" id="guest_access-true">
                            <label for="guest_access-true">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guest_access" value="false" id="guest_access-false">
                            <label for="guest_access-false">No</label>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>




                </div>
            </div>


            <div class="guestAccess collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10 grey-bg">
                        <p>My guest requires:</p>

                        @foreach($access as $option)
                            <div class="form-check">
                                <input type="checkbox" id="guest_{{$option->short_name}}"
                                       name="guest_{{$option->short_name}}" value="true">
                                <label class="block" for="{{$option->short_name}}">{{$option->description}}</label>
                            </div>
                        @endforeach
                        <p>If your guest has additional requirements or considerations please contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a>.</p>

                    </div>
                    <div class="col-1">&nbsp;</div>



                </div>
            </div>

            <div class="isAttending collapse">
                <div class="row">

                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <p>Do you have dietary requirements or allergies we should be made aware of?</p>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="recip_diet" value="true" id="recip_diet-true">
                            <label for="recip_diet-true">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="recip_diet" value="false" id="recip_diet-false">
                            <label for="recip_diet-false">No</label>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>



                </div>
            </div>

            <div class="recipDiet collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10 grey-bg">
                        <p>My dietary requirements are:</p>
                        @foreach($diet as $option)
                            <div class="form-check">
                                <input type="checkbox" name="recip_{{$option->short_name}}" value="true"
                                       id="recip_{{$option->short_name}}">
                                <label for="recip_{{$option->short_name}}">{{$option->short_name}}</label>
                            </div>
                        @endforeach
                        <p>If you have additional requirements or considerations please contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a>.</p>
                    </div>
                    <div class="col-1">&nbsp;</div>


                </div>
            </div>

            <div class="hasGuest collapse">
                <div class="row">

                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <p>Does your guest have dietary requirements or allergies we should be made aware of?</p>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guest_diet" value="true" id="guest_diet-true">
                            <label for="guest_diet-true">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guest_diet" value="false" id="guest_diet-false">
                            <label for="guest_diet-false">No</label>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>

                </div>
            </div>


            <div class="guestDiet collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10 grey-bg">
                        <p>My guest's dietary requirements are</p>

                        @foreach($diet as $option)
                            <div class="form-check">
                                <input type="checkbox" name="guest_{{$option->short_name}}" value="true">
                                <label class="block" for="guest_{{$option->short_name}}">{{$option->short_name}}</label>
                            </div>
                        @endforeach
                        <p>If your guest has additional requirements or considerations please contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a>.</p>
                    </div>
                    <div class="col-1">&nbsp;</div>


                </div>
            </div>


            <div class="isAttending collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <p>Are you retiring before your Long Service Awards ceremony?</p>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="retiring" value="true" id="retiring-true">
                            <label for="retiring-true">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="retiring" value="false" id="retiring-false">
                            <label for="retiring-false">No</label>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>



                </div>
            </div>

            <div class="isRetiring collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <div class="form-group">
                            <label for="retirement_date">When are you retiring?</label>
                            <input type="date" id="retirement_date" name="retirement_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personal_phone-retiree">Personal Phone Number</label>
                            <input type="text" id="personal_phone-retiree" name="personal_phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personal_email-retiree">Personal Email</label>
                            <input type="text" id="personal_email" name="personal_email" class="form-control">
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>


                </div>

            </div>

            <div class="notAttending collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <p>Please confirm your office address so we can ensure you receive your Long Service Award.</p>
                        <p>Employees in Victoria should provide their office's physical address.</p>


                        <div class="form-group">
                            <label class="block font-medium text-sm text-gray-700" for="gift_location_floor">
                                Floor/room/care of </label>
                            <input type="text" class="form-control" name="office_address_prefix" id="gift_location_floor">
                        </div>

                        <div class="form-group">
                            <label class="block font-medium text-sm text-gray-700" for="gift_location_suit">
                                Suite </label>
                            <input type="text" class="form-control" name="office_address_suite" id="gift_location_suit">
                        </div>

                        <div class="form-group">
                            <label class="block font-medium text-sm text-gray-700" for="gift_location_addr">
                                Street Address </label>
                            <input type="text" class="form-control" name="office_address_street_address" id="gift_location_addr">

                        </div>

                        <div class="form-group">
                            <label class="block font-medium text-sm text-grey-700" for="community">
                                Community </label>
                            <select class="form-control" name="office_address_community_id" id="community">
                                @foreach($communities as $community)
                                    <option value="{{$community->id}}">{{$community->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label class="block font-medium text-sm text-gray-700" for="gift_location_postal"> Postal Code </label>
                            <input type="text"  class="form-control" name="office_address_postal_code" id="gift_location_postal">
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>



                </div>
            </div>



            <div class="notRetiring collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <h3>Contact</h3>

                        <p>To ensure you receive all communications about the Long Service Awards, please answer a few questions about how best to reach you.</p>
                        <p>Has your contact information changed since you registered?</p>


                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="contact_update" id="contact_update-true" value="true">
                            <label for="contact_update-true">Yes</label>
                        </div>
                        <div class="fom-check form-check-inline">
                            <input class="form-check-input" type="radio" name="contact_update" id="contact_update-false" value="false">
                            <label for="contact_update-false">No</label>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>




                </div>
            </div>

            <div class="contactUpdate collapse">
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="home_email"> Personal email: </label>
                                    <input type="text" class="form-control" name="personal_email" id="home_email" >
                                </div>
                                <div class="form-group">
                                    <label for="home_phone"> Personal phone: </label>
                                    <input type="text" class="form-control" name="personal_phone" id="home_phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="office_email"> Office email: </label>
                                    <input type="text" class="form-control" name="office_email" id="office_email"/>
                                </div>

                                <div class="form-group">
                                    <label for="preferred_phone"> Office Phone: </label>
                                    <input type="text" class="form-control" name="office_phone" id="office_phone" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>


                </div>
                <div class="row">
                    <div class="col-1">&nbsp;</div>
                    <div class="col-10">
                        <p>Which contact information would you prefer we use?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="preferred_contact" id="preferred_contact-personal" value="personal">
                            <label type="radio" for="preferred_contact-personal">Personal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="preferred_contact" id="preferred_contact-office" value="office">
                            <label type="radio" for="preferred_contact-office">Office</label>
                        </div>
                    </div>
                    <div class="col-1">&nbsp;</div>
                </div>
            </div>

            <div class="row">
                <div class="col-1">&nbsp;</div>
                <div class="col-10">

                    <input type="hidden" name="recipid" value="{{$rid}}">

                    <!--------------------------
                        Submit button.
                        ------------------------->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="width: 250px; height: 80px; float: right; font-size: 25pt;">
                            Submit RSVP
                        </button>
                    </div>

                </div>
                <div class="col-1">&nbsp;</div>
            </div>


        </form>
    </div>

    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script>
        $('input[name=rsvp]').change(function() {
            if ($('input[name=rsvp]:checked').val() == 'true') {
                $('.isAttending').collapse('show');
                $('.notAttending').collapse('hide');
            } else {
                $('.notAttending').collapse('show');
                $('.isAttending').collapse('hide');
            }
        });
        $('input[name=guest]').change(function() {
            if ($('input[name=guest]:checked').val() == 'true') {
                $('.hasGuest').collapse('show');
            } else {
                $('.hasGuest').collapse('hide');
            }
        });
        $('input[name=recip_access]').change(function() {
            if ($('input[name=recip_access]:checked').val() == 'true') {
                $('.recipAccess').collapse('show');
            } else {
                $('.recipAccess').collapse('hide');
            }
        });
        $('input[name=guest_access]').change(function() {
            if ($('input[name=guest_access]:checked').val() == 'true') {
                $('.guestAccess').collapse('show');
            } else {
                $('.guestAccess').collapse('hide');
            }
        });
        $('input[name=recip_diet]').change(function() {
            if ($('input[name=recip_diet]:checked').val() == 'true') {
                $('.recipDiet').collapse('show');
            } else {
                $('.recipDiet').collapse('hide');
            }
        });
        $('input[name=guest_diet]').change(function() {
            if ($('input[name=guest_diet]:checked').val() == 'true') {
                $('.guestDiet').collapse('show');
            } else {
                $('.guestDiet').collapse('hide');
            }
        });
        $('input[name=retiring]').change(function() {
            if ($('input[name=retiring]:checked').val() == 'true') {
                $('.isRetiring').collapse('show');
                $('.notRetiring').collapse('hide');
            } else {
                $('.isRetiring').collapse('hide');
                $('.notRetiring').collapse('show');
            }
        });
        $('input[name=contact_update]').change(function() {
            if ($('input[name=contact_update]:checked').val() == 'true') {
                $('.contactUpdate').collapse('show');
            } else {
                $('.contactUpdate').collapse('hide');
            }
        });



    </script>

</body>
</html>
