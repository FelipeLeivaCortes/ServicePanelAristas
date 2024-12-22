<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AtLeastOne implements ValidationRule
{
    protected $otherField;
    
    public function __construct($otherField)
    {
        $this->otherField = $otherField;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $otherFieldValue = request($this->otherField);
        if (empty($value) && empty($otherFieldValue)) {
            $fail("Debe seleccionar al menos una sugerencia o actividad.");
        }
    }
}