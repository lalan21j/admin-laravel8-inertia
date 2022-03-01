<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuCollection;
use App\Models\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Menu[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Menu::getAllMenu();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $input = $request->all();

        // evalua si ya existe un menu principal
        $main = Menu::where('parent_node', true)->count();
        if ($main == 0) {
            $input['parent_node'] = true;
            // $input['is_menu'] = true;
        }
/*
        if (trim($request->url) == '') {
            $input['parent_node'] = true;
        }
*/
        if (!$request->menu_id) {
            $input['parent_node'] = true;
        }

        try {
            $input['is_menu'] = true;
            $menu = Menu::store($input);
/*
            // Log::info('MenuController.store', ['menu1' => $menu->id]);

            if ((bool)$request->report) {
                Menu::addReport($request->all(), $menu->id);
            }

            // Log::info('MenuController.store', ['menu2' => $menu->id]);

            if ((bool)$request->crud) {
                Menu::addCrud($request->all(), $menu->id);
            }

            // Log::info('MenuController.store', ['request' => $request->all()]);
*/
            return response()->json([
                'message' => 'Registro creado'
            ]);
        } catch (QueryException $e) {
            Log::error('MenuController.store', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'No se ha podido guardar el registro'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }

    /**
     * @return MenuCollection
     */
    public function menuTree()
    {
        return new MenuCollection(Menu::all()->sortBy('label')->where('parent_node'));
    }
}
