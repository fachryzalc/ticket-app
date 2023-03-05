<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
        'order_id', 'ticket_id', 'total_ticket'
    ];
    public $timestamps = true;
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
