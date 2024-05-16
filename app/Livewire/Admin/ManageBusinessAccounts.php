<?php

namespace App\Livewire\Admin;

use App\Enums\VerificationStatus;
use App\Models\BusinessAccount;
use App\Models\BusinessReview;
use App\Models\BusinessStat;
use App\Models\Category;
use App\Models\ReviewAttachment;
use App\Models\User;
use App\Models\VerificationMethod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Traits\CheckSpamTrait;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\SpamPharase;
use App\Models\VerificationRequest;
use Livewire\WithPagination;

class ManageBusinessAccounts extends Component
{
    use WithFileUploads, WithPagination, CheckSpamTrait;
    public $changeStatusModal = false;
    public $AddBusinessModal = false;

    public $confirmingDeletionModal = false;

    public $addFakeReviewModal = false;

    public $deleteId;
    public $statusChangeInfo = ['status' => 0, 'accountId' => 0];



    #[Validate]

    public $sortField = 'business_accounts.id';
    public $sortAsc = false;
    #[Validate]
    public $first_name;
    #[Validate]
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
    public $user_id;
    #[Validate]

    public $accountId;
    public $subCategories = [];
    public $parentCategories = [];
    public $users = [], $default_response;

    public $addNewBusiness = false;
    public $editCategoryModal = false;
    public $showViewModal = false;

    public $associatedUserId;

    public $individual_or_business = 'individual';

    public $reviewImages = [];

    public $oldReviewImages;
    public $is_approved;

    public $search;

    public $filterDate;

    public $usersWithoutReview;

    public $selectedUserId;

    public $review;
    public $rating = 0;
    public $interactionDetail, $interactionDate;


    #[Layout('layouts.app')]


