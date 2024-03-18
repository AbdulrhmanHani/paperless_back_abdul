<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\GraphQL\Exceptions\ExceptionHandler;
use Illuminate\Contracts\Validation\Validator;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('page') ? $this->route('page')->id : $this->id;
        return [
            'title'  => ['string', 'max:255', 'unique:pages,title,'.$id.',id,deleted_at,NULL'],
            'content' => ['nullable','string'],
            'meta_title' => ['nullable','string'],
            'meta_description' => ['nullable','string'],
            'page_meta_image_id' => ['nullable','exists:attachments,id,deleted_at,NULL'],
            'status' => ['required','min:0','max:1'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ExceptionHandler($validator->errors()->first(), 422);
    }
}
