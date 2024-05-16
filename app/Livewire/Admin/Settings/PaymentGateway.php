<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;

class PaymentGateway extends Component
{
    public $stripe_key, $stripe_secret;

    public function mount()
    {
        $this->stripe_key = env('STRIPE_KEY');
    }

    public function updatePaymentGateway()
    {
        $stripeKeys = [
            'STRIPE_KEY' => $this->stripe_key !== null ? $this->stripe_key : '',
            'STRIPE_SECRET' => $this->stripe_secret !== null ? $this->stripe_secret : env('STRIPE_SECRET'),
        ];

        $this->setEnvironmentValue($stripeKeys);
        // session()->flash('success', __('Setting updated successfully'));

        return redirect()->route('admin.settings')->with('success', 'Setting updated successfully.');
        // return redirect()->route('admin.settings')->with('success', __('Setting updated successfully'));
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}='{$envValue}'\r\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if (!file_put_contents($envFile, $str)) {
            return false;
        }
        return true;
    }

    public function render()
    {
        return view('livewire.admin.settings.payment-gateway');
    }
}
