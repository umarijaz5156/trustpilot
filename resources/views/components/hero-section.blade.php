@props(['title', 'body'])

<div class="bg-cover bg-center bg-no-repeat h-[319px] flex justify-start items-end p-6" style="background-image: url({{ asset('images/step-form-hero-img.png') }});">
    <div class="space-y-3 text-white">

        <div>
            <h1 class="text-2xl font-semibold">{{ $title }}</h1>
        </div>
        <p class="italic  text-base">
            {{ $body }}
            {{-- Welcome to our

                Events not to Forget

            page! Here you can easily add the necessary <br class="sm:block hidden"> information for the intended recipient . Please fill out the required fields with accurate <br class="sm:block hidden"> and up-to-date information --}}
        </p>
    </div>
</div>
