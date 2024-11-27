<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemoryRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  
  public function rules(): array
  {
    return [
      // 'serial' => ['required', 'min:8', 'max:8', Rule::unique('memories')->ignore($this->route('memory'))],
      'serial' => ['required', 'without_spaces', 'min:5', 'max:8', Rule::unique('memories')->ignore($this->memory)],
      'capacity'   => 'required|string',
      'technology' => 'required|string',
      'velocity'   => 'required|string',
    ];
  }
}