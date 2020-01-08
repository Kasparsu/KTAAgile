<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    public static $model;
    protected function order(){
        if(\request()->has('order') && \request()->has('field')){
            try {
                return static::$model::orderBy(\request()->input('field'), \request()->input('order'));
            } catch (QueryException $e){
                return static::$model::query();
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * @var Builder $query
         */
        $query = $this->order();
        return $query->paginate();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return static::$model::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $model = static::$model::find($id);
       $model->delete();
       return response()->json(['status' => 'OK']);
    }
}
