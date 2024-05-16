<?php

namespace App\Livewire\User;

use App\Jobs\SendMailJob;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use App\Models\VerificationMethod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class BusinessAccount extends Component
{
    use WithFileUploads;

    #[Validate]
    public $first_name;
    #[Validate]

    public $default_response;

    public $last_name;
    #[Validate]
    public $username;
    #[Validate]
    public $description;
    #[Validate]
    public $phone_number;
    #[Validate]
    public $specialization;
    #[Validate]
    public $businessImage;
    #[Validate]

    public $businessName;
    #[Validate]


    public $verification_option;
    #[Validate]
    public $websiteUrl;
    #[Validate]
    public $country_id;
    #[Validate]
    public $category_id;
    #[Validate]
    public $sub_category_id;
    #[Validate]
    public $subCategories = [];

    public $countryCode;

    public $individual_or_business = 'individual';
    public $currentStep = 1;
    public $tags;

    public $userSelectedTags = [];
    public $tag;
    public $loading = false;

    public $fullNumber;

    public $tagsSuggestion = [];

    public function rules()
    {
        return [
            'first_name' => ['nullable', 'regex:/^[a-zA-z]*$/', 'nullable'],
            'last_name' => ['nullable', 'regex:/^[a-zA-z]*$/', 'nullable'],
            'username' => ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17', 'unique:business_accounts,username'],
            'description' => ['required', 'min:5', 'max:2000'],
            'phone_number' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'businessImage' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
            'individual_or_business' => ['required'],
            'businessName' => ['required', 'string', 'max:255', 'unique:business_accounts,businessName'],
            'websiteUrl' => ['required', 'regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/', 'max:255', 'unique:business_accounts,websiteUrl'],
            'verification_option' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'username.regex' => 'Username must not contain spaces and characters at start and end',
            'phone_number.numeric' => 'Phone number must be numeric',
            'individual_or_business.required' => 'Please select one option',
            'businessName.required' => 'Please enter the name of the Business',
            'businessImage.required' => 'Please upload a business logo',
            'businessImage.image' => 'The logo must be an image',
            'businessImage.max' => 'The logo may not be greater than 2MB',
            'businessImage.mimes' => 'The logo must be a file of type: png, jpg, jpeg, webp',
            'websiteUrl.required' => 'Please enter the Business Website URL',
            'websiteUrl.regex' => 'Please enter a valid URL format',
            'verification_option.required' => 'Please select a verification option',
        ];
    }


    public function validationAttributes()
    {
        return [
            'category_id' => 'category',
            'sub_category_id' => 'sub_category',
            'country_id' => 'country'
        ];
    }

    public function updatedCategoryId($id)
    {
        $this->reset('sub_category_id', 'subCategories');
        $this->subCategories = Category::where('parent_id', $id)->get();
    }


    protected $listeners = ['phoneNumberUpdated'];

    public function phoneNumberUpdated($phoneNumber)
    {
        $this->fullNumber = $phoneNumber;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'first_name' => ['required', 'regex:/^[a-zA-z]*$/'],
            'last_name' => ['required', 'regex:/^[a-zA-z]*$/'],
            'username' => ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17', 'unique:business_accounts,username'],
            'phone_number' => ['required'],
            'userSelectedTags' => ['required', 'array', 'min:1', 'max:3'],
            'userSelectedTags.*' => ['required'],
        ], [], [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'phone_number' => 'Phone Number',
            'userSelectedTags' => 'Tags',
            'userSelectedTags.*' => 'Tag',
        ]);


    }


    public function secondStepSubmit()
    {

        $this->validate([
            'individual_or_business' => ['required'],
            'businessName' => ['required', 'string', 'max:100'],
            'websiteUrl' => [
                'required',
                'regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',
                'max:255',
                'unique:business_accounts,websiteUrl,',
            ],

            'description' => ['required', 'min:5', 'max:2000'],
            'businessImage' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
        ], [], [
            'individual_or_business' => 'Individual or Business',
            'businessName' => 'Business Name',
            'websiteUrl' => 'Website URL',
            'description' => 'Description',
            'businessImage' => 'Business Image',
        ]);

    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {

            $this->firstStepSubmit();
        } else if ($this->currentStep == 2) {
            $this->secondStepSubmit();
        }

        $this->currentStep++;
    }

    public function prevStep()
    {
        $this->currentStep--;
        $this->dispatch('prevStepCalled');

    }
    public function register()
    {
        $this->validate();
        $this->loading = true;

        DB::beginTransaction();
        try {

            $userId = auth()->user()->id;

            $user = User::findOrFail($userId);

            $user->has_business_account = true;
            $user->save();
            $commaSeparatedTags = implode(',', $this->userSelectedTags);

            $businessImage = $this->businessImage;
            $businessImagePath = $businessImage->storeAs('profile-photos', Carbon::now()->timestamp . "-" . $businessImage->getClientOriginalName(), 'public');

            $data = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'username' => $this->username,
                'description' => $this->description,
                'phone_number' => $this->fullNumber,
                // 'phone_number' => $this->phone_number,
                'specialization' => $commaSeparatedTags,
                'country_id' => $this->country_id,
                'category_id' => $this->category_id,
                'sub_category_id' => $this->sub_category_id,
                'user_id' => auth()->user()->id,
                'business_image' => $businessImagePath,
                'businessName' => $this->businessName,
                'websiteUrl' => $this->websiteUrl,
                'verification_option' => $this->verification_option,
                'is_verified' => 0,
                'individual_or_business' => $this->individual_or_business

            ];

            // dd($data);

            $businessAccount = \App\Models\BusinessAccount::create($data);

            DB::commit();
            $this->sendMailOnBusinessSubmitted($businessAccount);
            $this->loading = false;
            return redirect()->route('business-owner.dashboard')->with('success', 'Your business is submitted for verification.');
        } catch (\Throwable $th) {
            $this->loading = false;
            DB::rollBack();
            throw $th;
        }

    }

    public function sendMailOnBusinessSubmitted($businessAccount)
    {
        $user = $businessAccount->user;
        $adminMail = Setting::where('key', 'admin_email')->first()?->value;

        $heading = '<h1>New Business Submitted!</h1>';
        $subject = "New business submitted";


        foreach (['owner', 'admin'] as $key => $value) {
            if ($value == 'owner') {
                $body = '';
                $body .= "Thank you for submitting your business information. We have received your details,";

                $body .= "
                        <p style='padding-top: 10px;'>Your business submission details:</p>
                        <ul style='padding-left: 20px'>
                            <li><strong>Business  Name: </strong>
                                <a href='" . route('business-owner.details') . "'>" .
                    $businessAccount->businessName . "
                                </a>
                            </li>
                          <li><strong>Business Category: </strong><a href='" . route('categories.business', str_replace(' ', '-', $businessAccount->category->title)) . "'>" . $businessAccount->category->title . "</a></li>
                          <li><strong>Contact Email: </strong>" . $businessAccount->user->email . "</li>
                          <li><strong>Contact Phone: </strong>" . $businessAccount->phone_number . "</li>
                        </ul>
    
                        ";

                $body .= "
                    <p style='padding-top: 10px;'>Please note that our admin will send a verification request to the provided contact email. Kindly respond to the verification request promptly to complete the process and verify your business account.</p>
                    ";

                $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
                // send mail to user
                dispatch(new SendMailJob($data, $user->email));
            } else if ($value == 'admin') {
                $body = '';
                $body .= "A new business account has been submitted to the platform.,";

                $body .= "
                        <p style='padding-top: 10px;'>Business Details:</p>
                        <ul style='padding-left: 20px'>
                            <li><strong>Business  Name: </strong>
                                <a href='" . route('admin.view-business-account', ['business_name' => $businessAccount->businessName]) . "'>" .
                    $businessAccount->businessName . "
                                </a>
                            </li>
                          <li><strong>Business Category: </strong><a href='" . route('categories.business', str_replace(' ', '-', $businessAccount->category->title)) . "'>" . $businessAccount->category->title . "</a></li>
                          <li><strong>Contact Email: </strong>" . $businessAccount->user->email . "</li>
                          <li><strong>Contact Phone: </strong>" . $businessAccount->phone_number . "</li>
                        </ul>
    
                        ";

                $body .= "
                    <p style='padding-top: 10px;'>Please review the information provided and take necessary action. If additional details or verification is required, kindly contact the user promptly.</p>
                    ";

                $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];
                // send mail to admin
                dispatch(new SendMailJob($data, $adminMail));
            }
        }
    }

    public function handleVerificationOptionChange()
    {
        if ($this->verification_option) {
            $this->verification_option;
            $VerificationMethod = VerificationMethod::findOrFail($this->verification_option);
            $this->default_response = $VerificationMethod->default_response;
        } else {
            $this->default_response = '';
        }
    }

    public function addTag()
    {
        $this->resetErrorBag();
        if (count($this->userSelectedTags) > 2) {
            $this->addError('tag', 'Max 3 Tags allowed');
        } elseif (in_array($this->tag, $this->userSelectedTags)) {

            $this->addError('tag', 'Tags already exists');
        } elseif ($this->tag == '') {
            $this->addError('tag', 'Tags cannot be empty');
        } else {

            array_push($this->userSelectedTags, $this->tag);

            $this->tag = '';
        }
    }

    public function removeTag($tag)
    {
        $this->userSelectedTags = array_diff($this->userSelectedTags, [$tag]);

    }

    public function handleBackspace()
    {
        if (strlen($this->tag) > 0) {
            // Remove the last character from the tag string
            $this->tag = substr($this->tag, 0, -1);
        }
    }

    public function checkMatch()
    {
        if (strlen($this->tag) >= 3) {
            $matchingSuggestions = $this->getMatchingSuggestions($this->tag);

            if (count($matchingSuggestions) === 1) {
                $this->tag = $matchingSuggestions[0];
            }
        }
    }

    private function getMatchingSuggestions($input)
    {
        $input = strtolower($input);
        $matchingSuggestions = [];

        foreach ($this->tagsSuggestion as $suggestion) {
            if (str_starts_with(strtolower($suggestion), $input)) {
                $matchingSuggestions[] = $suggestion;
            }
        }

        return $matchingSuggestions;
    }


    //   search tags


    #[Layout('layouts.web')]
    public function render()
    {

        $user = Auth::user();

        if ($user->has_business_account == 1) {
            abort(404);
        }

        $tags = Setting::where('key', 'tags')->value('value');
        if ($tags) {
            // Split the comma-separated string into an array
            $this->tagsSuggestion = explode(',', $tags);
        } else {
            $this->tagsSuggestion = [];
        }
        return view('livewire.user.business-account', ['user' => $user]);
    }
}
