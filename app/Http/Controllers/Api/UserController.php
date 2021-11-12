<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    protected $userRepository; 
    public function __construct( UserRepository $userRepository )
    {
       $this -> userRepository =  $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $userPaginate = $this->userRepository->paginate( request()->all() );
            
            return response () -> json ([
                    'status' => true,
                    'data' => [
                        'users' => $userPaginate,
                        'meta'  => [
                            'current_page' => $userPaginate->currentPage(),
                            'total'        => $userPaginate->total() 
                        ]
                    ]  

                ]);
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message'=> env('APP_ENV') != 'production' ? $e->getMessage() : 'Something went wrong !!!'
                ]);
            }
    }

     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           try {
            $user = $this -> userRepository -> save( $request->only ('name','email','password') );
             return response()->json([
                'status' => true,
                'data'   => [
                    'user' => $user
                ]    
            ]); 
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message'=> env('APP_ENV') != 'production' ? $e->getMessage() : 'Something went wrong !!!'
                ]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           try {
             return response()->json([
                'status' => true,
                'data'   => []    
            ]); 
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message'=> env('APP_ENV') != 'production' ? $e->getMessage() : 'Something went wrong !!!'
                ]);
            }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           try {
             return response()->json([
                'status' => true,
                'data'   => []    
            ]); 
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message'=> env('APP_ENV') != 'production' ? $e->getMessage() : 'Something went wrong !!!'
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           try {
             return response()->json([
                'status' => true,
                'data'   => []    
            ]); 
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message'=> env('APP_ENV') != 'production' ? $e->getMessage() : 'Something went wrong !!!'
                ]);
            }
    }
}