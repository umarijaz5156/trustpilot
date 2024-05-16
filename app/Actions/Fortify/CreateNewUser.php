<?php

namespace App\Actions\Fortify;

use App\Jobs\SendMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:common_database.users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) {
                    // Custom password validation logic
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('The '.$attribute.' must contain at least one numeric character.');
                    }

                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('The '.$attribute.' must contain at least one uppercase character.');
                    }

                    if (!preg_match('/[^A-Za-z0-9]/', $value)) {
                        $fail('The '.$attribute.' must contain at least one special character.');
                    }
                },
            ],
            // 'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        $newVerificationCode = mt_rand(100000, 999999);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'verify_code' => $newVerificationCode,
        ]);

        $subject = 'Your Verification Code';
        $heading = 'Verification Code';
        $body = "Your verification code is: <strong>$newVerificationCode</strong>. Use this code to verify your email address.";
        $data = ['body' => $body, 'subject' => $subject, 'heading' => $heading];

        dispatch(new SendMailJob($data, $input['email']));

        return $user;
    }
 
}
