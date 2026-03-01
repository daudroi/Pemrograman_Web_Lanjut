<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id',
        'username',
        'nama_lengkap',
        'password',
        'data_lengkap',
    ];

    protected $hidden = ['password'];

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function penjualan()
    {
        return $this->hasMany(PenjualanModel::class, 'user_id', 'user_id');
    }
}
