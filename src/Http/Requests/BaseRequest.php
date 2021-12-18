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
        $inputs = $this->rules() ?? [];

        $keys = array_keys(array_filter($inputs, function($key) {
            return strpos($key, '.*') < 1;
        }, ARRAY_FILTER_USE_KEY));

        return $this->only($keys);
    }
}