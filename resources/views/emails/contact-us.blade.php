@component('mail::message')
<strong> {{ 'Sender:' }} </strong>
{{ $data['name'] }}

<strong> {{ 'Email:' }} </strong>
{{ $data['email'] }}

<div>
    <strong> {{ 'Message:' }} </strong>
    {!! $data['message'] !!}
</div>
@endcomponent