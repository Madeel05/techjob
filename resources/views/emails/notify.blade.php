<x-mail::message>
# Introduction

Congratulation! You are now premium user
    <p>Your Purchase detail</p>
    <p>plan: {{$plan}}</p>
    <p>Your plan ends {{$billing_ends}}</p>
<x-mail::button :url="''">
Post a job
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
