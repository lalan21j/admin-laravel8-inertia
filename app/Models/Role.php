<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'slug', 'permission', 'description'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * @param $array
     *
     * @return void
     */
    public function setPermissionAttribute($array)
    {
        $this->attributes['permission'] = json_encode($array);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public function getPermissionAttribute($string)
    {
        return json_decode($string);
    }

    /**
     * @param $data
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function datatable($data)
    {
        $roles = Role::query()->orderBy('name');

        if ($data['search']) {
            $roles->whereRaw("name ilike '%" . $data['search'] . "%'");
        }

        return $roles->paginate();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public static function store($data)
    {
        return Role::create($data);
    }
}
