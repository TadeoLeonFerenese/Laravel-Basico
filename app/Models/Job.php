<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Job extends Model{
    use HasFactory;
    protected $table = 'job_listings';

    //esto funciona como una lista negra, todo lo que especifique aca no va a estar protegido, pero el resto si
    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");

    // }
}