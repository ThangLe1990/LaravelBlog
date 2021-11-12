<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
      public function paginate( $filter = [], $limit = 2)
    {
       $query =  User::query();
        
        if( !empty($filter['name']) ) {
        //    $query->where( 'name', 'regexp' . '.*' . $filter['name'] . '.*' ); 
         $query->where( 'name','like', '%' . $filter['name'] . '%' ); 
        }

        if( !empty($filter['email']) ) {
         $query->where( 'email','like', '%' . $filter['email'] . '%' ); 
        }

        if( !empty($filter['sort_column']) && 
            !empty($filter['sort_type']) && 
            in_array ( strtolower ($filter['sort_type']) , ['desc', 'asc']) ) {
           
                $query->orderBy( $filter['sort_column'] , $filter['sort_type'] );    
        }

       return $query->paginate($limit);
    }
    
    public function save(array $input, $id = null)
    {
        if ( !empty($input['password']) ) {
            $input['password'] = bcrypt($input['password']); 
        }
        
        return User::updateOrCreate( ['id' => $id], $input);
    }

    public function find($id)
    {
         
    }
    
    public function get($filter = [])
    {
        
    }

    public function delete(array $ids)
    {
         
    }
}
 