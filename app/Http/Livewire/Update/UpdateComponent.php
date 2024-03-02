<?php

namespace App\Http\Livewire\Update;

use App\Models\SettingsAppearance;
use Artisan;
use File;
use Livewire\Component;

class UpdateComponent extends Component
{

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
        // Check if update file exists, or application is up to date
        if (!File::exists(base_path('updating'))) {
            return redirect('/');
        }

        // Run migration
        Artisan::call('migrate', [ '--force' => true ]);

        // After that we need to run seeder
        Artisan::call('db:seed', [ '--class' => 'PaystackSettingsTableSeeder', '--force' => true ]);
        Artisan::call('db:seed', [ '--class' => 'CashfreeSettingsTableSeeder', '--force' => true ]);
        Artisan::call('db:seed', [ '--class' => 'XenditSettingsTableSeeder', '--force' => true ]);

        // Clear cache
        Artisan::call('view:clear');
        Artisan::call('config:clear');

        // Delete update file
        File::delete(base_path('updating'));

        // Update appearance settings
        SettingsAppearance::where('id', 1)->update([
            'custom_fonts' => '<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">',
            'font_name'    => 'Heebo, Noto Kufi Arabic'
        ]);

        // Redirect
        return redirect('/');
    }
    
}