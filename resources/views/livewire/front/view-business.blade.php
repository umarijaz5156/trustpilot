<div>
    <style>
        #full-stars-example {

            /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
            .rating-group {
                display: inline-flex;
            }

            /* make hover effect work properly in IE */
            .rating__icon {
                pointer-events: none;
            }

            /* hide radio inputs */
            .rating__input {
                position: absolute !important;
                left: -9999px !important;
            }

            /* set icon padding and size */
            .rating__label {
                cursor: pointer;
                padding: 0 0.1em;
                font-size: 2rem;
            }

            /* set default star color */
            .rating__icon--star {
                color: orange;
            }

            /* set color of none icon when unchecked */
            .rating__icon--none {
                color: #eee;
            }

            /* if none icon is checked, make it red */
            .rating__input--none:checked+.rating__label .rating__icon--none {
                color: red;
            }

            /* if any input is checked, make its following siblings grey */
            .rating__input:checked~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make all stars orange on rating group hover */
            .rating-group:hover .rating__label .rating__icon--star {
                color: orange;
            }

            /* make hovered input's following siblings grey on hover */
            .rating__input:hover~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make none icon grey on rating group hover */
            .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
                color: #eee;
            }

            /* make none icon red on hover */
            .rating__input--none:hover+.rating__label .rating__icon--none {
                color: red;
            }
        }

        #half-stars-example {

            /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
            .rating-group {
                display: inline-flex;
            }

            /* make hover effect work properly in IE */
            .rating__icon {
                pointer-events: none;
            }

            /* hide radio inputs */
            .rating__input {
                position: absolute !important;
                left: -9999px !important;
            }

            /* set icon padding and size */
            .rating__label {
                cursor: pointer;
                /* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
                padding: 0 0.1em;
                font-size: 2rem;
            }

            /* add padding and positioning to half star labels */
            .rating__label--half {
                padding-right: 0;
                margin-right: -1.2em;
                z-index: 2;
            }

            /* set default star color */
            .rating__icon--star {
                color: orange;
            }

            /* set color of none icon when unchecked */
            .rating__icon--none {
                color: #eee;
            }

            /* if none icon is checked, make it red */
            .rating__input--none:checked+.rating__label .rating__icon--none {
                color: red;
            }

            /* if any input is checked, make its following siblings grey */
            .rating__input:checked~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make all stars orange on rating group hover */
            .rating-group:hover .rating__label .rating__icon--star,
            .rating-group:hover .rating__label--half .rating__icon--star {
                color: orange;
            }

            /* make hovered input's following siblings grey on hover */
            .rating__input:hover~.rating__label .rating__icon--star,
            .rating__input:hover~.rating__label--half .rating__icon--star {
                color: #ddd;
            }

            /* make none icon grey on rating group hover */
            .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
                color: #eee;
            }

            /* make none icon red on hover */
            .rating__input--none:hover+.rating__label .rating__icon--none {
                color: red;
            }
        }

        #full-stars-example-two {

            /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
            .rating-group {
                display: inline-flex;
            }

            /* make hover effect work properly in IE */
            .rating__icon {
                pointer-events: none;
            }

            /* hide radio inputs */
            .rating__input {
                position: absolute !important;
                left: -9999px !important;
            }

            /* hide 'none' input from screenreaders */
            .rating__input--none {
                display: none
            }

            /* set icon padding and size */
            .rating__label {
                cursor: pointer;
                padding: 0 0.1em;
                font-size: 2rem;
            }

            /* set default star color */
            .rating__icon--star {
                color: orange;
            }

            /* if any input is checked, make its following siblings grey */
            .rating__input:checked~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make all stars orange on rating group hover */
            .rating-group:hover .rating__label .rating__icon--star {
                color: orange;
            }

            /* make hovered input's following siblings grey on hover */
            .rating__input:hover~.rating__label .rating__icon--star {
                color: #ddd;
            }
        }
    </style>



    <div class="container mx-auto px-4">
        <div class="py-8">
            <div class="flex">
                <div class="w-1/4">
                    <div class="sticky top-0">
                        <div class="bg-white p-4 rounded-lg shadow-lg mb-4">
                            <h2 class="text-2xl mt-4 font-bold mb-4">{{ $businessAccount->username }}</h2>

                            <h3 class="text-lg font-semibold mb-2">Business Image</h3>
                            <img src="{{ asset('storage/' . $businessAccount->business_image) }}"
                                class="w-full rounded-lg" alt="Business Image">
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="mb-4 mt-5">
                                <h3 class="text-lg font-semibold">Owner: {{ $businessAccount->user->name }}</h3>
                                <p>Email: {{ $businessAccount->user->email }}</p>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold">Category: {{ $businessAccount->category->title }}</h3>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Description</h3>
                            <div style="height: 160px" class=" overflow-y-auto custom-scrollbar">
                                <p>{!! $businessAccount->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-3/4 ml-8">
                    <div class="bg-white p-4 rounded-lg shadow-lg">

                        <h2 class="text-2xl font-bold mb-4">Reviews</h2>
                        <div id="overallRating" class="mb-4">
                            <p class="text-lg font-semibold">
                                Overall Rating: {{ number_format($overallRating, 1) }}
                                <span class="text-yellow-500">
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </span>
                                ({{ $totalReviews }} reviews)
                            </p>
                        </div>

                        <div>
                            @if (session('success'))
                                <x-alerts.success :success="session('success')" />
                            @endif

                            @if (session('error'))
                                <x-alerts.error :error="session('error')" />
                            @endif
                        </div>
                        <!-- All Reviews -->
                        <div id="allReviews" class="mb-4">
                            <h3 class="text-lg font-semibold">All Reviews</h3>
                            <ul id="reviewsList" class="space-y-4">
                                @forelse ($reviews as $review)
                                    <style>
                                        .dulledReview {
                                            opacity: 0.5;
                                            filter: grayscale(100%);
                                        }
                                    </style>
                                    <li
                                        class="reviewItem {{ $review->disputed ? 'dulledReview' : '' }} bg-gray-100 p-4 rounded-lg">
                                        <div class="text-gray-700 font-semibold mr-2">{{ $review->user->name }}</div>

                                        <div
                                            class="review-content flex flex-col lg:flex-row items-start justify-between">

                                            <!-- Star rating and review content -->
                                            <div class=" " style="width: 90%">
                                                @php
                                                    $fullStars = floor($review->rating);
                                                    $halfStar = ceil($review->rating - $fullStars);
                                                @endphp
                                                <span class="text-yellow-500">
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    @if ($halfStar)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @endif
                                                    @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                                        <i class="far fa-star"></i>
                                                    @endfor
                                                </span>
                                                <div class="py-2 overflow-y-auto custom-scrollbar">
                                                    <p>{!! $review->review !!}</p>
                                                </div>


                                            </div>

                                            <!-- Action buttons -->
                                            <div class="flex justify-end items-center mt-2 lg:mt-0 lg:w-1/4">

                                                @if ($businessAccount->user_id == Auth::id())
                                                    <button wire:click="replyReview({{ $review->id }})"
                                                        class="bg-gray-200 text-gray-600 px-3 py-1 rounded-md mr-2">
                                                        <i class="fas fa-reply"></i>
                                                    </button>
                                                @endif

                                                @if ($review->user_id == Auth::id())
                                                    @if (now()->diffInDays($review->created_at) <= $edit_review_par_day)
                                                        <button wire:click="EditReview({{ $review->id }})"
                                                            class="text-blue-500 px-2 py-1 rounded-md">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                                @if ($review->is_edited)
                                                    <span class="text-gray-500 ml-1 mr-2">(edited)</span>
                                                @endif

                                                @if ($businessAccount->user_id == Auth::id())
                                                    @if ($review->tickets()->count() > 0)
                                                        @if ($latst_ticket = $review->tickets()->latest()->first()?->ticket_status == 'closed')
                                                            <button wire:click="showDisputeModal({{ $review->id }})"
                                                                title="start dispute" class="w-8 h-8"><img
                                                                    src="{{ asset('images/dispute.png') }}"
                                                                    alt="" /></button>
                                                        @endif
                                                    @else
                                                        <button wire:click="showDisputeModal({{ $review->id }})"
                                                            title="start dispute" class="w-8 h-8"><img
                                                                src="{{ asset('images/dispute.png') }}"
                                                                alt="" /></button>
                                                    @endif
                                                @endif
                                                @if ($review->disputed)
                                                    <button title="Disputed Review" class="w-8 h-8">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </button>
                                                @endif

                                            </div>
                                        </div>

                                        <ul class="space-y-2 mt-4 px-4">
                                            @foreach ($review->replies as $reply)
                                                <li class="flex justify-between items-start p-2 bg-gray-200 rounded-lg">
                                                    <div style="max-width: 80%;">
                                                        <!-- Set maximum width for the message container -->
                                                        <p class="font-semibold">{{ $businessAccount->businessName }}
                                                            <small>(Owner)</small>
                                                        </p>
                                                        <div class="py-1">{!! $reply->message !!}</div>
                                                    </div>
                                                    <div class="flex items-center"> <!-- Flex container for buttons -->
                                                        @if ($businessAccount->user_id == Auth::id() && $reply->user_id == Auth::id())
                                                            <button wire:click="EditReviewReply({{ $reply->id }})"
                                                                class="text-blue-500 px-2 py-1 rounded-md">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button wire:click="DeleteReviewReply({{ $reply->id }})"
                                                                class="text-red-500 px-2 py-1 rounded-md">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </li>
                                @empty
                                    <li class="text-gray-500">No reviews yet.</li>
                                @endforelse
                            </ul>
                            <div class="mt-3 flex justify-end">
                                @if ($reviews->count() > $numReviewsToShow)
                                    <button wire:click="showMoreReviews"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Show
                                        More</button>
                                @endif
                            </div>
                        </div>

                        @if (Auth::check())
                            @if (!$alreadyReviewed && $businessAccount->user_id != Auth::id())
                                <div class="mb-4">
                                    <button wire:click="addReview"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-full">Add Review</button>
                                </div>
                            @endif
                        @else
                            <div class="mb-4">
                                <a href="{{ route('login') }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-full">Login to
                                    Add Review</a>
                            </div>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>

    @if ($addReviewModel)
        <x-modals.modal wire:model.live="addReviewModel" maxWidth="5xl">
            @slot('headerTitle')
                Review
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdate">
                    <div class="mb-4">

                        <div id="half-stars-example">
                            <div class="rating-group">
                                <input class="rating__input rating__input--none" checked wire:model="rating" id="rating-0"
                                    value="0" type="radio">
                                <label aria-label="0 stars" class="rating__label" for="rating-0">&nbsp;</label>
                                <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                    for="rating-05"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-05" value="0.5"
                                    type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating-10"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-10" value="1"
                                    type="radio">
                                <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                    for="rating-15"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-15" value="1.5"
                                    type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating-20"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-20" value="2"
                                    type="radio">
                                <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                    for="rating-25"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-25" value="2.5"
                                    type="radio">
                                <label aria-label="3 stars" class="rating__label" for="rating-30"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-30" value="3"
                                    type="radio">
                                <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                    for="rating-35"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-35" value="3.5"
                                    type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating-40"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-40" value="4"
                                    type="radio">
                                <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                    for="rating-45"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-45" value="4.5"
                                    type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating-50"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-50" value="5"
                                    type="radio">
                            </div>
                        </div>

                    </div>
                    <x-input-error for="rating" />



                    <!-- Review Text -->
                    <div class="mb-4" wire:ignore>
                        <label for="review" class="block text-sm font-medium text-gray-600">Review</label>
                        <textarea wire:model.live="review" id="review" maxlength="1000" class="mt-1 p-3 w-full border rounded-md"></textarea>
                        <small>The minimum length is 5 characters, and the maximum length is 1000 characters.</small>

                    </div>
                    <x-input-error for="spam_error" />
                    <x-input-error for="review" />


                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>
                </form>
            @endslot
        </x-modals.modal>
    @endif

    @if ($replyReviewModel)
        <x-modals.modal wire:model.live="replyReviewModel" maxWidth="5xl">
            @slot('headerTitle')
                Reply
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdateReply">
                    <!-- Review Text -->
                    <div class="mb-4" wire:ignore>
                        <label for="message" class="block text-sm font-medium text-gray-600">Message</label>
                        <textarea wire:model.live="message" id="message" maxlength="1000" class="mt-1 p-3 w-full border rounded-md"></textarea>
                    </div>
                    <x-input-error for="spam_error" />
                    <x-input-error for="message" />

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>
                </form>
            @endslot
        </x-modals.modal>
    @endif


    <x-modals.delete-alert message="You are going to delete this Reply" />

    <x-modals.modal wire:model.live="disputeModal" maxWidth="3xl">
        @slot('headerTitle')
            Dispute Modal
        @endslot

        @slot('content')
            <form class="my-5 space-y-6" wire:submit.prevent="createDispute">
                <div class="mb-4">
                    <label for="description" class="block text-gray-600 text-sm font-medium mb-2">Description:</label>
                    <textarea wire:model="description" id="description" name="description" rows="4" class="w-full border p-2"></textarea>
                    <x-input-error for="description" />
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-gray-600 text-sm font-medium mb-2">Attachments:</label>
                    <x-form.upload-files wire:model.live="attachments" multiple
                        allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'video/mp4']" />
                    <x-input-error for="attachments" />
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                    Submit
                </button>
            </form>
        @endslot
    </x-modals.modal>

