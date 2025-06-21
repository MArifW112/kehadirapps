<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanIzin extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "nama", 
        "tipe_izin",
        "jabatan", 
        "tanggal", 
        "alasan_izin", 
        "lampiran",
        "status",
        "approved_by"
    ];

    /**
     * Relasi ke User yang menyetujui izin.
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relasi ke User yang mengajukan izin.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
