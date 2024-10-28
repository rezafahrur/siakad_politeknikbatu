<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKuisionerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mahasiswa_id' => 'required|exists:m_mahasiswa,id',
            'semester_id' => 'required|exists:m_semester,id',
            'jenis_surat' => 'required|string|max:50',
            'catatan' => 'nullable|string|max:255',
            'status' => 'required|integer|max:2',
        ];
    }

    public function messages(): array
    {
        return [
            'mahasiswa_id.required' => 'Mahasiswa wajib diisi.',
            'mahasiswa_id.exists' => 'Mahasiswa tidak valid.',
            'semester_id.required' => 'Semester wajib diisi.',
            'semester_id.exists' => 'Semester tidak valid.',
            'jenis_surat.required' => 'Jenis surat wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}
