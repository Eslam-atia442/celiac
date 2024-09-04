<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class StringInputRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!preg_match('/^[\p{Arabic}\sA-Za-z]+$/u', $value)) {
            $fail(__('validation.string_error_input_validation')   );
        }
    }
}
