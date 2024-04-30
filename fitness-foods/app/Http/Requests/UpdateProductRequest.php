<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|in:published,draft,trash',
            'imported_t' => 'nullable|date',
            'url' => 'nullable|url|max:1000',
            'creator' => 'nullable|string|max:255',
            'product_name' => 'nullable|string|max:255',
            'quantity' => 'nullable|string|max:255',
            'brands' => 'nullable|string|max:255',
            'categories' => 'nullable|string|max:1000',
            'labels' => 'nullable|string|max:255',
            'cities' => 'nullable|string|max:255',
            'purchase_places' => 'nullable|string|max:255',
            'stores' => 'nullable|string|max:255',
            'ingredients_text' => 'nullable|string',
            'traces' => 'nullable|string|max:255',
            'serving_size' => 'nullable|string|max:255',
            'serving_quantity' => 'nullable|numeric|between:0,9999999.99',
            'nutriscore_score' => 'nullable|integer|min:0|max:1000',
            'nutriscore_grade' => 'nullable|string|max:1',
            'main_category' => 'nullable|string|max:255',
            'image_url' => 'nullable|url|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.in' => 'The status must be one of the following: published, draft, trash.',
            'imported_t.date' => 'The imported_t must be a date.',
            'url.url' => 'The url must be a valid URL.',
            'url.max' => 'The url must not be greater than 1000 characters.',
            'creator.max' => 'The creator must not be greater than 255 characters.',
            'product_name.max' => 'The product_name must not be greater than 255 characters.',
            'quantity.max' => 'The quantity must not be greater than 255 characters.',
            'brands.max' => 'The brands must not be greater than 255 characters.',
            'categories.max' => 'The categories must not be greater than 1000 characters.',
            'labels.max' => 'The labels must not be greater than 255 characters.',
            'cities.max' => 'The cities must not be greater than 255 characters.',
            'purchase_places.max' => 'The purchase_places must not be greater than 255 characters.',
            'stores.max' => 'The stores must not be greater than 255 characters.',
            'traces.max' => 'The traces must not be greater than 255 characters.',
            'serving_size.max' => 'The serving_size must not be greater than 255 characters.',
            'serving_quantity.numeric' => 'The serving_quantity must be a number.',
            'serving_quantity.between' => 'The serving_quantity must be between 0 and 9999999.99.',
            'nutriscore_score.integer' => 'The nutriscore_score must be an integer.',
            'nutriscore_score.min' => 'The nutriscore_score must be at least 0.',
            'nutriscore_score.max' => 'The nutriscore_score must not be greater than 1000.',
            'nutriscore_grade.max' => 'The nutriscore_grade must not be greater than 1 character.',
            'main_category.max' => 'The main_category must not be greater than 255 characters.',
            'image_url.url' => 'The image_url must be a valid URL.',
            'image_url.max' => 'The image_url must not be greater than 255 characters.',
        ];
    }
}
