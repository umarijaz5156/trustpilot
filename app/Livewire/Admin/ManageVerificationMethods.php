<?php

namespace App\Livewire\Admin;

use App\Models\BusinessAccount;
use App\Models\Category;
use App\Models\User;
use App\Models\VerificationMethod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;


class ManageVerificationMethods extends Component
{
    use WithPagination;

    public $changeStatusModal = false;
    public $AddBusinessModal = false;

    public $confirmingDeletionModal = false;
    public $deleteId;
    public $statusChangeInfo = ['status' => 0, 'accountId' => 0];


    use WithFileUploads;

    #[Validate]
    public $name;
    #[Validate]
    public $field_text;
    #[Validate]

    public $response_type;
    public $allowOrNot;
   
    public $default_response;
    #[Validate]
  

    public $accountId;
   
    public $addVerificationMethod = false;
    public $showVerificationMethod = false;
 
    public $search;
    public $filterDate;
    public $sortField;
    public $sortAsc = true;


    #[Layout('layouts.app')]


    public function rules()
    {
        // Get the ID of the record being edited, if available
        $verificationMethodId = $this->accountId ?? null;
    
        return [
            'name' => [
                'required',
                'max:100',
                Rule::unique('verification_methods', 'name')->ignore($verificationMethodId),
            ],
            'field_text' => ['required', 'max:255'],
            'default_response' => ['required', 'min:5', 'max:900'],
            'response_type' => ['required'],
        ];
    }
    

    public function messages()
    {
        return [
            'field_text.required' => 'Text must be 255 characters or less',
            'field_text.max' => "The response should not exceed 255 characters",
            'default_response.required' => "Explain is required",
            'default_response.min' => "The response should have at least 5 characters",
            'default_response.max' => "The response should not exceed 900 characters",
            'response_type.required' => "Response type is required",
        ];
    }
 
    public function render()
    {
        $query = VerificationMethod::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
      
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        $verificationMethods = $query->paginate(20);

        return view('livewire.admin.manage-verification-methods', compact('verificationMethods'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function handleSearchChange(){

        $this->search;
    }
    public function deleteAccount($id)
    {
        $this->deleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function viewMethod($id){
        $VerificationMethod = VerificationMethod::findOrFail($id);
        $this->accountId = $VerificationMethod->id;
        $this->name = $VerificationMethod->name;
        $this->field_text = $VerificationMethod->field_text;
        $this->default_response = $VerificationMethod->default_response;
        $this->response_type = $VerificationMethod->response_type;
        $this->showVerificationMethod = true;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $businessAccount = VerificationMethod::findOrFail($this->deleteId);
            if ($businessAccount) {
                $businessAccount->delete();
                DB::commit();
                $this->reset('deleteId', 'confirmingDeletionModal');
                session()->flash('success', 'The Method has been deleted successfully!');
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


            if($this->accountId){

                $VerificationMethod = VerificationMethod::findOrFail($this->accountId);
               

                $VerificationMethod->update([
                    'name' => $this->name,
                    'field_text' => $this->field_text,
                    'default_response' => $this->default_response,
                    'response_type' => $this->response_type,
                ]);

            }else{
               

            $businessAccount = VerificationMethod::create([
                'name' => $this->name,
                'field_text' => $this->field_text,
                'default_response' => $this->default_response,
                'response_type' => $this->response_type,
            ]);

            }

            DB::commit();
            $this->addVerificationMethod = false;
            return redirect()->back()->with('success', 'Action performed successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function editAccount($id){
        $this->clearForm();
        $VerificationMethod = VerificationMethod::findOrFail($id);
        $this->accountId = $VerificationMethod->id;
        $this->name = $VerificationMethod->name;
        $this->field_text = $VerificationMethod->field_text;
        $this->default_response = $VerificationMethod->default_response;
        $this->response_type = $VerificationMethod->response_type;
        $this->dispatch('updateCkEditorBody');

        $this->addVerificationMethod = true;

    }


    
    public function showModal($modal)
    {
        if ($modal == "addVerificationMethod")
            $this->clearForm();
            $this->dispatch('updateCkEditorBody');

        $this->$modal = true;
    }

    public function clearForm()
    {

        $this->accountId = null;
        $this->name = '';
        $this->field_text = '';
        $this->default_response = '';
        $this->response_type = '';
        
        $this->showVerificationMethod = false;
        $this->addVerificationMethod = false;

        $this->resetErrorBag();
        $this->resetValidation();
    }
}
