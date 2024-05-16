<div>
    {{-- start --}}

    @if ($user->businessClaimRequest)
        <div class="p-5 mt-10">
            <div class="container text-center  mx-auto max-w-lg p-20 bg-white shadow-lg rounded-md mt-28">

                <p>You have already submitted a claim request, so you do not have permission to create an account at
                    this time.</p>
            </div>
        </div>
    @else
  
        <div class="p-5 mt-10">

            <div class="container text-center mx-auto max-w-lg p-10 bg-blue-500 bg-opacity-25 shadow-lg rounded-md mt-24">

                <p>Sign up for a business account on theHotmoon, provide your details, and upon verification, gain access to your dashboard to manage and reply to user reviews on your business profile.
                </p>
            </div>

            <!-- Step 1: Personal Information -->
            @if ($currentStep == 1)
                <div class="container  mx-auto max-w-lg p-20 bg-white shadow-lg rounded-md mt-0">
                    <h1 class="text-3xl font-semibold text-center mb-6">Step 1: Personal Information</h1>
                    <form wire:submit.prevent="firstStepSubmit">
                        <!-- First and Last Name Inputs (Grouped Together) -->
                        <div class="flex mb-4">
                            <div class="mr-2 w-1/2">
                                <label for="firstName" class="block text-sm font-medium text-gray-600">First Name</label>
                                <input wire:model.live="first_name" type="text" id="firstName"
                                    class="mt-1 p-3 w-full border rounded-md">
                                <x-input-error for="first_name" />
                            </div>
                            <div class="ml-2 w-1/2">
                                <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name</label>
                                <input wire:model.live="last_name" type="text" id="lastName"
                                    class="mt-1 p-3 w-full border rounded-md">
                                <x-input-error for="last_name" />
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="mr-2 w-1/2">
                                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                                <input type="text" wire:model.live="username" id="username"
                                    class="mt-1 p-3 w-full border rounded-md">
                                <x-input-error for="username" />
                            </div>
                            <div class="ml-2 w-1/2">
                                <div wire:ignore>
                                    <label for="phoneNumber" class="block text-sm font-medium text-gray-600">Phone
                                        Number</label>
                                    <input type="tel" wire:model="phone_number" id="phoneNumber"
                                        class="mt-1 p-3 !w-full border rounded-md">
                                </div>
                                <x-input-error for="phone_number" />
                                <p id="valid-msg" class="hidden text-sm text-green-600">Valid</p>
                                <p id="error-msg" class="hidden text-sm text-red-600">Invalid number</p>
                                <input type="hidden" id="countryCode" wire:model="countryCode">

                            </div>



                        </div>

                        <div class="mt-9" x-data="{ show: @entangle('show') }">
                            <div class="mb-8">
                                <h4 class="text-lg">Tags (e.g Doctor, Health Specialist, Surgeon)<span
                                        style="color:#ff0000">*</span></h4>
                                        <p class="text-gray-600 opacity-50">Please enter a maximum of 3 tags. Press 'Enter' after each tag to insert it.</p>

                            </div>
                            <div class="mb-5 flex justify-start items-center flex-wrap gap-y-3">
                                @foreach ($userSelectedTags as $tag)
                                    <a class="text-[16px] cursor-pointer border border-[#D1D1D1] px-7 py-4 rounded-full mr-3">
                                        {{ $tag }}
                                        <i wire:click="removeTag('{{ $tag }}')" class="fa-solid fa-x text-[12px] ml-2"></i>
                                    </a>
                                @endforeach
                            
                                <div class="relative">
                                    <input id="tagInput" maxlength="20"
                                           type="text"
                                           wire:model.defer="tag"
                                            wire:keydown.enter="addTag"
                                            wire:keydown.escape="resetTag"
                                            wire:keydown.backspace="handleBackspace"
                                            wire:keydown.debounce.300ms="checkMatch"
                                           class="w-44 text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]"
                                           list="tagSuggestions"
                                           autofocus />
                            
                                    <datalist id="tagSuggestions">
                                        @foreach ($tagsSuggestion as $suggestion)
                                            <option value="{{ $suggestion }}">
                                        @endforeach
                                    </datalist>
                            
                                    <i title="add tag"
                                       wire:click="addTag()"
                                       class="hover:text-[#0c39ec] hover:text-[24px] text-[#2646C4] cursor-pointer fa-regular fa-plus text-[22px] mr-2"></i>
                                </div>
                            
                                @foreach ($userSelectedTags as $userTag)
                                    <input type="hidden" name="userSelectedTags[]" value="{{ $userTag }}" />
                                @endforeach
                            </div>
                            
                            <x-input-error for="tag" />
                            <x-input-error for="userSelectedTags" />

                        </div>
                       
                        <div class="flex justify-end">
                            <button id="firstStepButton" type="button" wire:click="nextStep"
                                style="background:rgb(54, 54, 230) "
                                class="bg-blue-600 text-white rounded-full py-3 px-6  hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                                Next
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Step 2: Business Information -->
            @if ($currentStep == 2)
                <div class="container mx-auto max-w-lg p-8 bg-white shadow-lg rounded-md mt-0">
                    <h1 class="text-3xl font-semibold text-center mb-6">Step 2: Business Information</h1>
                    <form wire:submit.prevent="secondStepSubmit">
                        <div class="flex mb-4">
                            <div class="mr-2 w-1/2">
                                <label for="country" class="block text-sm font-medium text-gray-600">Are you an
                                    individual
                                    or a
                                    business</label>
                                <select id="country" class="mt-1 p-3 w-full border rounded-md"
                                    wire:model.live="individual_or_business">
                                    <option value="individual">Individual</option>
                                    <option value="business">Business</option>
                                </select>
                                <x-input-error for="individual_or_business" />
                            </div>
                            <!-- Name Input -->
                            <div class="mr-2 w-1/2">
                                @if ($individual_or_business === 'individual')
                                    <label for="businessName" class="block text-sm font-medium text-gray-600">Individual
                                        Name</label>
                                @else
                                    <label for="businessName" class="block text-sm font-medium text-gray-600">Company
                                        Name</label>
                                @endif
                                <input type="text" wire:model.live="businessName" maxlength="100"
                                    id="businessName" class="mt-1 p-3 w-full border rounded-md">
                                <x-input-error for="businessName" />
                            </div>
                        </div>


                        <div class="mb-4">

                            <label for="websiteUrl" class="block text-sm font-medium text-gray-600">Website
                                Url</label>
                            <input type="text" wire:model.live="websiteUrl" id="websiteUrl"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="websiteUrl" />
                        </div>
                        <div class="mb-4">
                            <label for="businessImage" class="block text-sm font-medium text-gray-600">Add Business
                                logo</label>

                            <x-form.upload-files wire:model.live="businessImage" perview
                                allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                            <x-input-error for="businessImage" />
                        </div>
                      
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                            <textarea 
                                wire:model.lazy="description" 
                                id="description" 
                                rows="6" 
                                class="mt-1 p-3 w-full border rounded-md" 
                                wire:keydown.enter.prevent
                                wire:keydown.shift.enter="$set('description', $event.target.value + '\n')"
                                maxlength="2000" 
                                minlength="5">
                            </textarea>
                            <small class="text-xs text-gray-500">Min: 5, Max: 2000 characters.</small>
                            <x-input-error for="description" />
                        </div>
                        

                        <!-- Previous and Next Buttons -->
                        <div class="flex justify-between">
                            <button type="button" wire:click="prevStep" style="background:rgb(165, 167, 166) "
                                class="bg-gray-500 text-white rounded-full py-3 px-6 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                                Previous
                            </button>
                            <button type="button" wire:click="nextStep" style="background:rgb(54, 54, 230) "
                                class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                                Next
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Step 3: Additional Information -->
            @if ($currentStep == 3)
                <div class="container mx-auto max-w-lg p-8 bg-white shadow-lg rounded-md mt-0">
                    <h1 class="text-3xl font-semibold text-center mb-6">Step 3: Additional Information</h1>
                    <form wire:submit.prevent="register" >
                        <!-- Country Input -->
                        <div class="mb-4">
                            <div class="mr-2 w-1/2">
                            <label for="country" class="block text-sm font-medium text-gray-600">Country</label>
                            <select wire:model.live="country_id" id="country"
                                class="mt-1 p-3 w-full border rounded-md">
                                <option value="">Select country</option>
                                @foreach (App\Models\Country::select('id', 'name')->get() as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <x-input-error for="country_id" />
                        </div>

                        <div class="flex mb-6">
                            <div class="mr-2 w-1/2">
                                <label for="categoryId"
                                    class="block text-sm font-medium text-gray-600">Category</label>
                                <select id="categoryId" wire:model.live="category_id"
                                    class="mt-1 p-3 w-full border rounded-md">
                                    <option value="">Select category</option>
                                    @foreach (App\Models\Category::select('id', 'title')->whereNull('parent_id')->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="category_id" />
                            </div>
                            @if (count($subCategories) > 0)
                                <div class="ml-2 w-1/2">
                                    <label for="subCategoryId" class="block text-sm font-medium text-gray-600">Sub
                                        Category</label>
                                    <select id="subCategoryId" wire:model.live="sub_category_id"
                                        class="mt-1 p-3 w-full border rounded-md">
                                        <option value="">Select category</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="sub_category_id" />
                                </div>
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mr-2 w-1/2">
                            <label for="verification_option" class="block text-sm font-medium text-gray-600">Business
                                Verification</label>
                            <select wire:model="verification_option" wire:change="handleVerificationOptionChange"
                                id="verification_option" class="mt-1 p-3 w-full border rounded-md">
                                <option value="">Select verification option</option>
                                @foreach (App\Models\VerificationMethod::all() as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <x-input-error for="verification_option" />
                        </div>

                        @if ($default_response)
                            <div class="mb-4 text-green-50 bg-blue-300 p-2">
                                <p>{!! $default_response !!}</p>
                            </div>
                        @endif <!-- Previous and Submit Buttons -->
                        <div class="flex justify-between">

                            <button type="button" wire:click="prevStep" style="background:rgb(165, 167, 166) "
                                class="bg-gray-500 text-white rounded-full py-3 px-6 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                                Previous
                            </button>
                            <button wire:click="register" type="submit" style="background: rgb(16, 139, 26)"
                                class="bg-green-500 text-white rounded-full py-3 px-6 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                                wire:loading.attr="disabled">
                                <span wire:loading wire:target="register">
                                    <!-- Replace this with your spinner icon or HTML -->
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                                <span wire:loading.remove>
                                    Submit
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    @endif


</div>

<script>
    var telInput = $("#phoneNumber"),
        errorMsg = $("#error-msg"),
        validMsg = $("#valid-msg");

    // initialise plugin
    telInput.intlTelInput({

        allowExtensions: true,
        formatOnDisplay: true,
        autoFormat: true,
        autoHideDialCode: true,
        autoPlaceholder: true,
        defaultCountry: "auto",
        ipinfoToken: "yolo",

        nationalMode: false,
        numberType: "MOBILE",
        preferredCountries: ['sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
        preventInvalidNumbers: true,
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });

    var reset = function() {
        telInput.removeClass("error");
        errorMsg.addClass("hidden");
        validMsg.addClass("hidden");
    };

    // on blur: validate
    telInput.blur(function() {

        reset();
        if ($.trim(telInput.val())) {
            // alert(telInput.val())
            if (telInput.intlTelInput("isValidNumber")) {
                var countryCode = telInput.intlTelInput("getSelectedCountryData").dialCode;
                var phoneNumber = telInput.intlTelInput("getNumber");
                $('#firstStepButton').prop('disabled', false);
                Livewire.dispatch('phoneNumberUpdated', {
                    countryCode: countryCode,
                    phoneNumber: phoneNumber
                });
                validMsg.removeClass("hidden");

            } else {
                telInput.addClass("error");
                errorMsg.removeClass("hidden");
                $('#firstStepButton').prop('disabled', true);

            }
        }
    });

    telInput.on("keyup change", function() {
        reset();
    });

    document.addEventListener('livewire:init', () => {

        Livewire.on('prevStepCalled', function(values) {

            var telInput = $("#phoneNumber"),
                errorMsg = $("#error-msg"),
                validMsg = $("#valid-msg");

            // initialise plugin
            telInput.intlTelInput({

                allowExtensions: true,
                formatOnDisplay: true,
                autoFormat: true,
                autoHideDialCode: true,
                autoPlaceholder: true,
                defaultCountry: "auto",
                ipinfoToken: "yolo",

                nationalMode: false,
                numberType: "MOBILE",
                preferredCountries: ['sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
                preventInvalidNumbers: true,
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    $.get("http://ipinfo.io", function() {}, "jsonp").always(function(
                    resp) {
                        var countryCode = (resp && resp.country) ? resp.country :
                        "";
                        callback(countryCode);
                    });
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
            });

            var reset = function() {
                telInput.removeClass("error");
                errorMsg.addClass("hidden");
                validMsg.addClass("hidden");
            };

            // on blur: validate
            telInput.blur(function() {

                reset();
                if ($.trim(telInput.val())) {
                    if (telInput.intlTelInput("isValidNumber")) {
                        var countryCode = telInput.intlTelInput("getSelectedCountryData")
                            .dialCode;
                        var phoneNumber = telInput.intlTelInput("getNumber");
                        $('#firstStepButton').prop('disabled', false);
                        Livewire.dispatch('phoneNumberUpdated', {
                            countryCode: countryCode,
                            phoneNumber: phoneNumber
                        });
                        validMsg.removeClass("hidden");

                    } else {
                        telInput.addClass("error");
                        errorMsg.removeClass("hidden");
                        $('#firstStepButton').prop('disabled', true);

                    }
                }
            });

            telInput.on("keyup change", function() {
                reset();

            });
        });

    });
</script>