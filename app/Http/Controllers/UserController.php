<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return response()->json([
            'status' => 200,
            'message' => count($users) .' Users Found',
            'data' => $users
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5',
            'age' => 'required|min:2' 
        ]);


        $user = User::create($validated);

        if($user)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Record Created Successfully',
                'data' => $user
            ]);
        }
        else
        {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong!',
            ]);
        }
    }

    public function view($id)
    {
        try{
            $user= User::findOrFail($id);
            
            return response()->json([
                'status' => 200,
                'message' => 'Fetched User Record Successfully',
                'data' => $user
            ]);
        }

        catch (Exception $e)
        {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found by ID: '.$id,
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|min:3',
                'email' => 'sometimes|unique:users,email,' . $id,
                'password' => 'sometimes|min:5',
                'age' => 'sometimes|min:2' 
            ]);
            
            $user->update($validated);
    
            return response()->json([
                'status' => 200,
                'message' => 'Record Updated Successfully for the ID: '.$id,
                'data' => $user
            ]);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found by ID: '.$id,
                'exception' => $e->getMessage()
            ]);
        }

        catch(Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong!',
                'exception' => $e->getMessage()
            ]);
        }
    }
    
    public function delete($id)
    {
        try{
            $user= User::findOrFail($id);
            $user->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'User Deleted With ID: '.$id.' Successfully',
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found by ID: '.$id,
                'exception' => $e->getMessage()
            ]);
        }
    }
}
