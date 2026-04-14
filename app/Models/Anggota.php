<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $fillable = ['nama','kelas','alamat','no_telp','user_id'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
