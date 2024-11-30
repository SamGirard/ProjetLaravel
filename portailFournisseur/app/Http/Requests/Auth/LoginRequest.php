<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    protected $type_connexion;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $identifier = $this->input('identifier');

            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $this->merge(['email' => $identifier]);
                $validator->addRules([
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:64' . User::class],
                ]);
            } else if (preg_match('/^(11|22|33|88)[4-9]\d{7}$/', $identifier)) {
                $this->merge(['neq' => $identifier]);
                $validator->addRules([
                    'neq' => ['size:10', 'regex:/^(11|22|33|88)[4-9]\d{7}$/' . User::class],
                ]);
            } else {
                $validator->errors()->add('identifier', 'Le champ doit être une adresse email valide ou un NEQ de 10 chiffres.');
            }
        });
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = [
            filter_var($this->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'neq' => $this->identifier,
            'password' => $this->password,
        ];

        if (!Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'identifier' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'identifier' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('identifier')) . '|' . $this->ip());
    }
}
