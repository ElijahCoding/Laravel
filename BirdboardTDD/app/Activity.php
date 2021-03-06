<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */
     protected $guarded = [];

     protected $casts = [
         'changes' => 'array'
     ];

     public function subject()
     {
         return $this->morphTo();
     }
     
     /**
     * Get the user who triggered the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
