<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class ManageUser extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]

    public $name;
    public $email;
    
    public $password;
    public $user_id = null;

    public $addNewUser = false;

    public $search;
    public $filterDate;
    public $sortField;
    public $sortAsc = true;
    public function editUser($id){

        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->user_id = $user->id;
        $this->addNewUser = true;
    }

    public function StoreOrUpdate(){
       
        $user = User::findOrFail($this->user_id);

                $this->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:common_database.users,email,'.$user->id,
                    'password' => 'required|string|min:8',
                ]);

                $user->name = $this->name;
                $user->email = $this->email;
                $user->password = Hash::make($this->password); 

                $user->save();
                $this->addNewUser = false;
                session()->flash('message','Action Performed Successfully');

    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
            $query->orWhere('email', 'like', '%' . $this->search . '%');
        }
      
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        $users = $query->paginate(10);

        return view('livewire.admin.manage-user',['users' => $users]);
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
}
