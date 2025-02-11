<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProcessorRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $rules = [
      'mac'                 => ['required', 'string', 'without_spaces', 'max:17', 'unique:processors'],
      'servicetag'          => ['required', 'string', 'without_spaces', 'max:255', 'unique:processors'],
      'user_id'             => ['required', 'exists:users,id'],
      'prototype_id'        => ['required', 'exists:prototypes,id'],
      // 'memories'            => ['nullable', 'array'],
      'memories'            => 'nullable|exists:memories,id|max:4',
      /* 'memories.*.id'       => ['required', 'exists:memories,id', 'distinct'],
      'memories.*.quantity' => ['required', 'integer', 'min:1'] */
    ];

    // Reglas adicionales para editar (omitir validación de unicidad en el ID actual)
    if ($this->isMethod('put') || $this->isMethod('patch')) {
      $processorId = $this->route('processor')->id ?? null;

      $rules['mac']        = "required|unique:processors,mac,{$processorId}";
      $rules['servicetag'] = "required|unique:processors,servicetag,{$processorId}";

      $rules['memories_to_delete'] = 'nullable|array';
      $rules['memories_to_delete.*'] = 'exists:memory_processor,memory_id';
    }

    return $rules;
  }

  public function messages()
  {
    return [
      'user_id.exists'               => 'El usuario seleccionado no es válido.',
      'prototype_id.exists'          => 'El prototipo seleccionado no es válido.',
      'memories.required'            => 'Debe seleccionar al menos una memoria.',
      'memories.*.id.required'       => 'Debe seleccionar una memoria válida.',
      'memories.*.quantity.required' => 'Debe especificar la cantidad de memorias.',
      'memories.*.quantity.integer'  => 'La cantidad debe ser un número entero.',
      'memories.*.quantity.min'      => 'La cantidad debe ser al menos 1.',
    ];
  }
}