<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Buku extends Model
{
    protected $table = 'bukus';

    protected $fillable = ['judul','pengarang','penerbit','tahun_terbit','stok'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
