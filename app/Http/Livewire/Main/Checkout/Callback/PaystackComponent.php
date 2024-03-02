<?php

namespace App\Http\Livewire\Main\Checkout\Callback;

use App\Models\Gig;
use App\Models\GigUpgrade;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\OrderItem;
use App\Models\OrderItemUpgrade;
use App\Notifications\User\Buyer\OrderPlaced;
use App\Notifications\User\Seller\PendingOrder;
use Livewire\Component;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackComponent extends Component
{    
    
    public $cart;

    public $order_id;

    // Billing
    public $firstname;
    public $lastname;
    public $email;
    public $company;
    public $address;

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {

        // Set cart
        $cart            = session('cart', []);

        // Set cart
        $this->cart      = $cart;
        
        // Set billing info
        $billing_info    = session()->get('invoice_billing', []);

        $this->firstname = $billing_info['firstname'];
        $this->lastname  = $billing_info['lastname'];
        $this->email     = $billing_info['email'];
        $this->company   = $billing_info['company'];
        $this->address   = $billing_info['address'];
        $this->order_id  = $billing_info['order_id'];

        // Get payment details
        $paymentDetails = Paystack::getPaymentData();

        // Check if payment succeeded
        if ( is_array($paymentDetails) && isset($paymentDetails['status']) && isset($paymentDetails['data']) && $paymentDetails['data']['status'] === 'success' )
        {
            
           // Place order 
           $this->place($paymentDetails);    

        } else {

            // Payment failed
            return redirect('checkout')->with('error', __('messages.t_error_paystack_payment_failed'));

        }
    }

    /**
     * Count total price of an item in cart
     *
     * @param string $id
     * @return integer
     */
    public function itemTotalPrice($id)
    {
        // Set empty var total price
        $total = 0;

        // Loop throug items in cart
        foreach ($this->cart as $key => $item) {
            
            // Check if item exists
            if ($item['id'] === $id) {
                
                // Get quantity
                $quantity = (int) $item['quantity'];

                // Sum upgrades total price
                if (is_array($item['upgrades']) && count($item['upgrades'])) {
                    
                    $total_upgrades_price = array_reduce($item['upgrades'], function($i, $obj)
                    {
                        // Calculate only selected upgrades
                        if ($obj['checked'] == true) {
                            return $i += $obj['price'];
                        } else {
                            return $i;
                        }

                    });

                } else {

                    // No upgrades selected
                    $total_upgrades_price = 0;

                }

                // Set new total
                $total = ($quantity * $item['gig']['price']) + ($total_upgrades_price * $quantity);

            }

        }

        // Return total price
        return $total;

    }


    /**
     * Calculate subtotal price
     *
     * @return integer
     */
    public function subtotal()
    {
        // Calculate subtotal
        $subtotal = $this->total();

        // Return subtotal
        return $subtotal;
    }


    /**
     * Calculate taxes
     *
     * @return integer
     */
    public function taxes()
    {
        // Get commission settings
        $settings = settings('commission');

        // Check if taxes enabled
        if ($settings->enable_taxes) {
            
            // Check if type of taxes percentage
            if ($settings->tax_type === 'percentage') {
                
                // Get tax amount
                $tax = bcmul($this->total(), $settings->tax_value) / 100;

                // Return tax amount
                return $tax;

            } else {
                
                // Fixed price
                $tax = $this->total() - $settings->tax_value;

                // Return tax
                return $tax;

            }

        } else {

            // Taxes not enabled
            return 0;

        }
    }


    /**
     * Calculate total price
     *
     * @return integer
     */
    public function total()
    {
        // Set total empty variable
        $total = 0;

        // Loop through items in cart
        foreach ($this->cart as $key => $item) {
            
            // Update total price
            $total += $this->itemTotalPrice($item['id']);

        }

        // Return total price
        return $total;
    }


    /**
     * Calculate commission
     *
     * @param string $price
     * @return integer
     */
    public function commission($price)
    {
        // Get settings
        $settings = settings('commission');

        // Commission percentage
        if ($settings->commission_type === 'percentage') {
            
            // Calculate commission
            $commission = $settings->commission_value * $price / 100;

        } else {

            // Fixed amount
            $commission = $settings->commission_value;

        }

        // Return commission
        return $commission;
    }


    /**
     * Place order now
     *
     * @return void
     */
    public function place($payment)
    {
        try {

            // Get commission settings
            $settings              = settings('commission');

            // Set unique id for this order
            $uid                   = $this->order_id;

            // Get buyer id
            $buyer_id              = auth()->id();

            // Count taxes amount
            $taxes                 = $this->taxes();

            // Count subtotal amount
            $subtotal              = $this->subtotal();

            // Count total amount
            $total                 = $this->total() + $taxes;

            // Save order
            $order                 = new Order();
            $order->uid            = $uid;
            $order->buyer_id       = $buyer_id;
            $order->total_value    = $total;
            $order->subtotal_value = $subtotal;
            $order->taxes_value    = $taxes;
            $order->save();

            // Now let's loop through items in this cart and save them
            foreach ($this->cart as $key => $item) {
                
                // Get gig
                $gig = Gig::where('uid', $item['id'])->active()->first();

                // Check if gig exists
                if ($gig) {
                    
                    // Get item total price
                    $item_total_price                   = $this->itemTotalPrice($item['id']);

                    // Calculate commission first
                    $commisssion                        = $settings->commission_from === 'orders' ? $this->commission($item_total_price) : 0;

                    // Save order item
                    $order_item                         = new OrderItem();
                    $order_item->uid                    = uid();
                    $order_item->order_id               = $order->id;
                    $order_item->gig_id                 = $gig->id;
                    $order_item->owner_id               = $gig->user_id;
                    $order_item->quantity               = (int) $item['quantity'];
                    $order_item->has_upgrades           = is_array($item['upgrades']) && count($item['upgrades']) ? true : false;
                    $order_item->total_value            = $item_total_price;
                    $order_item->profit_value           = $item_total_price - $commisssion;
                    $order_item->commission_value       = $commisssion;
                    $order_item->save();

                    // Check if this item has upgrades
                    if ( is_array($item['upgrades']) && count($item['upgrades']) ) {
                        
                        // Loop through upgrades
                        foreach ($item['upgrades'] as $index => $upg) {
                            
                            // Get upgrade
                            $upgrade = GigUpgrade::where('uid', $upg['id'])->where('gig_id', $gig->id)->first();

                            // Check if upgrade exists
                            if ($upgrade) {
                                
                                // Save item upgrade
                                $order_item_upgrade             = new OrderItemUpgrade();
                                $order_item_upgrade->item_id    = $order_item->id;
                                $order_item_upgrade->title      = $upgrade->title;
                                $order_item_upgrade->price      = $upgrade->price;
                                $order_item_upgrade->extra_days = $upgrade->extra_days;
                                $order_item_upgrade->save();

                            }
                            
                        }

                    }

                    // Update seller pending balance
                    $gig->owner()->update([
                        'balance_pending' => $gig->owner->balance_pending + $order_item->profit_value
                    ]);

                    // Increment orders in queue
                    $gig->increment('orders_in_queue');

                    // Order item placed successfully
                    // Let's notify the seller about new order
                    $gig->owner->notify( (new PendingOrder($order_item))->locale(config('app.locale')) );

                    // Send notification
                    notification([
                        'text'    => 't_u_received_new_order_seller',
                        'action'  => url('seller/orders/details', $order_item->uid),
                        'user_id' => $order_item->owner_id
                    ]);

                }

            }

            // Save invoice
            $invoice                 = new OrderInvoice();
            $invoice->order_id       = $order->id;
            $invoice->payment_method = 'paystack';
            $invoice->payment_id     = $payment['data']['id'];
            $invoice->firstname      = clean($this->firstname);
            $invoice->lastname       = clean($this->lastname);
            $invoice->email          = clean($this->email);
            $invoice->company        = $this->company ? clean($this->company) : null;
            $invoice->address        = clean($this->address);
            $invoice->status         = 'paid';
            $invoice->save();

            // Update user balance
            auth()->user()->update([
                'balance_purchases' => $total
            ]);

            // Now everything succeeded
            // Let's empty the cart
            session()->forget('cart');

            // Now let's notify the buyer that his order has been placed
            auth()->user()->notify( (new OrderPlaced($order, $total))->locale(config('app.locale')) );

            // Forget billing info
            session()->forget('invoice_billing');

            // Submit required files
            return redirect('account/orders')->with('message', __('messages.t_u_have_send_reqs_asap_to_seller'));

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->dispatchBrowserEvent('alert',[
                "message" => __('messages.t_toast_form_validation_error'),
                "type"    => "error"
            ]);

            throw $e;

        } catch (\Throwable $th) {
            
            // Validation error
            $this->dispatchBrowserEvent('alert',[
                "message" => $th->getMessage(),
                "type"    => "error"
            ]);

        }
    }
   
}
