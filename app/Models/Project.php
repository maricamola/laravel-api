<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'type',
        'thumb',
        'date_creation',
        'description',
        'thumb_original_name',
    ];

    //Relazione con la tabella Category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function technologies(){
        //Con questa istruzione gli diciamo "dammi tutti le technologies di questo project"
        return $this->belongsToMany(Technology::class);
    }


    public static function generateSlug($str){

        $slug = Str::slug($str, '-');
        $original_slug = $slug;
        $slug_exixts = Project::where('slug', $slug)->first();
        $c = 1;
        while($slug_exixts){
            $slug = $original_slug . '-' . $c;
            $slug_exixts = Project::where('slug', $slug)->first();
            $c++;
        }

        return $slug;
    }
}



