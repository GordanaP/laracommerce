<?php

namespace App\Http\Requests;

use App\Rules\Cart\BelongsToProductSize;
use App\Rules\Cart\ExistsInProductSizes;
use App\Rules\Cart\IsRequired;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
        return [
            'size_id' => [
                'sometimes',
                'required',
                new ExistsInProductSizes($this->product)
            ],
            'color_id' => [
                'sometimes',
                'required',
                new BelongsToProductSize($this->product, $this->size_id)
            ],
            'quantity' => 'required|integer|min:1|max:5'
        ];
    }
}
