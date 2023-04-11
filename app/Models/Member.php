<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['Names', 'Code', 'currentBalance'];
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('Names', 'like', '%' . request('search') . '%')
                ->roWhere('Code', 'like', '%' . request('search') . '%');
        }
    }

    public function member_profiles()
    {
        return $this->hasOne(MemberProfile::class);
    }

    public function nok()
    {
        return $this->hasOne('');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
