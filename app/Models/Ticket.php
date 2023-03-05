<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $fillable = [
        'name', 'price', 'stock', 'date', 'status', 'discount', 'duedate'
    ];
    public $timestamps = false;

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
