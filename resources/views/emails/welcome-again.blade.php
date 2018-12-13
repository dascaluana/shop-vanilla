@component('mail::message')
# Introduction

Thanks so much for registering! <3

@component('mail::button', ['url' => 'http://laracasts.com'])
Start Browsing
@endcomponent

@component('mail::panel', ['url' => ''])
:) Some inspirational quote to go here. :)
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
