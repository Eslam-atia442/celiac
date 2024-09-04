<?php

namespace App\Rules;

use App\Enums\UserTypeEnum;
use Closure;
use App\Services\UserService;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckAdminExistRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $admin = request()->route('admin');
        $exist = resolve(UserService::class)->checkUserExistByType($value, UserTypeEnum::admin?->value, $admin?->id);
        if ($exist) {
            $fail(__('validation.unique'));
        }
    }
}
