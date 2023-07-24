<x-mail::message>
# New Contact Message

You received a new message from {{ config('app.name') }} contact form from *{{ $contact->name }}*.

# Here are the details:

# Name: {{ $contact->name }}
# Email: {{ $contact->email }}
# Mobile: {{ $contact->mobile ?? 'N/A' }}
# Message: {{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
