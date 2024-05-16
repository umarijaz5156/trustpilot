@if (auth()->user()->is_admin)
    <x-app-layout>
        <x-profile.show />
    </x-app-layout>
@else
    @php abort(403); @endphp
@endif
