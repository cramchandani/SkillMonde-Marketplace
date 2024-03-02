<?php

namespace App\Http\Livewire\Admin\UserController;
//namespace App\Http\Controller\UserController;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

//class UsersComponent extends Component
//{
    
    public function exportUsers()
    {
        $users = DB::table('users')->select('username', 'email', 'account_type', 'balance_available', 'created_at', 'referrer', 'status')->get();
    
        $csvFileName = 'users.csv';
    
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        );
    
        $handle = fopen('php://output', 'w');
    
        // Add CSV header
        fputcsv($handle, [
            __('Username'),
            __('Email'),
            __('Account Type'),
            __('Earnings'),
            __('Registration Date'),
            __('Referrer'),
            __('Status'),
        ]);
    
        // Add user data to CSV
        foreach ($users as $user) {
            fputcsv($handle, [
                $user->username,
                $user->email,
                $user->account_type === 'seller' ? __('Seller') : __('Buyer'),
                number_format($user->balance_available, 2), // Format earnings as needed
                $user->created_at,
                $user->referrer,
                $user->status,
            ]);
        }
    
        fclose($handle);
    
        return Response::make(file_get_contents('php://output'), 200, $headers);
    }
//}
