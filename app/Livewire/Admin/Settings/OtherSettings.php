<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class OtherSettings extends Component
{
    use WithPagination;

    public $adminEmail;
    public $edit_review_par_day;

    public function render()
    {
        $settings = Setting::whereIn('key', ['edit_review_par_day', 'admin_email'])
            ->pluck('value', 'key')
            ->all();

        $this->edit_review_par_day = $settings['edit_review_par_day'] ?? '';
        $this->adminEmail = $settings['admin_email'] ?? '';

        $hot_bleep_users = User::where('is_hot_bleep', 1)
            ->latest()
            ->paginate(10);
        return view('livewire.admin.settings.other-settings', ['hot_bleep_users' => $hot_bleep_users]);
    }

    public function saveAdminEmail()
    {
        $this->validate([
            'adminEmail' => 'required|email'
        ]);

        $settings = Setting::updateOrCreate(['key' => 'admin_email'], ['value' => $this->adminEmail]);
        // session()->flash('success', 'Admin email saved successfully.');
        return redirect()->route('admin.settings')->with('success', 'Admin email saved successfully.');
    }

    public function updateEditReview()
    {
        $this->validate([
            'edit_review_par_day' => 'required|integer|min:1|max:1000',
        ], [
            'edit_review_par_day.required' => 'User Edit review par day field is required',
            'edit_review_par_day.min' => 'User Edit review par day field should not be less than 1',
            'edit_review_par_day.max' => 'User Edit review par day field should not be greater than 1000',
            'edit_review_par_day.integer' => 'User Edit review par day field must be an integer value',
        ]);

        $setting = Setting::where('key', 'edit_review_par_day')->first();
        if ($setting) {
            $setting->value = $this->edit_review_par_day;
            $setting->save();
        } else {
            Setting::create([
                'key' => 'edit_review_par_day',
                'value' => $this->edit_review_par_day,
            ]);
        }

        $edit_review_par_day_setting = Setting::where('key', 'edit_review_par_day')->first();
        $this->edit_review_par_day = $edit_review_par_day_setting ? $edit_review_par_day_setting->value : '';

        // session()->flash('success', 'Review  edit settings updated successfully!');
        return redirect()->route('admin.settings')->with('success', 'Review edit settings updated successfully!');

    }

    public function makeHotBleepUser()
    {
        $checkHotBleepUser = User::where('is_hot_bleep', 1)->count();
        if ($checkHotBleepUser == 0) {
            
            $user = User::factory()->create([
                'is_hot_bleep' => 1,
                'has_business_account' => 0,
            ]);
            // session()->flash('success', 'User created successfully.');
        return redirect()->route('admin.settings')->with('success', 'User created successfully.');

        } else {
            // session()->flash('error', 'User already exists. Only one Hot Bleep user can exist at a time.');
        return redirect()->route('admin.settings')->with('error', 'User already exists. Only one theHotBleep user can exist at a time.');

        }
    }
}
