<?php

namespace App\Http\Livewire\Main\Account\Projects\Options;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\ProjectMilestone;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Notifications\User\Freelancer\EmployerFundedMilestone;
use App\Notifications\User\Freelancer\EmployerReleasedMilestone;
use App\Http\Validators\Main\Account\Projects\Employer\MilestoneValidator;
use App\Models\ProjectRevision;
use App\Models\ProjectBid;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MilestonesComponent extends Component
{
    use SEOToolsTrait, Actions;
    
    public $project;
    public $paid_amount;
    public $payments_in_progress;
    public $expected_delivery_date;

    // Milestone form
    public $milestone_amount;
    public $milestone_description;
    
    // Project revision form
    //New Functionality
    public $reject_reason;
    
    public $projectId;

    public $showRevisionModal = false;
    public $revisedAmount;
    public $pdescription;
    
    public $proposedCost;
    public $proposedDays;
    
    public $buyerRequestedRevision = false;
    public $buyerRevisionDescription = '';
    public $project_Id;
    public $projectUId;
    
    public $previousRevisionStatus;
    
    public $amount;
    public $days;
    public $revDescription;
    public $revStatus;
  //  public $buyer_requested_revision;


    

    /**
     * Init component
     *
     * @param string $id
     * @return void
     */
    public function mount($id)
    {
        // Get project
        $project                    = Project::where('uid', $id)
                                            ->whereHas('awarded_bid', function($query) {
                                                return $query->where('is_freelancer_accepted', true);
                                            })
                                            ->where('user_id', auth()->id())
                                            ->with('awarded_bid')
                                            ->firstOrFail();

        // Set project
        $this->project              = $project;

        // Calculate paid amount
        $this->paid_amount          = $project->milestones->where('status', 'paid')->sum('amount');

        // Calculate payments in progress
        $this->payments_in_progress = $project->milestones->whereIn('status', ['funded', 'request'])->sum('amount');

        // Get awarded bid
        $awarded_bid                = $project->awarded_bid;

        // Set expected delivery date
        try {

            // Convert date
            $format_date                  = new Carbon($awarded_bid->freelancer_accepted_date, config('app.timezone'));

            // Set expected delivery time
            $this->expected_delivery_date = $format_date->addDays($awarded_bid->days);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->expected_delivery_date = null;

        }
        
        //New Function
        // Set $buyerRequestedRevision based on the project's revision status
        $this->buyerRequestedRevision = ProjectRevision::where('project_id', $project->id)
        ->where('created_by', 'freelancer')
        ->where('status', ['requested', 'rejected', 'approved'])
        ->exists();
        
        // Debugging: Output the value of $this->buyerRequestedRevision to the Laravel log
        //\Log::info('buyerRequestedRevision: ' . ($this->buyerRequestedRevision ? 'true' : 'false'));
        
        if ($project) {
            // Retrieve the bid details from the project_bids table
            $projectRev = ProjectRevision::where('project_id', $project->id)->first();
    
            // Check if the project bid exists
            if ($projectRev) {
                $this->amount = $projectRev->amount;
                $this->days = $projectRev->days;
                $this->revDescription = $projectRev->description;
                $this->revStatus = $projectRev->status;
            } else {
                // Set default values if the bid doesn't exist
                $this->amount = null;
                $this->days = null;
                $this->revDescription = null;
            }
        }
        
    }


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        // SEO
        $separator   = settings('general')->separator;
        $title       = __('messages.t_milestone_payments') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
        $ogimage     = src( settings('seo')->ogimage );

        $this->seo()->setTitle( $title );
        $this->seo()->setDescription( $description );
        $this->seo()->setCanonical( url()->current() );
        $this->seo()->opengraph()->setTitle( $title );
        $this->seo()->opengraph()->setDescription( $description );
        $this->seo()->opengraph()->setUrl( url()->current() );
        $this->seo()->opengraph()->setType('website');
        $this->seo()->opengraph()->addImage( $ogimage );
        $this->seo()->twitter()->setImage( $ogimage );
        $this->seo()->twitter()->setUrl( url()->current() );
        $this->seo()->twitter()->setSite( "@" . settings('seo')->twitter_username );
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle( $title );
        $this->seo()->jsonLd()->setDescription( $description );
        $this->seo()->jsonLd()->setUrl( url()->current() );
        $this->seo()->jsonLd()->setType('WebSite');

        return view('livewire.main.account.projects.options.milestones', [
            'payments' => $this->payments
        ])->extends('livewire.main.layout.app')->section('content');
    }


    /**
     * Get milestone payments
     *
     * @return object
     */
    public function getPaymentsProperty()
    {
        return ProjectMilestone::where('project_id', $this->project->id)
                                ->latest()
                                ->paginate(42);
    }


    /**
     * Milestone payment
     *
     * @param string $id
     * @return void
     */
    public function details($id)
    {
        try {
            
            // Get milestone payment
            $payment = ProjectMilestone::where('project_id', $this->project->id)
                                        ->where('uid', $id)
                                        ->firstOrFail();

            // Confirm dialog
            $this->dialog()->confirm([
                'title'          => '<h1 class="text-base font-bold tracking-wide">'. __('messages.t_milestone_payment_details') .'</h1>',
                'description'    => "<div class='dark:text-zinc-300'>". clean(nl2br($payment->description)) ."</div>",
                'icon'           => "document-text",
                'iconColor'      => "text-slate-500 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-slate-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'color'  => 'secondary'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Create a milestone payment
     *
     * @return mixed
     */
    public function confirmCreate()
    {
        try {
            
            // Validate form
            MilestoneValidator::validate($this);

            // Project must be active
            if (!in_array($this->project->status, ['active', 'under_development', 'pending_final_review'])) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_u_cannot_create_milestones_for_this_project'),
                    'icon'        => 'error'
                ]);

                return;

            }

            // Check if employer has this money
            if (convertToNumber($this->milestone_amount) > convertToNumber(auth()->user()->balance_available)) {
                
                // Employer does not have money to create a milestone
                $this->dialog()->confirm([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">'. __('messages.t_insufficient_funds_in_your_account') .'</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                // Reset form
                $this->reset(['milestone_amount', 'milestone_description']);

                // Close modal
                $this->dispatchBrowserEvent('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

                return;

            }

            // Set amount to paid to freelancer
            $milestone_amount = convertToNumber($this->milestone_amount);

            // Get projects settings
            $settings         = settings('projects');

            // Check commission type
            if ($settings->commission_type === 'fixed') {
                
                // Set employer commission
                $employer_commission = convertToNumber($settings->commission_from_publisher);

            } else {

                // Calculate commission
                $employer_commission = (convertToNumber($settings->commission_from_publisher) / 100) * $milestone_amount;

            }

            // Show confirmation dialog
            $this->dialog()->confirm([
                'title'          => '<h1 class="text-base font-bold tracking-wide">'. __('messages.t_confirm_milestone_payment') .'</h1>',
                'description'    => "<div class='leading-relaxed'>" . __('messages.t_pls_review_ur_milestone_payment_details') . "<br></div>
                <div class='rounded border dark:border-secondary-600 my-8'>
                <dl class='divide-y divide-gray-200 dark:divide-gray-600'>
                    <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>". __('messages.t_the_amount_to_be_paid_to_freelancer') ."</dt>
                        <dd class='text-sm font-semibold text-zinc-900 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>". money($milestone_amount, settings('currency')->code, true) ."</dd>
                    </div>  
                    <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>". __('messages.t_milestone_employer_fee_name') ."</dt>
                        <dd class='text-sm font-semibold text-green-600 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>+ ". money(convertToNumber($employer_commission), settings('currency')->code, true) ."</dd>
                    </div>  
                    <div class='grid grid-cols-3 gap-4 py-3 px-4 bg-gray-100/60 dark:bg-secondary-700 rounded-b'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-400 ltr:text-left rtl:text-right'>". __('messages.t_total') ."</dt>
                        <dd class='text-sm font-semibold text-zinc-900 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>". money($milestone_amount + convertToNumber($employer_commission), settings('currency')->code, true) ."</dd>
                    </div>  
                </dl>
                </div>
                ",
                'icon'           => "shield-check",
                'iconColor'      => "text-slate-500 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-slate-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'method' => 'create',
                    'color'  => 'secondary'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);

            // Close modal
            $this->dispatchBrowserEvent('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Create a milestone payment
     *
     * @return mixed
     */
    public function create()
    {
        try {
            
            // Validate form
            MilestoneValidator::validate($this);

            // Project must be active
            if (!in_array($this->project->status, ['active', 'under_development', 'pending_final_review'])) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_u_cannot_create_milestones_for_this_project'),
                    'icon'        => 'error'
                ]);

                return;

            }

            // Check if employer has this money
            if (convertToNumber($this->milestone_amount) > convertToNumber(auth()->user()->balance_available)) {
                
                // Employer does not have money to create a milestone
                $this->dialog()->confirm([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">'. __('messages.t_insufficient_funds_in_your_account') .'</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                // Reset form
                $this->reset(['milestone_amount', 'milestone_description']);

                // Close modal
                $this->dispatchBrowserEvent('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

                return;

            }

            // Set amount to paid to freelancer
            $milestone_amount = convertToNumber($this->milestone_amount);

            // Get projects settings
            $settings         = settings('projects');

            // Check commission type
            if ($settings->commission_type === 'fixed') {
                
                // Set employer commission
                $employer_commission   = convertToNumber($settings->commission_from_publisher);

                // Set freelancer commission
                $freelancer_commission = convertToNumber($settings->commission_from_freelancer);

            } else {

                // Calculate commission
                $employer_commission   = (convertToNumber($settings->commission_from_publisher) / 100) * $milestone_amount;
                
                // Set freelancer commission
                $freelancer_commission = (convertToNumber($settings->commission_from_freelancer) / 100) * $milestone_amount;

            }

            // Set total amount to be taken from the employer
            $total_amount_from_employer       = convertToNumber($this->milestone_amount) + convertToNumber($employer_commission);

            // Create new milestone
            $milestone                        = new ProjectMilestone();
            $milestone->uid                   = uid();
            $milestone->project_id            = $this->project->id;
            $milestone->created_by            = 'employer';
            $milestone->employer_id           = auth()->id();
            $milestone->amount                = $this->milestone_amount;
            $milestone->employer_commission   = $employer_commission;
            $milestone->freelancer_commission = $freelancer_commission;
            $milestone->description           = clean($this->milestone_description);
            $milestone->status                = 'funded';
            $milestone->save();

            // Let's update user available balance
            User::where('id', auth()->id())->update([
                'balance_available' => convertToNumber(auth()->user()->balance_available) - $total_amount_from_employer
            ]);

            // Send a notification to the freelancer
            $this->project->awarded_bid->user->notify(new EmployerFundedMilestone($milestone));

            // Calculate pending funds
            $this->calculatePendingFunds();
            $this->calculatePaidFunds();

            // Mark project as pending final reviews
            if ($this->payments_in_progress >= convertToNumber($this->project->awarded_bid->amount)) {
                
                // Update project
                $this->project->status = 'pending_final_review';
                $this->project->save();

            }

            // Reset form
            $this->reset(['milestone_amount', 'milestone_description']);

            // Close modal
            $this->dispatchBrowserEvent('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

            // Refresh project
            $this->project->refresh();

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_milestone_created_success'),
                'icon'        => 'success'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Confirm depositing amount
     *
     * @param string $id
     * @return void
     */
    public function confirmPay($id)
    {
        try {
            
            // Get milestone payment
            $payment = ProjectMilestone::where('project_id', $this->project->id)
                                        ->where('status', 'request')
                                        ->where('uid', $id)
                                        ->firstOrFail();

            // Check if user has the amount to paid
            if (( convertToNumber($payment->amount) + convertToNumber($payment->employer_commission) ) > convertToNumber(auth()->user()->balance_available)) {
                
                // Employer does not have money to create a milestone
                $this->dialog()->confirm([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">'. __('messages.t_insufficient_funds_in_your_account') .'</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                return;

            }

            // Confirm dialog
            $this->dialog()->confirm([
                'title'          => '<h1 class="text-base font-bold tracking-wide">'. __('messages.t_deposit_funds') .'</h1>',
                'description'    => __('messages.t_u_will_be_depositing_this_amount_employer_milestone'),
                'icon'           => "shield-check",
                'iconColor'      => "text-slate-500 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-slate-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'method' => 'pay',
                    'params' => $payment->uid,
                    'color'  => 'secondary'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Deposit this amount
     *
     * @param string $id
     * @return void
     */
    public function pay($id)
    {
        try {
            
            // Get milestone payment
            $payment         = ProjectMilestone::where('project_id', $this->project->id)
                                                ->where('status', 'request')
                                                ->where('uid', $id)
                                                ->firstOrFail();

            // Check if user has the amount to paid
            if (( convertToNumber($payment->amount) + convertToNumber($payment->employer_commission) ) > convertToNumber(auth()->user()->balance_available)) {
                
                // Employer does not have money to create a milestone
                $this->dialog()->confirm([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">'. __('messages.t_insufficient_funds_in_your_account') .'</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                return;

            }

            // Update milestone status
            $payment->status = 'funded';
            $payment->save();

            // Let's update user's amount
            auth()->user()->update([
                'balance_available' => convertToNumber(auth()->user()->balance_available) - ( convertToNumber($payment->amount) + convertToNumber($payment->employer_commission) )
            ]);

            // Calculate pending funds
            $this->calculatePendingFunds();
            $this->calculatePaidFunds();

            // Mark project as pending final reviews
            if ($this->payments_in_progress >= convertToNumber($this->project->awarded_bid->amount)) {
                
                // Update project
                $this->project->status = 'pending_final_review';
                $this->project->save();

            }

            // Send notification to the freelancer
            notification([
                'text'    => 't_username_has_deposited_amount_in_project',
                'action'  => url('seller/projects/milestones', $this->project->uid),
                'user_id' => $this->project->awarded_freelancer_id,
                'params'  => [
                    'username' => $this->project->client->username,
                    'amount'   => money(convertToNumber($payment->amount), settings('currency')->code, true)->format()
                ]
            ]);

            // Send notification by email
            $this->project->awarded_bid->user->notify(new EmployerFundedMilestone($payment));

            // Refresh project
            $this->project->refresh();

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_toast_operation_success'),
                'icon'        => 'success'
            ]);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Confirm releasing amount
     *
     * @param string $id
     * @return void
     */
    public function confirmRelease($id)
    {
        try {
            
            // Get milestone payment
            $payment = ProjectMilestone::where('project_id', $this->project->id)
                                                ->where('status', 'funded')
                                                ->where('uid', $id)
                                                ->firstOrFail();

            // Confirm dialog
            $this->dialog()->confirm([
                'title'          => '<h1 class="text-base font-bold tracking-wide">'. __('messages.t_confirm_release_of_payment_for_username', ['username' => $this->project->awarded_bid->user->username]) .'</h1>',
                'description'    => __('messages.t_pls_ensure_that_u_are_satisfied_with_work_freelancer', ['username' => $this->project->awarded_bid->user->username]),
                'icon'           => "shield-check",
                'iconColor'      => "text-amber-600 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-amber-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'method' => 'release',
                    'params' => $payment->uid,
                    'color'  => 'warning'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Release milestone payment
     *
     * @param int $id
     * @return mixed
     */
    public function release($id)
    {
        try {
            
            // Get milestone payment
            $milestone         = ProjectMilestone::where('project_id', $this->project->id)
                                                    ->where('status', 'funded')
                                                    ->where('uid', $id)
                                                    ->firstOrFail();

            // Set freelancer
            $freelancer        = $milestone->project->awarded_bid->user;

            // Set amount to give to freelancer
            $amount            = convertToNumber($milestone->amount) - convertToNumber($milestone->freelancer_commission);

            // Release this payment
            $milestone->status = 'paid';
            $milestone->save();

            // Let's give freelancer his money
            User::where('id', $freelancer->id)
                ->update([
                    'balance_available' => convertToNumber($freelancer->balance_available) + convertToNumber($amount)
                ]);

            // Calculate paid amount
            $this->calculatePaidFunds();
            $this->calculatePendingFunds();

            // Mark project as completed if employer paid everything
            if ($this->paid_amount >= $milestone->project->awarded_bid->amount) {
                
                // Update project
                $this->project->status = 'completed';
                $this->project->save();

            }

            // Send notification to freelancer via email
            $freelancer->notify(new EmployerReleasedMilestone($milestone));

            // Send notification in web app
            notification([
                'text'    => 't_username_has_released_amount_in_project',
                'action'  => url('seller/projects/milestones', $this->project->uid),
                'user_id' => $freelancer->id,
                'params'  => [
                    'username' => $this->project->client->username,
                    'amount'   => money($amount, settings('currency')->code, true)->format()
                ]
            ]);

            // Refresh project
            $this->project->refresh();

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_milestone_payment_released_success'),
                'icon'        => 'success'
            ]);

        } catch (\Throwable $th) {
            
            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }


    /**
     * Go to deposit page
     *
     * @return void
     */
    public function deposit()
    {
        // Go to deposit page
        return redirect('account/deposit');
    }


    /**
     * Calculate paid funds
     *
     * @return void
     */
    private function calculatePaidFunds()
    {
        // Calculate amount
        $amount            = ProjectMilestone::where('project_id', $this->project->id)
                                            ->whereIn('status', ['paid'])
                                            ->sum('amount');

        // Set value value
        $this->paid_amount = convertToNumber($amount);
    }


    /**
     * Calculate pending funds
     *
     * @return void
     */
    private function calculatePendingFunds()
    {
        // Calculate amount
        $amount                     = ProjectMilestone::where('project_id', $this->project->id)
                                                        ->whereIn('status', ['request', 'funded'])
                                                        ->sum('amount');

        // Set value
        $this->payments_in_progress = convertToNumber($amount);
    }
    
    
    //New Function
    public function loadProject($projectUid)
    {
        // Load the project based on the $projectUid
        $project = Project::where('uid', $projectUid)
            ->where('awarded_freelancer_id', auth()->id())
            ->whereIn('status', ['under_development']) // Modify the project statuses as needed
            ->whereHas('awarded_bid', function($query) {
                return $query->where('user_id', auth()->id())
                    ->where('is_freelancer_accepted', true)
                    ->where('status', 'active');
            })
            ->first();
    
        if ($project) {
            // Retrieve the bid details from the project_revision table
            $projectRev = ProjectRevision::where('project_id', $project->id)->first();
    
            // Check if the project revision exists
            if ($projectRev) {
                $this->amount = $projectRev->amount;
                $this->days = $projectRev->days;
                $this->revDescription = $projectRev->description;
                
                // Add some debug statements here
              //  dd($this->amount, $this->days, $this->revDescription);
            } else {
                // Set default values if the revision doesn't exist
                $this->amount = null;
                $this->days = null;
                $this->revDescription = null;
            }
        }
    }
     




    public function showRevisionModal()
    {
        $this->showRevisionModal = true;
    }


    public function submitRevision($id, $uid)
    {
        try {
            // Validation rules for Proposed Cost and Proposed Days (add your own validation logic)
            $this->validate([
                'proposedCost' => 'required|numeric',
                'proposedDays' => 'required|numeric',
                'buyerRevisionDescription' => 'required|string',
            ], [
                'proposedCost.required' => 'The proposed cost is required.',
                'proposedCost.numeric' => 'The proposed cost must be a numeric value.',
                'proposedDays.required' => 'The proposed days are required.',
                'proposedDays.numeric' => 'The proposed days must be a numeric value.',
                'buyerRevisionDescription.required' => 'Add description of this Amount Revision',
            ]);
            
            // Check if the freelancer has already initiated a revision request for this project
            $existingRevision = ProjectRevision::where('project_id', $id)
                ->where('created_by', 'employer')
                ->whereIn('status', ['request', 'rejected']) // Consider only 'request' and 'rejected' statuses
                ->first();
    
            if ($existingRevision) {
                // Display the previous status of the revision request
                // You can use a variable to store and display the status in your blade template
                $this->previousRevisionStatus = $existingRevision->status;
    
                // Optionally, you can notify the freelancer about the previous status
                $this->notification([
                    'title' => __('messages.t_info'),
                    'description' => 'You already have a revision request with status: ' . $existingRevision->status,
                    'icon' => 'info',
                ]);
    
                return;
            }
        
            // Get project where awarded_freelancer_id is not empty (not null) and uid is $uid
            $project = Project::where('uid', $uid)
                ->whereNotNull('awarded_freelancer_id')
                ->first();

            
           // Log::info('Retrieved Project: ' . print_r($project, true));

            // Retrieve the corresponding ProjectBid object for the awarded project
            $projectBid = ProjectBid::where('project_id', $id)
                ->where('is_awarded', true)
                ->first();
                
           // Log::info('Retrieved Project Bid: ' . print_r($projectBid, true));
        
        
            if (!$projectBid) {
                // Handle the case where the awarded project bid is not found.
                // Log an error message for debugging purposes.
                Log::error('Awarded project bid not found when requesting revision.');
                $this->notification([
                    'title' => __('messages.t_error'),
                    'description' => 'Awarded project bid not found when requesting revision', // Customize the error message
                    'icon' => 'error'
                ]);
                return;
            }
        
            // Insert the revision data into the project_revision table
            ProjectRevision::create([
                'uid'   => $projectBid->uid,
                'project_id' => $projectBid->project_id,
                'created_by' => 'employer',
                'freelancer_id' => $project->user_id,
                'employer_id'   => $projectBid->user_id,
                'amount' => $this->proposedCost,
                'days'   => $this-> proposedDays,
                'description' => $this->buyerRevisionDescription,
                'status' => 'requested',
            ]);
        
            // Notify the buyer about the revision request (you can implement this).
        
            // Reset form inputs and close the modal.
            $this->proposedCost = null;
            $this->proposedDays = null;
            $this->buyerRevisionDescription = null;
            $this->showRevisionModal = false;
            
            // Refresh the component
            $this->loadProject($this->project->uid);
        
            // Refresh the component to reflect the updated state.
            $this->notification([
                    'title' => __('messages.t_success'),
                    'description' => 'Project revise request sent', // Customize the success message
                    'icon' => 'success'
                ]);
            
            
        } catch (\Throwable $th) {
            
            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
               // 'description' => $th->getMessage(),
                'description' => 'You may revise the project cost only once.',
                'icon'        => 'error'
            ]);

        }
    }       



    // ...

    public function approveRevision($projectId, $projectUid)
    {
        try {
            // Ensure that the buyer has requested a revision
            if (!$this->buyerRequestedRevision) {
                return;
            }
    
            // Retrieve the project based on the provided UID
            $project = Project::where('uid', $projectUid)->first();
    
            if (!$project) {
                // Handle the case where the project does not exist
                // Log an error and return or show an error message
                Log::error('Project not found for UID: ' . $projectUid);
                return;
            }
    
            // Validate the buyer's revision description
            $validatedData = $this->validate([
                'buyerRevisionDescription' => 'required|string',
            ]);
    
            // Load the project revision data
            $projectRevision = ProjectRevision::where('project_id', $project->id)->first();
    
            if ($projectRevision) {
                // Update the project's status to "approved"
               // $project->status = 'approved';
              //  $project->save();
                $projectRevision->description=$validatedData['buyerRevisionDescription'];
                $projectRevision->status="approved";
                $projectRevision->save();
                
                // Update the corresponding bid with the revised amount and days
                $projectBid = $project->awarded_bid;
                $projectBid->amount = $projectRevision->amount;
                $projectBid->days = $projectRevision->days;
                $projectBid->message = $projectRevision->description;
                $projectBid->save();
            }
            
    
            // Notify the seller or show a confirmation message
            
            // Refresh the component to reflect the updated state.
            $this->notification([
                    'title' => __('messages.t_success'),
                    'description' => 'Project revise request has been approved', // Customize the success message
                    'icon' => 'success'
                ]);
    
            // Reset form inputs and close the modal.
            $this->buyerRevisionDescription = null;
            $this->buyerRequestedRevision = false;
            $this->showRevisionModal = false;
    
            // Refresh the component to reflect the updated state.
            $this->emit('refreshComponent');
        } catch (\Throwable $th) {
            // Log the error for debugging
            Log::error('Error in approveRevision: ' . $th->getMessage());
    
            // Handle errors if needed
            $this->notification([
                'title' => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon' => 'error'
            ]);
        }
    }



    public function rejectRevision($projectId, $projectUid)
    {
        try {
            // Ensure that the buyer has requested a revision
            if (!$this->buyerRequestedRevision) {
                return;
            }
            
            // Validate the buyer's revision description
            $validatedData = $this->validate([
                'buyerRevisionDescription' => 'required|string',
            ]);
    
            // Retrieve the project based on the provided UID
            $project = Project::where('uid', $projectUid)->first();
    
            if (!$project) {
                // Handle the case where the project does not exist
                // You can show an error message or log an error
                return;
            }
    
            // Update the Project Revision status to "rejected" and set the rejection description
            ProjectRevision::where('project_id', $project->id)
                ->where('created_by', 'freelancer')
                ->where('status', 'requested')
                ->update([
                    'status' => 'rejected',
                    'description' => $this->buyerRevisionDescription,
                ]);
    
            // Notify the seller or show a confirmation message
            // Refresh the component to reflect the updated state.
            $this->notification([
                    'title' => __('messages.t_success'),
                    'description' => 'Project revise request has been Rejected', // Customize the success message
                    'icon' => 'success'
                ]);
    
            // Reset form inputs and close the modal.
            $this->buyer_requested_revision = false;
            $this->buyerRevisionDescription = null;
            $this->showRevisionModal = false;
    
            // Refresh the component to reflect the updated state.
            $this->emit('refreshComponent');
        } catch (\Throwable $th) {
            // Handle errors if needed
            $this->notification([
                'title' => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon' => 'error'
            ]);
        }
    }    
    
    
    
}
