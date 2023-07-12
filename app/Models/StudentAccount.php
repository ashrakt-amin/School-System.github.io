<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;

    protected $fillable = ['date','type','fee_invoice_id','receipt_id','student_id',
                           'Debit','credit','description'];
    

                           public function feeType(){
                            return $this->belongsTo(Grade::class , 'type_id' ,'id');
                        }
}