</div>

<script>
    let editorOptions = {
        height: '250px',
        tabSpaces: 4,
        removePlugins: 'forms,smiley,iframe,link,div,save'
    };

    window.addEventListener('initReviewEditor', event => {
        function findReviewId() {
            const reviewId = document.getElementById('review');
            if (reviewId) {
                clearInterval(reviewIdInterval);
                const editorC = CKEDITOR.replace('review', editorOptions);
                editorC.on('change', function(event) {
                    @this.set('review', event.editor.getData());
                });

                window.addEventListener('updateCkEditorBody', event => {
                    let changedVal = @this.get('review');

                    editorC.setData(changedVal);
                });


                const updateEvent = new Event('updateCkEditorBody');
                window.dispatchEvent(updateEvent);
            }

        }

        const reviewIdInterval = setInterval(findReviewId, 200);
    });


    window.addEventListener('initReplyEditor', event => {
        function findReplyMessageId() {
            const replyMessageId = document.getElementById('message');

            if (replyMessageId) {
                clearInterval(replyMessageIdInterval);
                const editorM = CKEDITOR.replace('message', editorOptions);
                editorM.on('change', function(event) {
                    @this.set('message', event.editor.getData());
                });

                window.addEventListener('updateCkEditorBodyMessage', event => {
                    let changedVal = @this.get('message');

                    editorM.setData(changedVal);
                });

                const updateEvent = new Event('updateCkEditorBodyMessage');
                window.dispatchEvent(updateEvent);
            }
        }

        const replyMessageIdInterval = setInterval(findReplyMessageId, 200);
    });
</script>
