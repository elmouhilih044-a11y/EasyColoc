<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'amount' => 'required|numeric|min:1',

            'payed_date' => 'required|date',

            'payer_id' => 'required|exists:users,id',

            'receiver_id' => 'required|exists:users,id|different:payer_id',

            'expense_id' => 'required|exists:expenses,id',
        ];
    }


  public function messages()
    {
        return [
            'amount.required' => 'Le montant est obligatoire',
            'amount.numeric' => 'Le montant doit être un nombre',
            'amount.min' => 'Le montant doit être supérieur à 0',

            'payed_date.required' => 'La date est obligatoire',
            'payed_date.date' => 'La date est invalide',

            'payer_id.required' => 'Le payeur est obligatoire',
            'payer_id.exists' => 'Utilisateur payeur introuvable',

            'receiver_id.required' => 'Le receveur est obligatoire',
            'receiver_id.exists' => 'Utilisateur receveur introuvable',
            'receiver_id.different' => 'Le payeur et le receveur doivent être différents',

            'expense_id.required' => 'La dépense est obligatoire',
            'expense_id.exists' => 'Dépense introuvable',
        ];
    }
}
