<?php

namespace App\Rules;

use App\Models\Member;
use App\Services\MemberService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckMemberExistRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request('position_id')) {
            $member = request()->route('member');
            $exist = resolve(MemberService::class)->checkMemberExist($value, $member?->id);
            if ($exist) {
                $fail(__('validation.unique'));
            }
        }
    }
}
