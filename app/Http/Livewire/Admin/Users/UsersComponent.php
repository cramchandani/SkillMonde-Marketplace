<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use App\Notifications\User\Everyone\AccountActivated;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class UsersComponent extends Component
{
    use WithPagination, SEOToolsTrait, Actions;
    public $search = '';


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        // Seo
        $this->seo()->setTitle( setSeoTitle(__('messages.t_users'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.users.users', [
            'users' => $this->users
        ])->extends('livewire.admin.layout.app')->section('content');
    }


    /**
     * Get list of users
     *
     * @return object
     */
     /*
    public function getUsersProperty()
    {
        return User::latest()->paginate(42);
    }
    */
    public function getUsersProperty()
    {
        return User::query()
            ->latest()
            ->where(function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('referrer', 'like', '%' . $this->search . '%')
                    ->orWhere('fullname', 'like', '%' . $this->search . '%');
            })
            ->paginate(42);
    }



    /**
     * Ban selected user
     *
     * @param integer $id
     * @return void
     */
    public function ban($id)
    {
        // Update user
        User::where('id', $id)->where('status', '!=', 'banned')->update([
            'status' => 'banned'
        ]);

        // Success
        $this->notification([
            'title'       => __('messages.t_success'),
            'description' => __('messages.t_user_has_been_banned_success'),
            'icon'        => 'success'
        ]);
    }


    /**
     * Delete user
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        // Delete user
        User::where('id', $id)->delete();
    }


    /**
     * Activate account
     *
     * @param integer $id
     * @return void
     */
    public function activate($id)
    {
        // Get user
        $user = User::where('id', $id)->where('status', 'pending')->firstOrFail();

        // Send notification to user
        $user->notify( (new AccountActivated)->locale(config('app.locale')) );

        // Activate account
        $user->status = "active";
        $user->save();

        // Success
        $this->notification([
            'title'       => __('messages.t_success'),
            'description' => __('messages.t_user_has_been_activated_success'),
            'icon'        => 'success'
        ]);
    }
    
    public function refreshPage()
    {
        // No need to include any logic here, just the method name is sufficient
    }
    
    public function export()
    {
        $users = DB::table('users')->select('username', 'email', 'account_type', 'balance_available', 'created_at', 'referrer', 'status')->get();
    
        $csvFileName = 'users.csv';
    
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        );
    
        return Response::stream(function () use ($users, $headers) {
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
        }, 200, $headers);
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
    
}
