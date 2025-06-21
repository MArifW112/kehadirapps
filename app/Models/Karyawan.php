<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","nama_karyawan","alamat","email","no_hp","jabatan"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($karyawan) {
            if ($karyawan->user) {
                $karyawan->user->delete();  // Hapus user yang terkait
            }
        });
    }
}
