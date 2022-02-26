<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Role[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Role::datatable($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreRoleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($request->name);

        try {
            Role::store($input);

            return response()->json([
                'message' => 'Información almacenada.'
            ], 201);
        } catch (QueryException $e) {
            \Log::error('RoleController.store', [$e]);

            return response()->json(['message' => 'Se ha presentado un error.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateRoleRequest $request
     * @param \App\Models\Role                     $role
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
