<div>
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            {{-- <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans font-semibold leading-normal text-sm">Today's Money</p>
                      <h5 class="mb-0 font-bold">
                        $53,000
                        <span class="leading-normal text-sm font-weight-bolder text-lime-500">+55%</span>
                      </h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                      <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

            <!-- card2 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Users</p>
                                    <h5 class="mb-0 font-bold">
                                        {{ $totalUsers }}
                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                    <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card3 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Business
                                        Acounts</p>
                                    <h5 class="mb-0 font-bold">
                                        {{ $totalBusinessAccount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                    <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card4 -->
            {{-- <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans font-semibold leading-normal text-sm">Sales</p>
                      <h5 class="mb-0 font-bold">
                        $103,430
                        <span class="leading-normal text-sm font-weight-bolder text-lime-500">+5%</span>
                      </h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                      <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>

        <!-- cards row 2 -->
        {{-- <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                    <div class="flex flex-col h-full">
                      <p class="pt-2 mb-1 font-semibold">Welcome Businesses!</p>
                      <h5 class="font-bold">Get Reviewed on Our Platform</h5>
                      <p class="mb-12">Join our community of users and showcase your business. From restaurants to tech companies, our platform welcomes all.</p>
                      <a class="mt-auto mb-0 font-semibold leading-normal text-sm group text-slate-500" href="javascript:;">
                        Learn More
                        <i class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200"></i>
                      </a>
                    </div>
                  </div>
                  <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                    <div class="h-full bg-gradient-to-tl from-purple-700 to-pink-500 rounded-xl">
                      <img src="{{asset('assets/')}}/img/shapes/waves-white.svg" class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves" />
                      <div class="relative flex items-center justify-center h-full">
                        <img class="relative z-20 w-full pt-6" src="{{asset('assets/')}}/img/illustrations/rocket-white.png" alt="rocket" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
              <div class="relative h-full overflow-hidden bg-cover rounded-xl" style="background-image: url('{{asset('assets/')}}/img/ivancik.jpg')">
                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                  <h5 class="pt-2 mb-6 font-bold text-white">Discover New Businesses</h5>
                  <p class="text-white">Explore a variety of businesses and share your experiences with others. Your reviews help others make informed decisions.</p>
                  <a class="mt-auto mb-0 font-semibold leading-normal text-white group text-sm" href="javascript:;">
                    Explore More
                    <i class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
         --}}

        <!-- cards row 3 -->
        {{--     
        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
              <div class="flex-auto p-4">
                <div class="py-4 pr-1 mb-4 bg-gradient-to-tl from-gray-900 to-slate-800 rounded-xl">
                  <div>
                    <canvas id="chart-bars" height="170"></canvas>
                  </div>
                </div>
                <h6 class="mt-6 mb-0 ml-2">Business Metrics</h6>
                <p class="ml-2 leading-normal text-sm">Check out our latest business metrics.</p>
                <div class="w-full px-6 mx-auto max-w-screen-2xl rounded-xl">
                  <div class="flex flex-wrap mt-0 -mx-3">
                    <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                      <div class="flex mb-2">
                        <div class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl from-purple-700 to-pink-500 text-neutral-900">
                          <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>document</title>
                            <!-- Your SVG content -->
                          </svg>
                        </div>
                        <p class="mt-1 mb-0 font-semibold leading-tight text-xs">Users</p>
                      </div>
                      <h4 class="font-bold">36K</h4>
                      <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                        <div class="duration-600 ease-soft -mt-0.38 -ml-px flex h-1.5 w-3/5 flex-col justify-center overflow-hidden whitespace-nowrap rounded-lg bg-slate-700 text-center text-white transition-all" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                    <!-- More sections here -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
              <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6>Sales Overview</h6>
                <p class="leading-normal text-sm">
                  <i class="fa fa-arrow-up text-lime-500"></i>
                  <span class="font-semibold">4% more</span> in the last quarter.
                </p>
              </div>
              <div class="flex-auto p-4">
                <div>
                  <canvas id="chart-line" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div> --}}


        <!-- cards row 4 -->

        <div class="flex flex-wrap my-6 -mx-3">
            <!-- card 1 -->

            <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <div class="flex flex-wrap mt-0 -mx-3">
                            <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                                <h6>Latest Business Account</h6>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-6 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Business Name</th>
                                        {{-- <th class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Members</th> --}}
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Phone number</th>
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            User Name</th>
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Approved</th>
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Verified</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($businessAccounts as $businessAccount)
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                                <a
                                                    href="{{ route('admin.view-business-account', ['business_name' => $businessAccount->businessName]) }}">

                                                    <div class="flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('storage/' . $businessAccount->business_image) }}"
                                                                class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                                alt="xd" />
                                                        </div>
                                                        <div class="flex flex-col justify-center">
                                                            <h6 class="mb-0 leading-normal text-sm">
                                                                {{ $businessAccount->businessName }}</h6>

                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            {{-- <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                          <div class="mt-2 avatar-group">
                            <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                              <img src="{{asset('assets/')}}/img/team-1.jpg" class="w-full rounded-full" alt="team1" />
                            </a>
                            <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                              Ryan Tompson
                              <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                            </div>
                            <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                              <img src="{{asset('assets/')}}/img/team-2.jpg" class="w-full rounded-full" alt="team2" />
                            </a>
                            <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                              Romina Hadid
                              <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                            </div>
                            <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                              <img src="{{asset('assets/')}}/img/team-3.jpg" class="w-full rounded-full" alt="team3" />
                            </a>
                            <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                              Alexander Smith
                              <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                            </div>
                            <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                              <img src="{{asset('assets/')}}/img/team-4.jpg" class="w-full rounded-full" alt="team4" />
                            </a>
                            <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                              Jessica Doe
                              <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                            </div>
                          </div>
                        </td> --}}
                                            <td
                                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                                <span class="font-semibold leading-tight text-xs">
                                                    {{ $businessAccount->phone_number }}</span>
                                            </td>
                                            <td
                                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                                <span class="font-semibold leading-tight text-xs">
                                                    {{ $businessAccount->username }}</span>
                                            </td>
                                            <td
                                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                                <span class="font-semibold leading-tight text-xs">
                                                    @if ($businessAccount->is_approved)
                                                        <i class="fa fa-check text-cyan-500"></i>
                                                    @else
                                                        <span class="text-red-500">❌</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td
                                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                                <span class="font-semibold leading-tight text-xs">
                                                    @if ($businessAccount->is_verified)
                                                        <i class="fa fa-check text-cyan-500"></i>
                                                    @else
                                                        <span class="text-red-500">❌</span>
                                                    @endif
                                                </span>
                                            </td>


                                        </tr>
                                    @empty
                                        <tr>
                                          <td colspan="5" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card 2 -->

            <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none lg:w-1/3 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <h6>Latest Reviews</h6>
                    </div>
                    <div class="flex-auto p-4">
                        @forelse ($latestReviews as $review)
                            <div class="relative mb-4 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    @if ($review->rating >= 3.5)
                                        <i class="far fa-smile text-green-500"></i> <!-- Good rating -->
                                    @elseif ($review->rating >= 2 && $review->rating < 3.5)
                                        <i class="far fa-meh text-yellow-500"></i> <!-- Average rating -->
                                    @else
                                        <i class="far fa-frown text-red-500"></i> <!-- Bad rating -->
                                    @endif
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">

                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">Rating:

                                        @php
                                            $fullStars = floor($review->rating);
                                            $halfStar = ceil($review->rating - $fullStars);
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star text-yellow-500"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt text-yellow-500"></i>
                                        @endif
                                        @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                            <i class="far fa-star text-gray-400"></i>
                                        @endfor
                                    </h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">Added by:
                                        {{ $review->user->name }}</p>
                                </div>
                            </div>
                        @empty
                            <p>No reviews yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
