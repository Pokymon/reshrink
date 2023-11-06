<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Add 'http://' prefix if protocol is not specified
        $url = parse_url($value, PHP_URL_SCHEME) === null ? "http://$value" : $value;

        // Check if the URL is valid
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $fail('The '.$attribute.' is not a valid URL.');
        }
    }
}
