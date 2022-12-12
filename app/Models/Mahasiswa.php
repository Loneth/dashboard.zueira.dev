<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NIM',
        'nama_mahasiswa',
        'email',
        'prodi_id',
        'semester',
    ];

    /**
     * Get Prodi.
     *
     * @return \App\Models\Prodi
     */
    public function Prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
