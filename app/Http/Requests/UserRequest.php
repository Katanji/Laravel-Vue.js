<?php
declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRequest
 * @package App\Http\Requests
 */
class UserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'             => 'required|string|min:2|max:20',
            'nickname'         => 'required|string|min:3|max:20',
            'surname'          => 'required|string|min:2|max:20',
            'image'            => 'required|image|max:10000',
            'phone'            => 'required|string|size:10',
            'male'             => 'required_if:female,===,null|in:on',
            'female'           => 'required_if:male,===,null|in:on',
            'newsletter_agree' => 'required|boolean',
        ];
    }
}
