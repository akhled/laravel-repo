<?php

namespace Akhaled\LaravelRepo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Auth\Authenticatable;

abstract class BaseRequest extends FormRequest
{
    protected $authorizedGuard = 'web';
    protected $action = null;
    protected $model = null;

    public function authorize()
    {
        $user = auth($this->authorizedGuard)->user();

        if (!$user instanceof Authenticatable) {
            return false;
        }

        if ($this->action && $this->model) {
            return $user->can($this->action, $this->model);
        }

        return true;
    }

    public function inputs()
    {
        return $this->only(array_keys($this->rules() ?? []));
    }
}