<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected  $model;

    public function __construct()
    {
        $this->model=New Category();
    }


    public function index(Request $request)
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = $this->getTitle();
        return view('admin.category.show', ['data' => $data]);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'level', 'title' => '等级'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];
    }

    public function getData(Request $request)
    {
        $model = $this->model;
        $limit = $request->limit ?? '10';
        if ($request->has('id')) {
            $sql = $model->where('id',$request->input('id'));
        }
        $count = $sql->count();
        $paginate = $sql->paginate($limit);
        $data = $paginate->toArray();
        return $data = ['code' => 0, 'msg' => '', 'count' => $count, 'data' => $data['data']];
    }

}
