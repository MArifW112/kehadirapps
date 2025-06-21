<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAbsensi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "user_id",
        "tanggal",
        "nama",
        "absensi_masuk",
        "absensi_keluar",
        "istirahat_mulai",
        "istirahat_selesai",
    ];

    public function creator(){
        return $this->belongsTo(User::class, "created_by", "id");
    }

    public function updater(){
        return $this->belongsTo(User::class, "updated_by", "id");
    }
}
