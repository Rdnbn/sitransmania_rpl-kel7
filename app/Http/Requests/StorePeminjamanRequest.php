<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
{
    public function authorize()
    {
        return true; // karena sudah lewat middleware role
    }

    public function rules()
    {
        return [
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'foto_ktp' => 'nullable|image|max:4096',
        ];
    }

    public function messages()
    {
        return [
            'id_kendaraan.required' => 'Kendaraan wajib dipilih.',
            'tanggal_mulai.after_or_equal' => 'Tanggal mulai minimal hari ini.',
            'tanggal_selesai.after' => 'Tanggal selesai harus lebih besar.',
        ];
    }
}
