<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDomicilioRequest;
use App\User;
use App\UserDomicilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserDomicilioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $campos = [
            'id',
            'user_id',
            'calle',
            'colonia',
            'cp',
        ];

        $users = UserDomicilio::select($campos)->get();

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserDomicilioRequest $request)
    {
        $data = $request->all();

        Log::info($data);

        UserDomicilio::create($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $campos = [
            'user_id',
            'calle',
            'colonia',
            'cp',
        ];

        $user = UserDomicilio::select($campos)->findOrFail($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserDomicilioRequest $request, $id)
    {
        $user = UserDomicilio::where('id', $id)->firstOrFail();
        $data = $request->all();

        $user->update($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        UserDomicilio::findOrFail($id)->delete();

        return response()->json(['result' => 'ok'], 200);
    }

    public function relacion($id)
    {

        // No terminado
        $info = User::select('name', 'email', 'telefono')
            ->join('id', 'users.id', '=', 'users_domicilios.user_id')
            ->where('users.id', $id)
            ->get();

        return response()->json($info, 200);

    }
}
