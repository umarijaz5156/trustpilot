<?php

namespace App\Livewire\Admin\Settings;

use App\Models\BusinessAccount;
use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;


class FeatureBusiness extends Component
{
    #[Layout('layouts.app')]

    public $featureCompanies = [];
    public $selectedBusinesses = [];

    public function mount()
    {
        $this->featureCompanies = BusinessAccount::where('is_approved', true)
        ->orderBy('businessName', 'asc')
        ->get();

        $setting = Setting::where('key', 'feature_business')->first();
        if ($setting) {
            $this->selectedBusinesses = json_decode($setting->value);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.feature-business');
    }

    public function saveSelectedBusinesses(){
        $key = 'feature_business';
        $value = json_encode($this->selectedBusinesses);
    
        $setting = Setting::where('key', $key)->first();
    
        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            Setting::create(['key' => $key, 'value' => $value]);
        }
        return redirect()->route('admin.feature.business')->with('success', 'Action performed successfully.');

    }
 
    protected $listeners = ['updateSelectedBusinesses'];

    public function updateSelectedBusinesses($selectedBusinesses)
    {
        $this->selectedBusinesses = $selectedBusinesses;
    }


}
