<div>
     <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 0.3rem;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #1BAAFA;
            outline: 1px solid #75ecaf;
            border-radius: 99px;

        }
    </style>
    <!-- Content -->
    <div class="sm:px-10 relative">


        {{-- <div class="bg-contain bg-center w-full bg-no-repeat p-10 grid h-[350px] md:h-[600px] place-items-end"
            style="background-image: url('{{ asset('storage/'.Auth::user()->businessAccount->business_image) }}')">
            <div class="w-full">
                <h1 class="text-3xl font-semibold mb-3 text-[#8d5ffa]">{{ Auth::user()->businessAccount->businessName }}</h1>
                <h2 class="text-xl font-medium text-[#b3dff8]">
                    {!! Auth::user()->businessAccount->description !!}<br />
                    <span class="font-semibold italic"></span>
                </h2>
            </div>
           
        </div> --}}
  

        <div class="grid lg:grid-cols-2 gap-4 h-[500px] md:h-[600px] bg-blue-500 bg-opacity-25  px-10 mt-4">
            <div class="lg:col-span-2 text-center mt-4">
                <h2 class="text-xl lg:text-4xl font-bold">{{ Auth::user()->businessAccount->businessName }}</h2>
            </div>
            
            <!-- Logo -->
            <div class="flex justify-center items-center md:order-1">
                <img src="{{ asset('storage/' . Auth::user()->businessAccount->business_image) }}" alt="Logo"
                class="w-30 h-30 md:max-w-sm mx-auto bg-no-repeat bg-contain bg-center"
                >
                <!-- Adjust the image size and alignment based on your logo dimensions -->
            </div>

            <!-- Product Description -->
            <div class="p-6 md:p-2 md:order-2 overflow-y-auto custom-scrollbar {{ strlen(Auth::user()->businessAccount->description) < 1000 ? 'xl:flex justify-center items-center' : '' }}">
                <div class="py-2">
                    {{-- <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">Description</h2> --}}
                    <p class="text-sm">{!! Auth::user()->businessAccount->description !!}</p>
                </div>
            </div>
        </div>

        {{-- <div class="flex flex-col md:flex-row items-center">
            <!-- Product Description -->
            <div class="md:w-1/2 md:order-2">
                <p class="text-xl">{!! Auth::user()->businessAccount->description !!}</p>
                <!-- Add more content for the product description as needed -->
            </div>

            <!-- Logo -->
            <div class="md:w-1/2 md:order-1">
                <img src="{{ asset('storage/' . Auth::user()->businessAccount->business_image) }}" alt="Logo"
                    class="w-full md:max-w-sm mx-auto">
                <!-- Adjust the image size and alignment based on your logo dimensions -->
            </div>
        </div> --}}


        {{-- <div class="relative h-[700px]  sm:h-[660px]">
            <div class="bg-cover bg-center w-full md:h-[600px] bg-no-repeat"
                 style="background-image: url('{{ asset('storage/'.Auth::user()->businessAccount->business_image) }}')">
            </div>
            <div class="absolute bottom-0 w-full bg-black bg-opacity-40 p-10">
                <div class="px-5 mx-auto">
                    <h1 class="text-3xl font-semibold mb-3 text-[#fcfcfc]">{{ Auth::user()->businessAccount->businessName }}</h1>
                    <h2 class="text-xl font-medium text-[#fdfeff] leading-relaxed">
                        {!! Auth::user()->businessAccount->description !!}
                    </h2>
                </div>
            </div>
        </div> --}}


       
            <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="relative bg-[#fbb14247] border-2 border-[#FBB142] h-[176px] overflow-hidden">
                    <img src="{{ asset('images/main-card-mask.png') }}" class="absolute top-0 left-0" alt="" />
                    <div class="flex justify-between items-end gap-4 2xl:gap-12 h-full p-5 relative">
                        <div class="flex-1">
                            <div class="mb-4">
                                <h1 class="text-[#14183E] font-medium text-lg">
                                    Total Reviews
                                </h1>
                                <div class="bg-[#FBB142] rounded-full h-1 w-full mt-1"></div>
                            </div>
                            <span
                                class="text-[#14183E] font-semibold text-lg">{{ sprintf('%02d', Auth::user()->businessAccount->businessStat->reviews_count ?? 00) }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('images/main-card-img.png') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="relative bg-[#CEF6E9] border-2 border-[#65E3BB] h-[176px] overflow-hidden">
                    <img src="{{ asset('images/main-card-mask-2.png') }}" class="absolute top-0 left-0"
                        alt="" />
                    <div class="flex justify-between items-end gap-4 2xl:gap-12 h-full p-5 relative">
                        <div class="flex-1">
                            <div class="mb-4">
                                <h1 class="text-[#14183E] font-medium text-lg">
                                    Overall Ratings
                                </h1>
                                <div class="bg-[#65E3BB] rounded-full h-1 w-full mt-1"></div>
                            </div>
                            <span
                                class="text-[#14183E] font-semibold text-lg">{{ sprintf('%02d', Auth::user()->businessAccount->businessStat->avg_rating ?? 00) }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('images/main-card-img-2.png') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="relative bg-[#1baafa47] border-2 border-[#1BAAFA] h-[176px] overflow-hidden">
                    <img src="{{ asset('images/main-card-mask-3.png') }}" class="absolute top-0 left-0"
                        alt="" />
                    <div class="flex justify-between items-end gap-4 2xl:gap-12 h-full p-5 relative">
                        <div class="flex-1">
                            <div class="mb-4">
                                <h1 class="text-[#14183E] font-medium text-lg">
                                    Positive Reviews Count
                                </h1>
                                <div class="bg-[#1BAAFA] rounded-full h-1 w-full mt-1"></div>
                            </div>
                            <span
                                class="text-[#14183E] font-semibold text-lg">{{ sprintf('%02d', Auth::user()->businessAccount->businessStat->positive_reviews_count ?? 00) }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('images/main-card-img-3.png') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="relative bg-[#FAD1D8] border-2 border-[#EB97A7] h-[176px] overflow-hidden">
                    <img src="{{ asset('images/main-card-mask-4.png') }}" class="absolute top-0 left-0"
                        alt="" />
                    <div class="flex justify-between items-end gap-4 2xl:gap-12 h-full p-5 relative">
                        <div class="flex-1">
                            <div class="mb-4">
                                <h1 class="text-[#14183E] font-medium text-lg">
                                    Negative Reviews Count
                                </h1>
                                <div class="bg-[#EB97A7] rounded-full h-1 w-full mt-1"></div>
                            </div>
                            <span
                                class="text-[#14183E] font-semibold text-lg">{{ sprintf('%02d', Auth::user()->businessAccount->businessStat->negative_reviews_count ?? 00) }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('images/main-card-img-4.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 pb-6 px-5 sm:px-0">
            <div class="">
                <div class="flex-auto bg-white p-6 rounded-lg relative">
                    <div>
                        <h1 class="text-[#8D5FFA] text-[18px] font-bold">
                            Monthly Spending
                        </h1>
                    </div>
                    <div class="absolute left-3 top-[60%] translate-y-[-60%]"
                        style="transform-origin: center left; transform: rotate(270deg);">
                        <span class="text-[#5e628280] text-sm font-semibold">Spending per month</span>
                    </div>
                    <div class="text-center">
                        <canvas id="chart-line" class="md:h-[340px] w-full"></canvas>
                    </div>
                    <div class="text-center">
                        <span class="text-[#5e628280] text-sm font-semibold">Months</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="{{ asset('images/right-tabs-slider-main.png') }}"
                    class="absolute top-0 left-0 bottom-0 2xl:block hidden z-10" alt="">
                <div class="bg-[#387EE7] rounded 2xl:max-w-[calc(100%_-_188px)] h-full ml-auto py-5 px-6 2xl:pl-12 2xl:pr-6 relative"
                    x-data="{ active: 1 }">
                    <img src="{{ asset('images/upcoming-event-bell.png') }}" class="absolute top-0 right-0"
                        alt="">
                    <h1 class="text-3xl font-bold text-[#F8F8F8] relative">Upcoming Events</h1>
                    <div class="bg-white bg-opacity-10 rounded-md p-4 sm:h-[339px] xl:h-[85%] gap-4 relative mt-3">
                        <div class="flex justify-start items-center">
                            <button
                                class="px-4 py-2 text-[#F8F8F8] font-normal hover:text-[#00000043] relative after:bg-[#4FDFB1] after:absolute after:bottom-0 after:left-0 after:right-0 after:w-full after:h-[3px] after:rounded-full after:shadow-[0_4px_4px_rgb(0,0,0,0.25)]"
                                @click="active = 1" x-bind:class="active == 1 ? '' : 'after:hidden'">
                                Custom Events
                            </button>
                            <button
                                class="px-4 py-2 text-[#F8F8F8] font-normal hover:text-[#00000043] relative after:bg-[#4FDFB1] after:absolute after:bottom-0 after:left-0 after:right-0 after:w-full after:h-[3px] after:rounded-full after:shadow-[0_4px_4px_rgb(0,0,0,0.25)]"
                                @click="active = 2" x-bind:class="active == 2 ? '' : 'after:hidden'">
                                Generic Events
                            </button>
                        </div>
                        <div>

                            <div class="" x-bind:class="active == 1 ? '' : 'hidden'">

                                @if (0 > 0)
                                    <!-- <div id="controls-carousel" class="relative w-full" data-carousel="slide"> -->

                                    <div class="swiper mySwiper mt-[38px]">
                                        <div class="swiper-wrapper">
                                            @foreach ($upComingCustomEvents as $customEvent)
                                                <div class="swiper-slide">
                                                    <div class="space-y-3 px-4">
                                                        <h1 class="text-white font-medium uppercase text-xl">
                                                            {{ $customEvent['name'] }}</h1>
                                                        <div
                                                            class="text-white flex justify-start items-center gap-1 text-lg ">
                                                            <i class="fa fa-calendar"></i>
                                                            <span>
                                                                @if ($customEvent['is_recurring'])
                                                                    {{ \Carbon\Carbon::parse($customEvent['date'])->year(now()->format('Y'))->format('M
                                                                                                                                                                                                                                                                                                                                            d, Y') }}
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($customEvent['date'])->format('M
                                                                                                                                                                                                                                                                                                                                            d, Y') }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <p class="text-white text-lg font-medium">Recipient Name: <span
                                                                class="font-normal">
                                                                {{ $customEvent['recipient_name'] }}</span></p>
                                                        <a href="{{ route('view-recipient', ['recipient' => $customEvent['recipient_id']]) }}"
                                                            class="bg-[#4FDFB1] rounded text-[#387EE7] font-semibold px-4 py-3 inline-block !mt-14">
                                                            <i class="fas fa-long-arrow-alt-right text-lg"></i>
                                                            View Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-6 w-full bg-[#4FDFB1] py-2 rounded">
                                        <p class="text-center text-white">No Upcoming Custom Events</p>
                                    </div>
                                @endif

                                <div
                                    class="flex justify-start items-center gap-2 sm:absolute sm:right-3 sm:bottom-[32px] pp-prev px-4 mt-3 sm:mt-0 z-30">
                                    <button
                                        class="bg-transparent border border-[#4FDFB1] rounded text-[#4FDFB1] font-semibold px-4 py-3 inline-block custom-prev">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                    </button>
                                    <button
                                        class="bg-[#4FDFB1] rounded text-[#387EE7] font-semibold px-4 py-3 inline-block custom-next">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                        Next
                                    </button>
                                </div>

                            </div>
                            <div class="" x-bind:class="active == 2 ? '' : 'hidden'">
                                @if (0 > 0)
                                    <div class="swiper mySwiper2 mt-[38px]">
                                        <div class="swiper-wrapper">
                                            @foreach ($upComingGenericEvents as $genericEvent)
                                                <div class="swiper-slide">
                                                    <div class="space-y-3 px-4">
                                                        <h1 class="text-white font-medium uppercase text-xl">
                                                            {{ $genericEvent['name'] }}</h1>
                                                        <div
                                                            class="text-white flex justify-start items-center gap-1 text-lg ">
                                                            <i class="fa fa-calendar"></i>
                                                            <span>
                                                                @if ($genericEvent['is_recurring'])
                                                                    {{ \Carbon\Carbon::parse($genericEvent['date'])->year(now()->format('Y'))->format('M
                                                                                                                                                                                                                                                                                                                                        d, Y') }}
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($genericEvent['date'])->format('M
                                                                                                                                                                                                                                                                                                                                        d, Y') }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <p class="text-white text-lg font-medium">Recipient Name: <span
                                                                class="font-normal">
                                                                {{ $genericEvent['recipient_name'] ?? '' }}</span></p>
                                                        <a href="{{ route('view-recipient', ['recipient' => $genericEvent['recipient_id']]) }}"
                                                            class="bg-[#4FDFB1] rounded text-[#387EE7] font-semibold px-4 py-3 inline-block !mt-14">
                                                            <i class="fas fa-long-arrow-alt-right text-lg"></i>
                                                            View Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Slider controls -->
                                @else
                                    <div class="mt-6 w-full bg-[#4FDFB1] py-2 rounded">
                                        <p class="text-center text-white">No Upcoming Generic Events</p>
                                    </div>
                                @endif
                                <div
                                    class="flex justify-start items-center gap-2 sm:absolute sm:right-3 sm:bottom-[32px] pp-prev px-4 mt-3 sm:mt-0 z-30">
                                    <button
                                        class="bg-transparent border border-[#4FDFB1] rounded text-[#4FDFB1] font-semibold px-4 py-3 inline-block generic-prev">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                    </button>
                                    <button
                                        class="bg-[#4FDFB1] rounded text-[#387EE7] font-semibold px-4 py-3 inline-block generic-next ">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                        Next
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Content -->
        {{-- @push('scripts')
            @once
                <script>
                    $(document).ready(function() {
                        @if (session('guide'))

                            var event = new CustomEvent("start-tour", {
                                "detail": "Example of an event"
                            });
                            document.dispatchEvent(event);
                        @endif

                    });
                </script>
                <script>

                    if (document.querySelector("#chart-line")) {

                        var ctx1 = document.getElementById("chart-line").getContext("2d");

                        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

                        gradientStroke1.addColorStop(1, 'rgba(152, 111, 250, 0.1)');
                        gradientStroke1.addColorStop(0.2, 'rgba(152, 111, 250, 0.1)');
                        gradientStroke1.addColorStop(0, 'rgba(152, 111, 250, 0.1)');
                        var chart = new Chart(ctx1, {
                            type: "line",
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                                datasets: [{
                                    label: "Orders",
                                    tension: 0.4,
                                    borderWidth: 0,
                                    pointRadius: 0,
                                    borderColor: "#986FFA",
                                    backgroundColor: gradientStroke1,
                                    borderWidth: 3,
                                    fill: true,
                                    data: {{ Js::From(99) }},
                                    maxBarThickness: 6

                                }],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    }
                                },
                                interaction: {
                                    intersect: false,
                                    mode: 'index',
                                },
                                scales: {

                                    y: {
                                        // title: {
                                        //     display: true,
                                        //     text: 'Expense per month ($)'
                                        // },
                                        grid: {
                                            drawBorder: false,
                                            display: true,
                                            drawOnChartArea: true,
                                            drawTicks: false,
                                            borderDash: [5, 5],

                                        },
                                        ticks: {
                                            // stepSize:1,
                                            display: true,
                                            padding: 10,
                                            color: '#959595',
                                            font: {
                                                size: 14,
                                                family: "Open Sans",
                                                style: 'normal',
                                                lineHeight: 2,

                                            },
                                        }
                                    },
                                    x: {
                                        //     title: {
                                        //     display: true,
                                        //     text: 'months'
                                        // },
                                        grid: {
                                            drawBorder: false,
                                            display: false,
                                            drawOnChartArea: false,
                                            drawTicks: false,
                                            borderDash: [5, 5]
                                        },
                                        ticks: {
                                            display: true,
                                            color: '#959595',
                                            padding: 20,
                                            font: {
                                                size: 14,
                                                family: "Open Sans",
                                                style: 'normal',
                                                lineHeight: 2
                                            },
                                        }
                                    },
                                },
                            },
                        });

                        // chart.defaults.scales.linear.min = 0;
                    }
                </script>

            @endonce
        @endpush --}}


    </div>
</div>
