<?php

namespace App\Http\Livewire\Admin\Users\Export;

use App\Http\Livewire\Admin\Users\Export\ExportComponent;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class ExportComponent extends Component
{
    public function export()
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

        // Return a Livewire response to trigger the download
        return $this->download();
    }

    public function download()
    {
        return Response::stream(function () {
            $users = DB::table('users')->select('username', 'email', 'account_type', 'balance_available', 'created_at', 'referrer', 'status')->get();
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
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.export');
    }
}