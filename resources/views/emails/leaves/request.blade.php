@component('mail::message')
#Leave request

{{ $leave->user->name }} is requesting a leave

@component('mail::button', ['url' => '{{ route("show.leaves") }}'])
check leave here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
