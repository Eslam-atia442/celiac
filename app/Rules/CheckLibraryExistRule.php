<?php

namespace App\Rules;

use App\Services\HealthLibraryService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckLibraryExistRule implements ValidationRule
{
    public $library;
    public function __construct($library=null)
    {
        $this->library = $library;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request('type')) {
            $exist = resolve(HealthLibraryService::class)->checkLibraryExist($value, $this->library?->id);
            if ($exist) {
                $fail(__('validation.unique'));
            }
        }
    }
}
