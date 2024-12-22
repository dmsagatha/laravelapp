<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
  public $type;
  public $message;

  public function __construct($type, $message)
  {
    $this->type    = $type;
    $this->message = $message;
  }

  public function backgroundCSS()
  {
    return [
      'success' => 'bg-success-500 text-slate-50 border-success-700',
      'info'    => 'bg-info-500 text-slate-50 border-info-700',
      'error'   => 'bg-error-500 text-slate-50 border-error-700',
      'warning' => 'bg-warning-500 text-slate-50 border-warning-700',
    ][$this->type];
  }

  public function render(): View|Closure|string
  {
    return view('components.alert');
  }
}