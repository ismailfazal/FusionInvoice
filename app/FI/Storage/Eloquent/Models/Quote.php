<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Date;

class Quote extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo('FI\Storage\Eloquent\Models\Client');
    }

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\QuoteAmount');
    }

    public function items()
    {
        return $this->hasMany('FI\Storage\Eloquent\Models\QuoteItem')
        ->orderBy('display_order');
    }

    public function taxRates()
    {
        return $this->hasMany('FI\Storage\Eloquent\Models\QuoteTaxRate');
    }

    public function user()
    {
        return $this->belongsTo('FI\Storage\Eloquent\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
   
    public function getCreatedAtAttribute($value)
    {
        return Date::customizeDate($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Date::customizeDate($value);
    }

    public function getExpiresAtAttribute($value)
    {
        return Date::customizeDate($value);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeDraft($query)
    {
        return $query->where('quote_status_id', '=', 1);
    }

    public function scopeSent($query)
    {
        return $query->where('quote_status_id', '=', 2);
    }

    public function scopeCanceled($query)
    {
        return $query->where('quote_status_id', '=', 4);
    }
}