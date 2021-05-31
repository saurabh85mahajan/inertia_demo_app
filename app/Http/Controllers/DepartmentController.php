<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Request;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{

    public function __construct() 
    {
        $this->authorizeResource(Department::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sortby = Request::get('sortby', 'id');
        if(!in_array($sortby, ['id', 'name', 'email'])) {
            $sortby = 'id';
        }
        $sort = Request::get('sort', 'asc');
        if(!in_array($sort, ['asc', 'desc'])) {
            $sort = 'asc';
        }

        return Inertia::render('Departments/Index', [
            'departments' => Department::orderBy($sortby, ($sort == 'asc') ? 'ASC' : 'DESC')->paginate(10)
                ->through(function($department) {
                    return [
                        'id' => $department->id,
                        'name' => $department->name,
                        'phone' => $department->phone,
                        'email' => $department->email,
                        'can' => [
                            'delete' => auth()->user()->can('delete', $department),
                            'edit' => auth()->user()->can('update', $department),
                        ],
                    ];
                }),
                'sortby' => $sortby,
                'sort' => $sort,
            'can' => [
                'create' => auth()->user()->can('create', Department::class)
            ]
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Departments/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        //
        Department::create($request->all());

        return Redirect::route('departments.index')->with('success', 'Department Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        return Inertia::render('Departments/Edit', [
            'department' => [
                'id' => $department->id,
                'name' => $department->name,
                'email' => $department->email,
                'phone' => $department->phone,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        //
        $department->update($request->all());
        return Redirect::route('departments.index')->with('success', 'Department Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
        return Redirect::route('departments.index')->with('success', 'Department Deleted.');

    }
}
