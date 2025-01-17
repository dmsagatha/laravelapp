<?php

namespace App\Http\Requests;

use App\Models\Memory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MemoryRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'serial'     => ['required', 'without_spaces', 'min:5', Rule::unique('memories')->ignore($this->memory)],
      'capacity'   => 'required|in:' . implode(',', array_keys(Memory::CAPACITY_SELECT)),
      'technology' => 'required|in:' . implode(',', array_keys(Memory::TECHNOLOGY_SELECT)),
      'velocity'   => [
        'required',
        function ($attribute, $value, $fail) {
          $technology      = $this->get('technology');
          $validVelocities = Memory::VELOCITY_SELECT[$technology] ?? [];

          if (!in_array($value, $validVelocities)) {
            $fail('La velocidad seleccionada no es válida para la tecnología especificada.');
          }
        },
      ],
      'initial_warranty' => 'required|date|before_or_equal:final_warranty',
      'final_warranty'   => 'required|date|after_or_equal:initial_warranty',
    ];
  }
}