<?php

namespace App\Http\Validators\Main\Account\Profile;

use Illuminate\Support\Facades\Validator;

class BudgetValidator
{
    /**
     * Validate budget form
     *
     * @param object $request
     * @return void
     */
    public static function validate($request)
    {
        try {
            // Set rules for budget_min and budget_max
            $rules = [
                'budget_min' => 'nullable|numeric|min:0',
                'budget_max' => 'nullable|numeric|min:0',
            ];

            // Set error messages
            $messages = [
                'budget_min.numeric' => __('messages.t_validator_numeric'),
                'budget_max.numeric' => __('messages.t_validator_numeric'),
                'budget_min.min' => __('messages.t_validator_min', ['min' => 0]),
                'budget_max.min' => __('messages.t_validator_min', ['min' => 0]),
            ];

            // Set data to validate
            $data = [
                'budget_min' => $request->budget_min,
                'budget_max' => $request->budget_max,
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
