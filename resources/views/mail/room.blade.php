@if ($type == 'in')
    Check-In
@else
    Check-Out
@endif
<br />
Room Name: {{$room_name}} <br />
Room Number: {{$room_number}} <br />
Duration: {{$duration}} <br />
Price: {{$price}} <br />
Date Time: {{Carbon\Carbon::parse($date_time)->format('d/m/Y g:i a')}} <br />
by: {{$user}}