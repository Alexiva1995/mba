<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_details';

    protected $fillable = ['purchase_id', 'course_id', 'membership_id', 'membership_type', 'offer_id',  'amount'];

    public function purchase(){
        return $this->belongsTo('App\Models\Purchase');
    }

    public function membership(){
        return $this->belongsTo('App\Models\Membership');
    }

    public function offer(){
        return $this->belongsTo('App\Models\OffersLive');
    }
}
