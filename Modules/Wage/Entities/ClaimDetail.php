<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ClaimDetail extends Model
{
    protected $table = 'claimdetails';
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(ClaimType::class, 'claimtype_id');
    }

    public function attachments()
    {
        return $this->hasMany(ClaimAttachment::class);
    }
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
}