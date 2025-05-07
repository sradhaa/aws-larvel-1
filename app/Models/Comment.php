<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
//blog_post_id
//here blogPost function name shoule be similiar to foreign key name like blog_post_id.
//laravel automatically pick froeign key from the method.
//if instead of blogPost its post then frorign key will be post_id and passed as 2 nd argument
//if blog_posts table has different primary key name rather than id then we need to explicitily pass
//the primary id in 3rd argument  
public function blogPost(){
     //   return $this->belongsTo('App\Models\BlogPost' ,'post_id' ,'blog_post_id');
        return $this->belongsTo('App\Models\BlogPost');
    }
}
