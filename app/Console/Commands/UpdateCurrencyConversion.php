use Illuminate\Console\Command;
use App\Models\CurrencyConversion;
use Illuminate\Support\Facades\Http;

class UpdateCurrencyConversion extends Command
{
    protected $signature = 'update:currency-conversion';
    protected $description = 'Fetch and update currency conversion rates';

    public function handle()
    {
        // Fetch the exchange rates from the API
        $response = Http::get('https://api.openexchangerates.org/latest.json?app_id=06c5f37d39b0499e8dc1cb7ce2bb0042');

        if ($response->successful()) {
            $data = $response->json();
            $baseCode = $data['base'];
            
            // Update the currency conversion rates in the database
            foreach ($data['rates'] as $targetCode => $targetValue) {
                CurrencyConversion::updateOrCreate(
                    ['base_code' => $baseCode, 'target_code' => $targetCode],
                    ['base_value' => 1, 'target_value' => $targetValue]
                );
            }

            $this->info('Currency conversion rates updated successfully.');
        } else {
            $this->error('Failed to fetch currency conversion rates from the API.');
        }
    }
}
