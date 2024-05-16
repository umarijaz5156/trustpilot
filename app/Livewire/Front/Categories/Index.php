<?php

namespace App\Livewire\Front\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    public $pageTitle;

    public $searchCategories;
    public $search;

    #[Layout('layouts.web')]

    public function mount()
    {
        $specificPageTitle = 'Your Specific Page Title'; // Replace this with your actual dynamic page title
        $this->pageTitle = $specificPageTitle . ' - ' . config('app.name');
    }
    public function render()
    {
        $categories = Category::whereNull('parent_id')->get();

        if ($this->search) {
            $this->searchCategories = Category::where('title', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.front.categories.index', ['categories' => $categories]);
    }
}
