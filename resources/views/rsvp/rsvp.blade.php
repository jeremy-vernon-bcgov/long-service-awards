<!DOCTYPE html>
{{--
    Data: Object containing following values
        first_name: The first name of the recipient
        last_name: The last name of the recipient
        id: The recipients id
        type: The type of recipient this is (vip/exec etc.)
        guest_id: The id of the guest if the user already has one.
        ceremony_id: The id of the ceremony the user has been invited to.
        status: The status of the recipient (invited, assigned, attend, declined, waitlisted.
--}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>


    </head>

    <body >
        <h1 >
            RSVP
        </h1>
        <div >
            <div >
                {{-- <div> <strong> Hello {{$data->first_name . ' ' . $data->last_name }} </strong></div> --}}
                <form action="rsvp" method="POST">
                    <pre>{{ print_r($data) }}</pre>
                    @csrf
                    <input type="checkbox" name="rsvp" >I will be attending the LSA ceremonies.</label><br /><br />

                    <input type="checkbox" name="guest"  />
                    <label class="block font-medium text-sm text-gray-700"> A guest be attending with me.</label><br /><br />

                    <input type="text" name="guest_first_name" placeholder="Enter guests first name" /><br /><br />
                    <input type="text" name="guest_flast_name" placeholder="Enter guests last name" /><br /> <br />

                    <button type="submit"  >
                        Submit Response
                    </button>

                </form>
            </div>
        </div>
    </body>
</html>
