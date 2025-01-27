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
      'mac'                 => ['required', 'string', 'max:255', 'unique:processors'],
      'servicetag'          => ['required', 'string', 'max:255', 'unique:processors'],
      'user_id'             => ['required', 'exists:users,id'],
      'prototype_id'        => ['required', 'exists:prototypes,id'],
      'memories'            => ['nullable', 'array'],
      'memories.*.id'       => ['required', 'exists:memories,id', 'distinct'],
      'memories.*.quantity' => ['required', 'integer', 'min:1'],
    ];

    // Reglas adicionales para editar (omitir validación de unicidad en el ID actual)
    if ($this->isMethod('put') || $this->isMethod('patch')) {
      $processorId = $this->route('processor')->id ?? null;

      $rules['mac']        = "required|unique:processors,mac,{$processorId}";
      $rules['servicetag'] = "required|unique:processors,servicetag,{$processorId}";
    }

    return $rules;
  }

  public function messages()
  {
    return [
      'mac.required'                 => 'El campo MAC es obligatorio.',
      'mac.unique'                   => 'El MAC ya está registrado.',
      'servicetag.required'          => 'El campo Service Tag es obligatorio.',
      'servicetag.unique'            => 'El Service Tag ya está registrado.',
      'user_id.required'             => 'El campo Usuario es obligatorio.',
      'user_id.exists'               => 'El usuario seleccionado no es válido.',
      'prototype_id.required'        => 'El campo Prototipo es obligatorio.',
      'prototype_id.exists'          => 'El prototipo seleccionado no es válido.',
      'memories.required'            => 'Debe seleccionar al menos una memoria.',
      'memories.*.id.required'       => 'Debe seleccionar una memoria válida.',
      'memories.*.quantity.required' => 'Debe especificar la cantidad.',
      'memories.*.quantity.integer'  => 'La cantidad debe ser un número entero.',
      'memories.*.quantity.min'      => 'La cantidad debe ser al menos 1.',
    ];
  }
}