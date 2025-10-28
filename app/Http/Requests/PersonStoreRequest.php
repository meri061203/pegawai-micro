<?php

namespace App\Http\Requests\Person;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:50',
            'nama_panggilan' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'golongan_darah' => 'nullable|in:A,B,O,AB',
            'agama' => 'required|string|max:20',
            'kewarganegaraan' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:16',
            'nik' => 'nullable|string|max:16|unique:person,nik',
            'kk' => 'nullable|string|max:16',
            'npwp' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:100',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'id_desa' => 'nullable|integer|exists:ref_almt_desa,id_desa',
            'foto' => 'nullable|image|max:2048|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png',




        ];
    }

    public function attributes(): array
    {
        return [
            'nama_lengkap' => 'Nama Lengkap',
            'nama_panggilan' => 'Nama Panggilan',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'golongan_darah' => 'Golongan Darah',
            'agama' => 'Agama',
            'kewarganegaraan' => 'Kewarganegaraan',
            'email' => 'Email',
            'no_hp' => 'Nomor HP',
            'nik' => 'NIK',
            'kk' => 'Nomor KK',
            'npwp' => 'NPWP',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'id_desa' => 'Desa',
            'foto' => 'Foto',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()->messages(),
            ], 422)
        );
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Field :attribute wajib diisi.',
            'nama_lengkap.string' => 'Field :attribute harus berupa teks.',
            'nama_lengkap.max' => 'Field :attribute maksimal :max karakter.',
            'nama_panggilan.required' => 'Field :attribute wajib diisi.',
            'nama_panggilan.string' => 'Field :attribute harus berupa teks.',
            'namapanggilan.max' => 'Field :attribute maksimal :max karakter.',
            'tempat_lahir.required' => 'Field :attribute wajib diisi.',
            'tempat_lahir.string' => 'Field :attribute harus berupa teks.',
            'tempat_lahir.max' => 'Field :attribute maksimal :max karakter.',
            'tanggal_lahir.required' => 'Field :attribute wajib diisi.',
            'tanggal_lahir.date' => 'Field :attribute harus berupa tanggal yang valid.',
            'jk.required' => 'Field :attribute wajib diisi.',
            'jk.in' => 'Field :attribute harus L atau P.',
            'golongan_darah.in' => 'Field :attribute harus salah satu dari: A, B, O, AB.',
            'agama.required' => 'Field :attribute wajib diisi.',
            'agama.string' => 'Field :attribute harus berupa teks.',
            'agama.max' => 'Field :attribute maksimal :max karakter.',
            'kewarganegaraan.string' => 'Field :attribute harus berupa teks.',
            'email.email' => 'Field :attribute harus berupa email yang valid.',
            'email.max' => 'Field :attribute maksimal :max karakter.',
            'no_hp.string' => 'Field :attribute harus berupa teks.',
            'no_hp.max' => 'Field :attribute maksimal :max karakter.',
            'nik.string' => 'Field :attribute harus berupa teks.',
            'nik.max' => 'Field :attribute maksimal :max karakter.',
            'nik.unique' => 'Field :attribute sudah digunakan.',
            'kk.string' => 'Field :attribute harus berupa teks.',
            'kk.max' => 'Field :attribute maksimal :max karakter.',
            'npwp.string' => 'Field :attribute harus berupa teks.',
            'npwp.max' => 'Field :attribute maksimal :max karakter.',
            'alamat.string' => 'Field :attribute harus berupa teks.',
            'alamat.max' => 'Field :attribute maksimal :max karakter.',
            'rt.string' => 'Field :attribute harus berupa teks.',
            'rt.max' => 'Field :attribute maksimal :max karakter.',
            'rw.string' => 'Field :attribute harus berupa teks.',
            'rw.max' => 'Field :attribute maksimal :max karakter.',
            'id_desa.integer' => 'Field :attribute harus berupa angka.',
            'id_desa.exists' => 'Field :attribute tidak ditemukan.',
            'foto.image' => 'Field :attribute harus berupa gambar.',
            'foto.max' => 'Field :attribute maksimal :max KB.',
            'foto.mimes' => 'Field :attribute harus bertipe: jpg, jpeg, png.',
            'foto.mimetypes' => 'Field :attribute harus bertipe: image/jpeg, image/png.',
        ];
    }
}
