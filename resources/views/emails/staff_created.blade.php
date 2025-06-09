@component('mail::message')
# Hello {{ $name }},

{!! $content !!}

@if(isset($attachments) && count($attachments) > 0)
<small class="text-muted">
    This email contains attachments
</small>
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent