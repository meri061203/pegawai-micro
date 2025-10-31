<?php

namespace App\Models\Person;

use App\Traits\SkipsEmptyAudit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class Person extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;
    use SkipsEmptyAudit {
        SkipsEmptyAudit::transformAudit insteadof AuditableTrait;
    }

    public $incrementing = true;

    public $timestamps = false;

    protected $table = 'person';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jk',
        'golongan_darah',
        'agama',
        'kewarganegaraan',
        'email',
        'no_hp',
        'nik',
        'kk',
        'npwp',
        'alamat',
        'rt',
        'rw',
        'id_desa',
        'foto',
    ];

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'id' => 'integer',
        'id_desa' => 'integer',
        'tanggal_lahir' => 'date',
    ];

    public function setNamaLengkapAttribute($value): void
    {
        $this->attributes['nama_lengkap'] = strtoupper(trim(strip_tags($value)));
    }

    public function setNamaPanggilanAttribute($value): void
    {
        $this->attributes['nama_panggilan'] = strtoupper(trim(strip_tags($value)));
    }

    public function setTempatLahirAttribute($value): void
    {
        $this->attributes['tempat_lahir'] = trim(strip_tags($value));
    }

    public function setAgamaAttribute($value): void
    {
        $this->attributes['agama'] = trim(strip_tags($value));
    }

    public function setAlamatAttribute($value): void
    {
        $this->attributes['alamat'] = trim(strip_tags($value));
    }

    public function setRtAttribute($value): void
    {
        $this->attributes['rt'] = trim(strip_tags($value));
    }

    public function setRwAttribute($value): void
    {
        $this->attributes['rw'] = trim(strip_tags($value));
    }

    public function setNikAttribute($value): void
    {
        $this->attributes['nik'] = trim(strip_tags($value));
    }

    public function setNomorKkAttribute($value): void
    {
        $this->attributes['kk'] = trim(strip_tags($value));
    }

    public function setIdDesaAttribute($value): void
    {
        $this->attributes['id_desa'] = trim(strip_tags($value));
    }

    public function setNpwpAttribute($value): void
    {
        $this->attributes['npwp'] = $value ? trim(strip_tags($value)) : null;
    }

    public function setNomorHpAttribute($value): void
    {
        $this->attributes['no_hp'] = $value ? trim(strip_tags($value)) : null;
    }

    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = $value ? trim(strip_tags($value)) : null;
    }

    public function setKewarganegaraanAttribute($value): void
    {
        $this->attributes['kewarganegaraan'] = $value ? trim($value) : 'Indonesia';
    }

    public function setGolonganDarahAttribute($value): void
    {
        $this->attributes['golongan_darah'] = $value ? trim(strip_tags($value)) : null;
    }

    public function setFotoAttribute($value): void
    {
        $this->attributes['foto'] = $value ? trim(strip_tags($value)) : null;
    }

    public function getTanggalLahirAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}
