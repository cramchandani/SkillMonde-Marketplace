<?php

namespace App\Http\Livewire\Main\Seller\Projects;

use App\Models\Project;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Notifications\User\Employer\FreelancerAcceptedYourProject;
use App\Notifications\User\Employer\FreelancerRejectedYourProject;
use App\Models\ProjectRevision;
use App\Models\ProjectBid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectsComponent extends Component
{
    use WithPagination, SEOToolsTrait, Actions;

    public $reject_reason;
    
    public $project;
    public $projectId;

    public $showRevisionModal = false;
    public $revisedAmount;
    public $description;
    
    public $proposedCost;
    public $proposedDays;
    
    public $buyerRequestedRevision = false;
    public $buyerRevisionDescription = '';
    public $project_Id;
    public $projectUId;
    
    public $proposedCosting;
    public $proposedDuration;
    public $revDescription;
    public $revStatus;
    
    public $freelancerRequestedRevision;


    /**
     * Initialize component
     *
     * @return mixed
     */
    public function mount()
    {
        // Get settings
        $settings = settings('projects');

        // Check if this section enabled
        if (!$settings->is_enabled) {
        
            // Redirect to home page
            return redirect('/');

        }
        // Load the project
       // $this->loadProject($this->projectId);

    }


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        $project = Project::find($this->projectId);

        if ($this->project) {
            $this->buyerRequestedRevision = ProjectRevision::where('project_id', $this->project->id)
                ->where('created_by', 'employer')
                ->where('status', 'request')
                ->exists();
        } else {
            // Handle the case where $this->project is null
            $this->buyerRequestedRevision = false; // or set it to an appropriate default value
        }

            
        // SEO
        $separator   = settings('general')->separator;
        $title       = __('messages.t_awarded_projects') . " $separator " . settings('general')->title;
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

        return view('livewire.main.seller.projects.projects', [
            'projects' => $this->projects,
        ])->extends('livewire.main.seller.layout.app')->section('content');
    }


    /**
     * Get list of projects
     *
     * @return object
     */
    public function getProjectsProperty()
    {
        return Project::whereHas('bids', function($query) {
                            return $query->where('user_id', auth()->id())
                                        ->whereIsAwarded(true)
                                        ->whereStatus('active')
                                        ->latest('updated_at');
                        })
                        ->where('awarded_freelancer_id', auth()->id())
                        ->whereIn('status', ['active', 'completed', 'under_development', 'pending_final_review', 'incomplete', 'closed'])
                        ->latest('updated_at')
                        ->paginate(42);
    }


    /**
     * Reject this project
     *
     * @param string $id
     * @return mixed
     */
    public function reject($id)
    {
        try {
            
            // Get project
            $project  = Project::where('uid', $id)
                                ->whereStatus('active')
                                ->whereHas('awarded_bid', function($query) {
                                    return $query->whereUserId(auth()->id())
                                                ->whereIsFreelancerAccepted(false)
                                                ->whereStatus('active');
                                })->firstOrFail();

            // Check rejection reason
            if (!in_array($this->reject_reason, ['reason_1', 'reason_2', 'reason_3', 'reason_4', 'reason_5', 'reason_6', 'reason_7', 'reason_8'])) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_pls_select_rejection_reason'),
                    'icon'        => 'error'
                ]);

                // Return back
                return;

            }

            // Let's reject this project
            $project->awarded_bid->is_awarded                  = false;
            $project->awarded_bid->is_freelancer_accepted      = false;
            $project->awarded_bid->status                      = 'hidden';
            $project->awarded_bid->freelancer_rejection_reason = $this->reject_reason;
            $project->awarded_bid->freelancer_rejected_date    = now();
            $project->awarded_bid->save();

            // Send a notification to the employer
            $project->client->notify(new FreelancerRejectedYourProject($project, $project->awarded_bid));

            // Reset form
            $this->reset('reject_reason');

            // Close modal
            $this->dispatchBrowserEvent('close-modal', "modal-reject-project-container-$id");

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_freelancer_u_have_reject_this_project_success'),
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
     * Accept this project
     *
     * @param string $id
     * @return mixed
     */
    public function accept($id)
    {
        try {
            
            // Get project
            $project = Project::where('uid', $id)
                                ->whereStatus('active')
                                ->whereHas('awarded_bid', function($query) {
                                    return $query->whereUserId(auth()->id())
                                                ->whereIsFreelancerAccepted(false)
                                                ->whereStatus('active');
                                })->firstOrFail();

            // Let's accept this project
            $project->status                                = 'under_development';
            $project->save();

            // Update awarded bid
            $project->awarded_bid->is_freelancer_accepted   = true;
            $project->awarded_bid->freelancer_accepted_date = now();
            $project->awarded_bid->save();

            // Send a notification to the employer
            $project->client->notify(new FreelancerAcceptedYourProject($project, $project->awarded_bid));

            // Close modal
            $this->dispatchBrowserEvent('close-modal', "modal-accept-project-container-$id");

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_freelancer_u_have_accepted_this_project_success'),
                'icon'        => 'success'
            ]);

            // We have to redirect him to project overview section
            return redirect('seller/projects/milestones/' . $project->uid)->with('success', __('messages.t_awarded_projects_warning_msg'));

        } catch (\Throwable $th) {
            
            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }
    
    
    // New Function
