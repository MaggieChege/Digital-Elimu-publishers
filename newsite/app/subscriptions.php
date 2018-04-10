<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscriptions extends Model
{
    //
    protected $table = 'subscriptions';
    protected $searchable = [

        'columns' => [
            'subscriptions.id', 'subscriptions.Book_name',
            'client_contact',

            'subscriptions.amount' => 5,

            'created_at' => 3,

        ]
    ];
    protected $fillable = [
        'id','publisher_id','Book_name','client_id','client_contact','book_id','amount'
    ];
    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
    
    public function client()
    {
        return $this->belongsTo('App\Clients', 'client_id');
    }
}
