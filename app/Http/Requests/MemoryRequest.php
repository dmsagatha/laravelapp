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
      // 'serial' => 'required|max:8|unique:memories',
      // 'serial' => 'required|max:8|unique:memories,serial',
      'serial' => ['required', 'min:8', 'max:8', Rule::unique('memories')],
    ];
  }
}