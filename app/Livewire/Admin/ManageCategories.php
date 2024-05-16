<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class ManageCategories extends Component
{
    use WithFileUploads, WithPagination;

    public $title;
    public $parent_id;
    public $description;
    public $child_categories;
    public $catId;
    public $cover_photo;
    public $category_icon;

    public $showHideLevel2;
    public $showHideLevel3;
    public $updateCatId;
    public $addNewCategory = false;
    public $editCategoryModal = false;
    public $confirmingDeletionModal = false;


    protected function rules()
    {
        return [
            'title' => 'required|string|min:2|max:255|unique:categories,title,' . $this->updateCatId,
            'parent_id' => 'numeric|nullable',
            'description' => ['required', 'string', 'max:1000'],
            'cover_photo' => ['required', 'image'], //, 'dimensions:min_width=970,min_height=250,max_width=970,max_height=250'
            'category_icon' => ['required', 'image']
        ];
    }

    // Close Modal
    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    // Show Modal
    public function showModal($modal)
    {
        if ($modal == "addNewCategory")
            $this->clearForm();
        $this->$modal = true;
    }

    //////////////////// DropDown Menu Show Sub Categories
    public function getSubCategories($parentCategory)
    {
        $this->child_categories = Category::where('parent_id', '=', $parentCategory)->get();
    }

    public function createCategory()
    {
        $this->validate();


        $this->parent_id = $this->parent_id > 0 ? $this->parent_id : NULL;

        $categoryData = [
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ];

        $coverPhoto = $this->cover_photo;
        $icon = $this->category_icon;

        if (isset($coverPhoto)) {
            $categoryData['banner_path'] = $coverPhoto->storeAs('categories', Carbon::now()->timestamp . "-" . $coverPhoto->getClientOriginalName(), 'public');
        }

        if (isset($icon)) {
           // Store the original image
            $iconPath = $icon->storeAs('categories', Carbon::now()->timestamp . "-" . $icon->getClientOriginalName(), 'public');

            // Resize the image to 32x32 pixels
            // $resizedPath = 'categories/' . 'resized-' . Carbon::now()->timestamp . "-" . $icon->getClientOriginalName();
            // $resizedImage = Image::make(storage_path('app/public/' . $originalPath))->resize(32, 32)->save(storage_path('app/public/' . $resizedPath));

            $categoryData['icon_path'] = $iconPath;
        }

        Category::create($categoryData);

        $message = $this->parent_id > 0 ? "Sub Category successfully added" : "Category successfully added";

        // session()->flash('success', $message);
        $this->clearForm(); // reset form in modal
        $this->addNewCategory = false;


        session()->flash('success', $message);
    }

    //////////////////// Clear Form Data
    public function clearForm()
    {

        $this->reset('title', 'parent_id', 'cover_photo', 'category_icon', 'updateCatId', 'description');

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function deleteCategory($id)
    {
        $this->catId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete(Category $category)
    {
        if ($category = Category::find($this->catId)) {
            if($category->icon_path) {
                Storage::disk('public')->delete($category->icon_path);
            }

            if($category->banner_path) {
                Storage::disk('public')->delete($category->banner_path);
            }

            $category->delete();
            session()->flash('success', 'Category successfully deleted.');
        }
        $this->catId = '';
        $this->confirmingDeletionModal = false;
    }

    // show edit details
    public function editCategory($id)
    {
        $this->clearForm();
        $showCatDetail = Category::where('id', $id)->first();
        $this->updateCatId = $id;
        $this->title = $showCatDetail->title;
        $this->parent_id = $showCatDetail->parent_id;
        $this->description = $showCatDetail->description;

        $this->editCategoryModal = true;
    }

    // update category
    public function updateCategory()
    {
        $this->validate([
            'title' => 'required|string|min:2|max:255|unique:categories,title,' . $this->updateCatId,
            'parent_id' => 'nullable',
            'description' => ['required', 'string', 'max:1000'],
            'cover_photo' => ['nullable', 'image'], //, 'dimensions:min_width=970,min_height=250,max_width=970,max_height=250'
            'category_icon' => ['nullable', 'image']
        ]);

        $category = Category::findorFail($this->updateCatId);

        $categoryData = [
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => !empty($this->parent_id) ? $this->parent_id : null
        ];

        $coverPhoto = $this->cover_photo;
        $icon = $this->category_icon;

        if (isset($this->cover_photo) && !empty($this->cover_photo)) {
            $categoryData['banner_path'] = $coverPhoto->storeAs('categories', Carbon::now()->timestamp . "-" . $coverPhoto->getClientOriginalName(), 'public');

            if ($categoryData['banner_path']) {
                Storage::disk('public')->delete(Category::where('id', $category->id)->first()->banner_path);
            }
        }

        if (isset($this->category_icon) && !empty($this->category_icon)) {
            $categoryData['icon_path'] = $icon->storeAs('categories', Carbon::now()->timestamp . "-" . $icon->getClientOriginalName(), 'public');
            
            if ($categoryData['icon_path']) {
                Storage::disk('public')->delete(Category::where('id', $category->id)->first()->icon_path);
            }
        }

        $category->update($categoryData);

        $this->editCategoryModal = false;
        session()->flash('success', 'Category updated successfully.');
    }

    // show hide child accordion
    public function collapseSubChild($id, $parent1 = -1)
    {
        if ($id == $parent1) {
            $this->showHideLevel2 = NULL;
            $this->showHideLevel3 = NULL;
        } else {
            $this->showHideLevel2 = $id;
        }
    }

    // show hide subchild accordion
    public function collapseChildOfSubChild($id, $parent2 = -1)
    {
        if ($id == $parent2) {
            $this->showHideLevel3 = NULL;
        } else {
            $this->showHideLevel3 = $id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $categories = Category::with(['childCategories' => function ($query) {
            $query->with('childCategories');
        }])->whereNull('parent_id')->paginate(20);
        
        return view('livewire.admin.manage-categories', ['categories' => $categories]);
    }
}