public function loadProject($projectUid)
{
    // Load the project based on the $projectUid
    $project = Project::where('id', $projectUid)
        ->where('awarded_freelancer_id', auth()->id())
        ->whereIn('status', ['under_development'])
        ->whereHas('awarded_bid', function ($query) {
            return $query->where('user_id', auth()->id())
                ->where('is_freelancer_accepted', true)
                ->where('status', 'active');
        })
        ->first();

  //  Log::info('Project ID: ' . ($project ? $project->id : 'Not found'));

    if ($project) {
        // Retrieve the bid details from the project_revision table
        $projectRev = ProjectRevision::where('project_id', $project->id)
            ->where('created_by', 'freelancer')
            ->whereIn('status', ['requested', 'rejected', 'approved'])
            ->first();

        Log::info('Project Revision ID: ' . ($projectRev ? $projectRev->id : 'Not found'));

        if ($projectRev) {
            $this->proposedCosting = $projectRev->amount;
            $this->proposedDuration = $projectRev->days;
            $this->revDescription = $projectRev->description;
            $this->revStatus = $projectRev->status;
        } else {
            // Set default values if the revision doesn't exist
            $this->proposedCosting = null;
            $this->proposedDuration = null;
            $this->revDescription = null;
            $this->revStatus = null;
        }
    } else {
        // Set default values if the project doesn't exist
        $this->proposedCosting = null;
        $this->proposedDuration = null;
        $this->revDescription = null;
        $this->revStatus = null;
    }

    $this->projectId = $project->id ?? null;
    $this->project = $project;

    // Check if the freelancer has requested a revision
    $this->freelancerRequestedRevision = ProjectRevision::where('project_id', $this->projectId)
        ->where('created_by', 'freelancer')
        ->whereIn('status', ['requested', 'rejected', 'approved'])
        ->exists();
    
   // dd($this->freelancerRequestedRevision); // Debugging statement
}







    public function showRevisionModal()
    {
        $this->showRevisionModal = true;
    }


    public function revisionRevision($id, $uid)
    {
        try {
            // Validation rules for Proposed Cost and Proposed Days (add your own validation logic)
            $this->validate([
                'proposedCost' => 'required|numeric',
                'proposedDays' => 'required|numeric',
            ], [
                'proposedCost.required' => 'The proposed cost is required.',
                'proposedCost.numeric' => 'The proposed cost must be a numeric value.',
                'proposedDays.required' => 'The proposed days are required.',
                'proposedDays.numeric' => 'The proposed days must be a numeric value.',
            ]);
            
            // Check if the freelancer has already initiated a revision request for this project
            $existingRevision = ProjectRevision::where('project_id', $id)
                ->where('created_by', 'freelancer')
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
              //  Log::error('Awarded project bid not found when requesting revision.');
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
                'created_by' => 'freelancer',
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
                'description' => $th->getMessage(),
                'icon'        => 'error'
            ]);

        }
    }       


    /*
    // ...

    public function approveRevision($projectId, $projectUid)
    {
        try {
            // Ensure that the buyer has requested a revision
            if (!$this->buyer_requested_revision) {
                return;
            }
    
            // Retrieve the project based on the provided UID
            $project = Project::where('uid', $projectUid)->first();
    
            if (!$project) {
                // Handle the case where the project does not exist
                // You can show an error message or log an error
                return;
            }
    
            // Update the project's status to "approved"
            $project->status = 'approved';
            $project->save();
    
            // Update the corresponding bid with the revised amount and days
            $projectBid = $project->awarded_bid;
            $projectBid->amount = $this->proposedCost;
            $projectBid->days = $this->proposedDays;
            $projectBid->save();
    
            // Notify the seller or show a confirmation message
    
            // Reset form inputs and close the modal.
            $this->proposedCost = null;
            $this->proposedDays = null;
            $this->buyer_requested_revision = false;
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

    public function rejectRevision($projectId, $projectUid)
    {
        try {
            // Ensure that the buyer has requested a revision
            if (!$this->buyer_requested_revision) {
                return;
            }
    
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
                ->where('status', 'request')
                ->update([
                    'status' => 'rejected',
                    'description' => $this->buyerRevisionDescription,
                ]);
    
            // Notify the seller or show a confirmation message
    
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
    */


    
}