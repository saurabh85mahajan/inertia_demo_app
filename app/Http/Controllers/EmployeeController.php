<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct() 
    {
        $this->authorizeResource(Employee::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Employees/Index', [
            'can' => [
                'create' => auth()->user()->can('create', Employee::class),
            ],
            'department_id' => Request::get('department_id'),
            'employees' => Employee::orderBy('id', 'DESC')
                ->with('department')
                ->whereDepartment(Request::get('department_id'))
                ->get()
                ->transform(function ($employee) {
                    return [
                        'id' => $employee->id,
                        'name' => $employee->name,
                        'email' => $employee->email,
                        'department' => $employee->department->name ?? null,
                        'can' => [
                            'delete' => auth()->user()->can('delete', $employee),
                            'edit' => auth()->user()->can('update', $employee),
                        ],
                    ];
                }),
            'departments' => function () {
                return Department::orderBy('name')->get()
                    ->transform(function ($d) {
                        return [
                            'id' => $d->id,
                            'label' =>  $d->name
                        ];
                    });
            }
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
        return Inertia::render('Employees/Create', [
            'departments' => Department::orderBy('name')->get()
                ->transform(function ($d) {
                    return [
                        'id' => $d->id,
                        'label' =>  $d->name
                    ];
                })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        //
        Employee::create($request->all());

        return Redirect::route('employees.index')->with('success', 'Employee created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        return Inertia::render('Employees/Edit', [
            'employee' => [
                'id' => $employee->id,
                'department_id' => $employee->department->id,
                'name' => $employee->name,
                'email' => $employee->email,
            ],
            'departments' => Department::orderBy('name')->get()
                ->transform(function ($d) {
                    return [
                        'id' => $d->id,
                        'label' =>  $d->name
                    ];
                })
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        //
        $employee->update($request->all());
        return Redirect::route('employees.index')->with('success', 'Employee Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return Redirect::back()->with('success', 'Employee deleted.');
    }
}
