<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;

class TagSetting extends Component
{
    public $tags;
    #[Layout('layouts.app')]

    public function mount()
    {
        $tagsSetting = Setting::where('key', 'tags')->first();
        $this->tags = $tagsSetting ? $tagsSetting->value : '';

    }
    
    public function render()
    {
        return view('livewire.admin.settings.tag-setting');
    }

   
     public function saveSelectedTags()
     {
        $this->validate([
            'tags' => ['required', 'max:1000'],
        ]);
        $setting = Setting::firstOrNew(['key' => 'tags']);
        $setting->value = $this->tags;
        $setting->save();
         return redirect()->route('admin.tags')->with('success', 'Tags Saved successfully.');

     }

}
