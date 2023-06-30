<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
      'status','duration','payment_approved','payment_eot','payment_date','membership_type_id','user_id','duration_type','start_date','payment_type','payment_total','payment_changes'
    ];
    public function member() {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function user() {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function type() {
      return $this->belongsTo('App\Models\MembershipType', 'membership_type_id');
    }
    public function durationTypeLocal() {
      switch ($this->duration_type) {
        case 'daily':
          return 'hari';
          break;
          case 'weekly':
            return 'minggu';
            break;
            case 'monthly':
              return 'bulan';
              break;

        default:
          # code...
          break;
      }
    }
}
