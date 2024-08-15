<x-mail::message>
# Introduction

Hello {{$name}}
Welcome to BL4ZE ecommerce website where everything na fake and we will be able to contact with thanks
to the phone number provided which is {{$phone}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
