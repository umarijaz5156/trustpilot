<div class="p-5">


    <div class="flex flex-col items-center">
        <!-- Center the logo -->
        <div class="mb-2">
            <img src="{{ asset('images/LOGO.png') }}" class="h-12 mx-auto" alt="">
        </div>
        <!-- Display business name -->
        <div id="businessName" class="hot_bleep_business-name ">{{ $businessName }}</div>
        <!-- Display rating -->
        <div class="flex items-center">
            <div class="text-gold text-3xl mr-2">
                <!-- Display stars based on average rating -->
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $averageRating)
                        <span class="hot-bleep-star text-yellow-500">&#9733;</span>
                    @else
                        <span class="hot-bleep-star text-yellow-500">&#9734;</span>
                    @endif
                @endfor
            </div>
        </div>
        <div class="flex items-center">
        <span class="mr-2">TrustBank </span><span class="text-lg font-bold mr-2"> {{ $averageRating }}</span>
        <span class="text-lg">({{ $reviewsCount }} reviews)</span>
        </div>
       
    </div>
    
    

    <div class=" mx-auto">
        <h3 class="text-sxl font-semibold mt-8 mb-4">Insert this JavaScript code in your webpage to fetch the latest reviews
            data and dynamically update the HTML content.</h3>
       
        <div class="bg-gray-100 rounded-lg overflow-hidden relative">
            <textarea id="jsContent" class="w-full p-4 border-0 resize-none" readonly><script src="{{ asset('widget/reviews.js') }}" data-full-url="{{ $fullUrl }}"></script></textarea>
            <span class="absolute top-2 right-2">
                <i id="copyButtonJS" class="fas fa-copy text-gray-500 cursor-pointer" title="Copy JS code"></i>
            </span>
        </div>
    
        <h3 class="text-sxl font-semibold mt-8 mb-4">Place this HTML content where you want to display the business reviews
            on your webpage.</h3>
        <div class="bg-gray-100 rounded-lg overflow-hidden relative">
            <textarea id="htmlContent" class="w-full p-4 border-0 resize-none"  readonly><div class="hot-bleep-widget" businessunit-id="{{ $encryptedId }}"></div></textarea>
            <span class="absolute top-2 right-2">
                <i id="copyButton"  class="fas fa-copy text-gray-500 cursor-pointer" title="Copy HTML code"></i>
            </span>
        </div>
    </div>
    
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const copyButton = document.getElementById('copyButton');
                const htmlContent = document.getElementById('htmlContent');

                copyButton.addEventListener('click', function() {
                    htmlContent.select();
                    document.execCommand('copy');
                    alert('HTML content copied to clipboard!');
                });

                const copyButtonJS = document.getElementById('copyButtonJS');
                const jsContent = document.getElementById('jsContent');

                copyButtonJS.addEventListener('click', function() {
                    jsContent.select();
                    document.execCommand('copy');
                    alert('JSS content copied to clipboard!');
                });

            });
        </script>
        <script src="{{ asset('widget/reviews.js') }}" data-full-url="{{ $fullUrl }}"></script>
    @endpush

</div>
