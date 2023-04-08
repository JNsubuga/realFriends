<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['txnDate', 'account_id', 'member_id', 'event_id', 'Dr', 'Cr', 'balanceBefore'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('txnDate', 'like', '%' . request('search') . '%');
        }
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'members');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'accounts');
    }
}
