<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Menu extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'label', 'icon', 'url', 'parent_node', 'menu_id', 'is_menu', 'description'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'children'
    ];

    /**
     * @var bool[]
     */
    protected $attributes = [
        // 'parent_node' => true
    ];

    // RELATIONSHIPS

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'menu_id')->orderBy('label');
    }

    // ELOQUENT

    /**
     * @return Menu[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllMenu()
    {
        return Menu::all('id', 'label', 'parent_node')->sortBy('label')->where('parent_node');
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public static function store($data)
    {
        return Menu::create($data);
    }

    /**
     * @param $data
     *
     * @return void
     */
    public static function addReport($data, $menu_id)
    {
        $request = $data;
        $report = ['pdf', 'spreadsheet'];

        foreach ($report as $item) {
            $data['label'] = 'Reporte ' . (($item == 'pdf') ? $item : 'Hoja de cálculo');
            $data['url'] = $request['url'] . '/' . $item;
            $data['menu_id'] = $menu_id;
            $data['parent_node'] = null;
            $data['is_menu'] = null;

            Menu::create($data);
        }
    }

    /**
     * @param $data
     * @param $menu_id
     *
     * @return void
     */
    public static function addCrud($data, $menu_id)
    {
        $request = $data;
        $crud = ['Ver', 'Actualizar', 'Eliminar', 'Crear'];
        $route = ['view', 'update', 'delete', 'store'];

        foreach ($crud as $key => $item) {
            $data['url'] = $request['url'] . '.' . $route[$key];
            $data['label'] = $item;
            $data['menu_id'] = $menu_id;
            $data['parent_node'] = null;
            $data['is_menu'] = null;

            Menu::create($data);
        }
    }
}
