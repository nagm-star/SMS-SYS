<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'group_name', 'group_desc'
    ];
/*     // Table Name
    protected $table = 'groups';

    // Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true; */

    public function user(){
        return $this->belongsTo('App\User');
    }

    // Created By Nagm yousif
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // Created By Nagm yousif
    // to delete all related members

    public function delete()
    {
        $this->members()->delete();

        return parent::delete();
    }
}
