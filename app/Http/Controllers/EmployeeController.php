<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    protected $employeeService;
    public function __construct(EmployeeService $employeeService){

        $this->employeeService = $employeeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        // try{
            
            $employees = $this->employeeService->fetchAllEmployee($request);

            $positions = Employee::POSITION;

            $banks = Employee::BANK_ACCOUNT;

            return view('employee.index', compact('employees', 'positions', 'banks'));
        // }catch(\Throwable $th){
            
        //     return redirect('/')->with('error', $th->getMessage());
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        try{
            DB::transaction(function() use($request){
                
                $this->employeeService->storeEmployee($request);
            });

            return response()->json([
                "status" => true,
                "message" => "New employee successfully stored."
            ], 200);
        } catch (ModelNotFoundException $ex) {
            
            return response()->json([
                'status' => false,
                'error' => $ex->getModel()." not found!"
            ], 404);
        }catch(\Throwable $th){
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $employeeIDNo)
    {
        try{
            DB::transaction(function() use($request, $employeeIDNo){
                
                $this->employeeService->updateEmployee($request, $employeeIDNo);
            });

            return response()->json([
                "status" => true,
                "message" => "Employee data successfully updated."
            ], 200);
        } catch (ModelNotFoundException $ex) {
            $modelWithoutBackslash = str_replace('\\', '|', $ex->getModel());
            $model = explode('|', $modelWithoutBackslash);
            return response()->json([
                'status' => false,
                'error' => $model[count($model)-1]." not found!"
            ], 404);
        }catch(\Throwable $th){
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $employeeIDNo)
    {
        try{
            DB::transaction(function() use($employeeIDNo){
                
                $this->employeeService->destroyEmployee($employeeIDNo);
            });

            return response()->json([
                "status" => true,
                "message" => "Employee data successfully deleted."
            ], 200);
        } catch (ModelNotFoundException $ex) {
            $modelWithoutBackslash = str_replace('\\', '|', $ex->getModel());
            $model = explode('|', $modelWithoutBackslash);
            return response()->json([
                'status' => false,
                'error' => $model[count($model)-1]." not found!"
            ], 404);
        }catch(\Throwable $th){
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
