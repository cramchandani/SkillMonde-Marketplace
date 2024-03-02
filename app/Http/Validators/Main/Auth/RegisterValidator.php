<?php

namespace App\Http\Validators\Main\Auth;

use App\Rules\UsernameRule;
use Illuminate\Support\Facades\Validator;

class RegisterValidator
{
    
    /**
     * Validate form
     *
     * @param object $request
     * @return void
     */
    static function validate($request)
    {
        try {

            // Set rules
            $rules    = [
              //  'username' => ['required', 'max:60', 'min:3', 'unique:users', new UsernameRule(), 'regex:/^[a-zA-Z0-9_]+$/'],
                'email'    => 'required|max:60|email|unique:users',
                //'password' => 'required|max:60',
                'password' => ['nullable', 'max:60', 'min:6'],
                'fullname' => 'required|max:60|min:3|regex:/^[a-zA-Z0-9 ]+$/',
                'account_type' => ['required', 'in:seller,buyer'],
                'referrerUsername' => ['nullable', 'string', 'max:100'],

            ];

            // Set errors messages
            $messages = [
             //   'username.required' => __('messages.t_validator_required'),
             //   'username.max'      => __('messages.t_validator_max', ['max' => 60]),
             //   'username.min'      => __('messages.t_validator_min', ['min' => 3]),
             //   'username.unique'   => __('messages.t_validator_unique'),
                'email.required'    => __('messages.t_validator_required'),
                'email.max'         => __('messages.t_validator_max', ['max' => 60]),
                'email.email'       => __('messages.t_validator_email'),
                'email.unique'      => __('messages.t_validator_unique'),
                'password.required' => __('messages.t_validator_required'),
               // 'password.max'      => __('messages.t_validator_max', ['max' => 60]),
                'password.min' => __('messages.t_validator_min', ['min' => 6]),
                'password.max' => __('messages.t_validator_max', ['max' => 60]),
                'fullname.required' => __('messages.t_validator_required'),
                'fullname.max'      => __('messages.t_validator_max', ['max' => 60]),
                'fullname.min'      => __('messages.t_validator_min', ['min' => 3]),
                'fullname.regex'    => __('messages.t_validator_regex'),
                'account_type.required' => __('messages.t_validator_required'),
                'account_type.in' => __('messages.t_validator_account_type'),
            ];

            // Set data to validate
            $data     = [
                'email'    => $request->email,
              //  'username' => $request->username,
                'password' => $request->password,
                'fullname' => $request->fullname,
                'account_type' =>$request->account_type,
            ];

            // Validate data
            Validator::make($data, $rules, $messages)->validate();

            // Reset validation
            $request->resetValidation();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