    public function rules()
    {
        return [
            'associatedUserId' => ['required'],
            'first_name' => ['nullable', 'regex:/^[a-zA-z]*$/', 'nullable'],
            'last_name' => ['nullable', 'regex:/^[a-zA-z]*$/', 'nullable'],
            'username' => [
                'required',
                'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/',
                'string',
                'min:3',
                'max:17',
                Rule::unique('business_accounts', 'username')->ignore($this->accountId),
            ],
            'description' => ['required', 'min:5', 'max:2000'],
            'phone_number' => ['required', 'regex:/^\+(?:[0-9].?){6,14}[0-9]$/'],
            'specialization' => ['required', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'businessImage' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
            'individual_or_business' => ['required'],
            'businessName' => ['required', 'string', 'max:255', 'unique:business_accounts,businessName,' . $this->accountId],
            'websiteUrl' => [
                'required',
                'regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',
                'max:255',
                'unique:business_accounts,websiteUrl,' . $this->accountId,
            ],
            
            'verification_option' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'associatedUserId' => 'The user field is required',
            'username.regex' => 'Username must not contain spaces and characters at start and end',
            'phone_number.regex' => 'Phone number must not contain spaces and start with +',
            'individual_or_business.required' => 'Select one filed',
            'businessName.required' => 'Write name of the Business'
        ];
    }

    public function validationAttributes()
    {
        return [
            'category_id' => 'category',
            'sub_category_id' => 'sub_category',
            'country_id' => 'country',
        ];
    }

    public function render()
    {
        $query = BusinessAccount::query();

        if ($this->search) {
            $query->where(function ($subquery) {
                $subquery->where('businessName', 'like', '%' . $this->search . '%')
                    ->orWhere('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function ($categoryQuery) {
                        $categoryQuery->where('title', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('subcategory', function ($subcategoryQuery) {
                        $subcategoryQuery->where('title', 'like', '%' . $this->search . '%');
                    });

            });
        }

        // Apply date filters
        $query->when($this->filterDate == 1, function ($subquery) {
            $subquery->whereDate('created_at', Carbon::yesterday());
        })
            ->when($this->filterDate == 2, function ($subquery) {
                $subquery->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
            })
            ->when($this->filterDate == 3, function ($subquery) {
                $subquery->whereMonth('created_at', Carbon::now()->subMonth());
            })
            ->when($this->filterDate == 4, function ($subquery) {
                $subquery->whereYear('created_at', Carbon::now()->subYear());
            });

        // Apply sorting
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        $businessAccounts = $query->paginate(20);


        return view('livewire.admin.manage-business-accounts', compact('businessAccounts'));

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function render()
    // {
    //     $businessAccounts = BusinessAccount::latest()->paginate(20);
    //     $this->users = User::where('is_admin', 0)
    //     ->where('has_business_account', 0)
    //     ->get();
    //     return view('livewire.admin.manage-business-accounts', ['businessAccounts' => $businessAccounts]);
    // }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function filterDateBy($value)
    {

        $this->filterDate = $value;
    }


    public function filterBy($field)
    {
        $this->sortAsc = false;

        if (empty($field)) {
            $this->sortField = 'business_accounts.id';
        } else {
            $this->sortField = $field;
        }
    }

    public function confirmChangeStatus($id, $status)
    {
        $this->statusChangeInfo['status'] = !$status;
        $this->statusChangeInfo['accountId'] = $id;
        $this->changeStatusModal = true;
    }


    public function updateStatus()
    {
        $businessAccount = BusinessAccount::findOrFail($this->statusChangeInfo['accountId']);
        $businessAccount->is_approved = $this->statusChangeInfo['status'];
        $businessAccount->save();

        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Account status has been updated successfully!');
    }

    public function deleteAccount($id)
    {
        $this->deleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $businessAccount = BusinessAccount::findOrFail($this->deleteId);
            if ($businessAccount->user) {
                $businessAccount->user->update(['has_business_account' => false]);
                $businessAccount->delete();

                DB::commit();
                $this->reset('deleteId', 'confirmingDeletionModal');
                session()->flash('success', 'The account has been deleted successfully!');
            } else {
                session()->flash('error', 'Something went wrong, please try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong, please try again.');
            //throw $th;
        }
    }

    public function StoreOrUpdate()
    {

        $this->validate();
        DB::beginTransaction();
        try {

            if ($this->accountId) {

                $businessAccount = BusinessAccount::findOrFail($this->accountId);
                if ($businessAccount->user_id == $this->associatedUserId) {
                    $userId = $this->user_id;
                    $user = User::findOrFail($userId);
                    $user->has_business_account = true;
                    $user->save();
                } else {
                    $userId = $this->associatedUserId;
                    $user = User::findOrFail($userId);
                    $user->has_business_account = true;
                    $user->save();

                    $firstUser = User::findOrFail($businessAccount->user_id);
                    $firstUser->has_business_account = false;
                    $firstUser->save();
                }

                $businessAccount->update([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'username' => $this->username,
                    'description' => $this->description,
                    'phone_number' => $this->phone_number,
                    'specialization' => $this->specialization,
                    'country_id' => $this->country_id,
                    'category_id' => $this->category_id,
                    'sub_category_id' => $this->sub_category_id,
                    'user_id' => $this->associatedUserId,
                    'businessName' => $this->businessName,
                    'websiteUrl' => $this->websiteUrl,
                    'verification_option' => $this->verification_option,
                    'individual_or_business' => $this->individual_or_business

                ]);
            } else {
                $userId = $this->associatedUserId;

                $user = User::findOrFail($userId);
                $isHotBleep = $user->is_hot_bleep;
                $isApproved = $isHotBleep ? 1 : 0;
                $isVerified = $isHotBleep ? 1 : 0;

                $user->has_business_account = false;
                $user->save();

                $businessImage = $this->businessImage;
                $businessImagePath = $businessImage->storeAs('profile-photos', Carbon::now()->timestamp . "-" . $businessImage->getClientOriginalName(), 'public');
                $businessAccount = BusinessAccount::create([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'username' => $this->username,
                    'description' => $this->description,
                    'phone_number' => $this->phone_number,
                    'specialization' => $this->specialization,
                    'country_id' => $this->country_id,
                    'category_id' => $this->category_id,
                    'sub_category_id' => $this->sub_category_id,
                    'user_id' => $userId,
                    'business_image' => $businessImagePath,
                    'businessName' => $this->businessName,
                    'websiteUrl' => $this->websiteUrl,
                    'is_approved' => $isApproved,
                    'is_verified' => $isVerified,
                    'verification_option' => $this->verification_option,
                    'individual_or_business' => $this->individual_or_business
                ]);
                
                if ($isHotBleep) {
                    $verificationRequest = VerificationRequest::create([
                        'user_id' => $businessAccount->user_id,
                        'status' => VerificationStatus::Verified->value,
                    ]);
                }
            }

            DB::commit();

            $this->reset('associatedUserId', 'addNewBusiness');
            return redirect()->back()->with('success', 'Action performed successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function editAccount($id)
    {
        $businessAccount = BusinessAccount::findOrFail($id);
        $this->accountId = $businessAccount->id;
        $this->first_name = $businessAccount->first_name;
        $this->last_name = $businessAccount->last_name;
        $this->username = $businessAccount->username;
        $this->description = $businessAccount->description;
        $this->phone_number = $businessAccount->phone_number;
        $this->specialization = $businessAccount->specialization;
        $this->country_id = $businessAccount->country_id;
        $this->category_id = $businessAccount->category_id;
        $this->updatedCategoryId($this->category_id);
        $this->dispatch('updateCkEditorBodyBusiness');
        $this->dispatch('initEditor');

        $this->sub_category_id = $businessAccount->sub_category_id;
        $this->businessName = $businessAccount->businessName;
        $this->individual_or_business = $businessAccount->individual_or_business;
        $this->websiteUrl = $businessAccount->websiteUrl;
        $this->verification_option = $businessAccount->verification_option;
        $this->user_id = $businessAccount->user_id;
        $this->businessImage = $businessAccount->business_image;
        $associatedUser = User::find($businessAccount->user_id);
        $this->associatedUserId = $businessAccount->user_id;
        $this->users = User::where('is_admin', 0)
            ->where(function ($query) {
                $query->where('is_hot_bleep', 1)
                    ->where('has_business_account', '>=', 0);
            })
            ->orWhere('has_business_account', 0)
            ->get();
        $this->users->push($associatedUser);

        if ($this->verification_option) {
            $this->verification_option;
            $VerificationMethod = VerificationMethod::findOrFail($this->verification_option);
            $this->default_response = $VerificationMethod->default_response;
        } else {
            $this->default_response = '';
        }

        $this->addNewBusiness = true;
    }

    public function addFakeReview($id)
    {

        $businessAccount = BusinessAccount::findOrFail($id);
        $this->accountId = $businessAccount->id;
        $reviewedUserIds = $businessAccount->reviews()->pluck('user_id');
        $this->usersWithoutReview = User::whereNotIn('id', $reviewedUserIds)->where('is_fake',1)->get();

        $this->resetErrorBag();
        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');
        $this->addFakeReviewModal = true;
    }


    public function StoreFakeReview()
    {

        $this->validate([
            'review' => 'required|min:50|max:1000',
            'rating' => 'required|numeric|min:0.5|max:5',
            'selectedUserId' => 'required',
            'interactionDetail' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 10) {
                        $fail("The $attribute must not contain more than 10 words.");
                    }
                }
            ],
            'interactionDate' => 'required|date|before_or_equal:today',
            'reviewImages' => [
                function ($attribute, $value, $fail) {
                    if ($value) {
                        if (count($value) > 5) {
                            $fail("The $attribute must not contain more than 5 images.");
                        }
        
                        foreach ($value as $image) {
                            if (!$image->isValid()) {
                                $fail("One of the $attribute is not a valid image.");
                            }
                        }
                    }
                }
            ]
        ]);

        $spamPharasesModel = $this->getSpamModel();
        if ($spamPharasesModel) {
            $spamPharases = explode(',', $spamPharasesModel->spam_pharases);

            $spamWords = $this->checkSpam($this->review, $spamPharases);
            if (!empty($spamWords)) {
                $this->addError('spam_error', "Your text contains a forbidden phrase: {" . $spamWords . "} remove them to add your review");
            }
        }

        if ($this->getErrorBag()->isEmpty()) {
            $data = [
                'user_id' => $this->selectedUserId,
                'review' => $this->review,
                'rating' => $this->rating,
                'interaction_detail' => $this->interactionDetail,
                'interaction_date' => $this->interactionDate,
                'is_approved' => 1,
                'business_account_id ' => $this->accountId
            ];


            $newReview = $this->getBusinessAccount()->reviews()->create($data);
            $reviewId = $newReview->id;  
               // review images
               if ($this->reviewImages) {
                foreach ($this->reviewImages as $image) {
                    $fileExtension = $image->getClientOriginalExtension() ?? '';
                    $fileName = Carbon::now()->timestamp . "-" . $image->getClientOriginalName();
                    $path = $image->storeAs('review-images', $fileName, 'public');
                    ReviewAttachment::create([
                        'business_review_id' => $reviewId,
                        'file_path' => $path,
                        'file_type' => $fileExtension
                    ]);
                }
            }


            $businessStat = BusinessStat::firstOrNew(['business_account_id' => $this->accountId]);


            $reviews = $this->getBusinessAccount()->reviews;
            $reviewsCount = $reviews->where('is_approved', 1)->where('disputed', 0)->count();
            $avgRating = $reviews->where('is_approved', 1)->where('disputed', 0)->avg('rating');
            $positiveReviewsCount = $reviews->where('rating', '>=', 3)->count();
            $negativeReviewsCount = $reviewsCount - $positiveReviewsCount;

            // Save business stats
            $businessStat = BusinessStat::firstOrNew(['business_account_id' => $this->accountId]);
            $businessStat->reviews_count = $reviewsCount;
            $businessStat->avg_rating = $avgRating;
            $businessStat->positive_reviews_count = $positiveReviewsCount;
            $businessStat->negative_reviews_count = $negativeReviewsCount;

            $businessStat->save();

            $this->reset(['review', 'rating']);
            $this->addFakeReviewModal = false;

            return redirect()->back()->with('success', 'Action performed Successfully.');
        }
    }

    protected function getSpamModel()
    {
        return SpamPharase::find(1);
    }

    protected function getBusinessAccount()
    {
        return BusinessAccount::findOrFail($this->accountId);
    }
    public function viewAccount($id)
    {
        $businessAccount = BusinessAccount::findOrFail($id);
        $this->accountId = $businessAccount->id;
        $this->first_name = $businessAccount->first_name;
        $this->last_name = $businessAccount->last_name;
        $this->username = $businessAccount->username;
        $this->description = $businessAccount->description;
        $this->phone_number = $businessAccount->phone_number;
        $this->specialization = $businessAccount->specialization;
        $this->country_id = $businessAccount->country_id;
        $this->category_id = $businessAccount->category_id;
        $this->updatedCategoryId($this->category_id);

        $this->sub_category_id = $businessAccount->sub_category_id;
        $this->businessName = $businessAccount->businessName;
        $this->websiteUrl = $businessAccount->websiteUrl;
        $this->verification_option = $businessAccount->verification_option;
        $this->user_id = $businessAccount->user_id;
        $this->businessImage = $businessAccount->business_image;
        $this->is_approved = $businessAccount->is_approved;

        $associatedUser = User::find($businessAccount->user_id);
        $this->users = collect(User::where('is_admin', 0)->where('has_business_account', 0)->get());
        if ($associatedUser) {
            $this->users->push($associatedUser);
        } else {
            $this->users = User::where('is_admin', 0)->where('has_business_account', 0)->get();
        }

        if ($this->verification_option) {
            $this->verification_option;
            $VerificationMethod = VerificationMethod::findOrFail($this->verification_option);
            $this->default_response = $VerificationMethod->default_response;
        } else {
            $this->default_response = '';
        }

        $this->showViewModal = true;
    }

    public function updatedCategoryId($id)
    {
        $this->reset('sub_category_id', 'subCategories');
        $this->subCategories = Category::where('parent_id', $id)->get();
    }


    public function showModal($modal)
    {
        if ($modal == "addNewBusiness")
            $this->clearForm();
        $this->dispatch('updateCkEditorBodyBusiness');
        $this->dispatch('initEditor');
        $this->users = collect(User::where('is_admin', 0)->where('has_business_account', 0)->orWhere('is_hot_bleep', 1)->get());
        $this->accountId = null;

        $this->$modal = true;
    }

    public function clearForm()
    {

        $this->reset(
            'first_name',
            'last_name',
            'username',
            'description',
            'phone_number',
            'specialization',
            'businessImage',
            'businessName',
            'verification_option',
            'websiteUrl',
            'country_id',
            'user_id',
            'category_id',
            'sub_category_id',
            'subCategories',
            'associatedUserId'
        );

        $this->resetErrorBag();
        $this->resetValidation();
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
}
