<div>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>


        <div class="my-2">
            @if (session('success'))
                <x-alerts.success :success="session('success')" />
            @endif
    
            @if (session('error'))
                <x-alerts.error :error="session('error')" />
            @endif
        </div>
        <form wire:submit.prevent="Store">

            <h1 class="text-center font-bold p-2 text-xl "> Email Verification </h1>
            <div>
                <x-label for="email" value="{{ __('Verification Code') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="verification_code" type="text"  :value="old('verification_code')"  autofocus />
                <x-input-error for="verification_code" />

            </div>

            <div class="flex items-center justify-between mt-4">
                <button wire:click.prevent="resendVerificationCode" class="text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Resend Verification Code') }}
                </button>
                <x-button class="ms-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</div>
