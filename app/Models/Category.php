<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use App\Http\Rules\Filter;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name','parent_id','description','image','status' , 'slug'];
     // this varible obbiste $fillable
    //protected $gradud = [id];
    public function scopeActive(builder $builder) {
         $builder->where('status' , '=' , 'active');
    }

    public function scopeFilter(builder $builder , $filters) {
        if ($filters['name'] ?? false) {
            $builder->where('categories.name' ,'LIKE' , "%{$filters['name']}%");
        }
        if ($filters['status'] ?? false) {
            $builder->where('categories.status' ,'=' , $filters['status']);
        }
    }
    public static function rules($id = 0) {
        return [
            'name'      => [
                'required' ,
                'string',
                'min:2' ,
                'max: 10' ,
                  Rule::unique('categories' , 'name')->ignore($id) ,
                  'filter : laravel'
             ] ,
            'parent_id' => ['nullable' ,'int' , 'exists:categories,id'],
            'image'     => ['image' , 'mimes:jpg,bmp,png'],
            'status'    => ['in:active,archived'],
            // function ($attribute , $value , $fails) {
            //     dd(value);
            //     if ($value == 'laravel') {
            //         $fails('the name is forbidden');
            //     }
            // }

        ];
    }
}
