<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'published_at',
        'user_id' //temporary
    ];

    protected $dates = [
        'published_at'
    ];

    //Scope - called by Controller
    //Assign a name to some kind of where clause

    /**
     * Query scope for active flag
     * @param $query
     * Needs to follow convention of scopeNameOfScope
     */
    public function scopeActive($query)
    {
        $query->where('active_flag', '=', 'Y');
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    //Scope - called by Controller
    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>=', Carbon::now());
    }


    /*
     * Mutators
     * Will be run on elements that match
     * Convention setNameOfElementAttribute e.g. setPasswordAttribute
     */

    //SetNameAttribute //Underscore to camel case
    public function setPublishedAtAttribute($date)
    {
//        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
        $this->attributes['published_at'] = Carbon::parse($date);
        //parse sets to midnight
    }

    /**
     * An article is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }//$article->user // check what user_id field is from article then get the user from the database
}
