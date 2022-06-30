@component('mail::message')
# Introduction

Il post {{$postSlug}} è stato modificato

@component('mail::button', ['url' => 'postUrl'])
review post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
