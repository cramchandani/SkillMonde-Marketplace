<div class="w-full" x-data="window.xRiqSKhIlmnKtWu">

    
    <div class="max-w-xl mx-auto mb-12 text-center block">
        <h1 class="text-xl md:text-2xl font-extrabold text-black dark:text-white">
            <?php echo e(__('messages.t_top_sellers')); ?>

        </h1>
        <p class="text-sm md:text-base text-gray-400 dark:text-gray-300 font-normal mt-2">
            <?php echo e(__('messages.t_hire_our_best_sellers')); ?>    
        </p>
    </div>
    <div class="max-w-xl mx-auto mb-12 text-center block">
        

    </div>
    
    <div class="row" style="max-width: 95%;margin: auto;">
      <div class="col-sm-12 col-md-3 col-lg-3 border p-2 rounded-md lg:block bg-white dark:bg-zinc-700 shadow-sm border-gray-100 dark:border-zinc-600 h-fit">
         
        <div x-data="{ open: true }" class="py-3">
            <h3 class="-my-3 flow-root bg-gray-50 dark:bg-zinc-700 px-4">
                <button @click="open = !open" type="button" class="py-3 w-full flex items-center justify-between text-sm text-gray-400 hover:text-gray-500 outline-none focus:outline-none">
                    <h4><span class="font-semibold text-xl text-gray-900"><?php echo e(__('messages.t_seller_skills')); ?></span></h4>
                    <span class="ltr:ml-6 rtl:mr-6 flex items-center">
                        <svg class="h-5 w-5" x-description="Expand icon, show/hide based on section open state. Heroicon name: solid/plus-sm" x-show="!(open)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path> </svg>
                        <svg class="h-5 w-5" x-description="Collapse icon, show/hide based on section open state. Heroicon name: solid/minus-sm" x-show="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="display: none;"> <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd"></path> </svg>
                    </span>
                </button>
            </h3>
            
            <div class="pt-6 px-4" x-show="open" wire:ignore>
                <div class="space-y-4 text-center">
                    <form wire:submit.prevent="applyFilters">
                        <ul>
                            <?php $__currentLoopData = $projectcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($projectcategory->skills) > 0): ?>
                                    <li class="text-left">
                                        <span class="category-title py-2">
                                            <i class="fa-solid fa-plus" style="padding-right: 5px;"></i>
                                            <?php echo e($projectcategory->name); ?>

                                        </span>
                                        <ul class="subcategories-list">
                                            <?php $__currentLoopData = $projectcategory->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectskill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <label class="form-check">
                                                        <input type="checkbox" wire:model="selectedSkills" id="selectedSkills_<?php echo e($projectskill->slug); ?>" name="projectskill[]" value="<?php echo e($projectskill->slug); ?>" class="form-check-input">
                                                        <?php echo e($projectskill->name); ?>

                                                    </label>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                     <button type="submit" wire:click="applyFilters" class="w-full text-[13px] btn-grad-filter secondary-btn">Filter</button>
                     <button wire:click="clearSkills" class="text-xs text-gray-700 hover:text-purple-900">Clear Skills</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div x-data="{ open: false }" class="py-3">
            <h3 class="-my-3 flow-root bg-gray-50 dark:bg-zinc-700 px-4">
                <button @click="open = !open" type="button" class="py-3 w-full flex items-center justify-between text-sm text-gray-400 hover:text-gray-500 outline-none focus:outline-none">
                    <h4><span class="font-semibold text-xl text-gray-900">Country</span></h4>
                    <span class="ltr:ml-6 rtl:mr-6 flex items-center">
                        <svg class="h-5 w-5" x-description="Expand icon, show/hide based on section open state. Heroicon name: solid/plus-sm" x-show="!(open)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path> </svg>
                        <svg class="h-5 w-5" x-description="Collapse icon, show/hide based on section open state. Heroicon name: solid/minus-sm" x-show="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="display: none;"> <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd"></path> </svg>
                    </span>
                </button>
            </h3>
            
            <div class="pt-6 px-4" x-show="open" wire:ignore>
                <div class="space-y-4 text-center">
                    <form wire:submit.prevent="applyCountriesFilter">
                        <div class="relative w-full shadow-sm rounded-md">
                            <select 
                                wire:model="selectedCountries" 
                                class="focus:ring-primary-600 focus:border-primary-600 border-gray-300 border text-gray-900 text-sm rounded-md font-medium block w-full ltr:pr-12 rtl:pl-12 p-4 placeholder:font-normal dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                multiple>
                                <?php
                                    $countriesCount = $this->calculateCountryUserCounts();
                                ?>
                               
                                <?php $__currentLoopData = $countriesCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $country = $countries->where('id', $key)->first();
                                        $countryId = $country->id;
                                    ?>
                                    <option value="<?php echo e($countryId); ?>"><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            
                            
                            <div class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center ltr:pr-3 rtl:pl-3">
                                <svg class="w-5 h-5 text-gray-400" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-4.546-5.084A5.986 5.986 0 004 10a5.986 5.986 0 001.454 3.916A5 5 0 0110 13a5 5 0 015 5 5 5 0 01-4.546-2.916A5.986 5.986 0 0010 16a5.986 5.986 0 00-1.454-3.916z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-[13px] btn-grad-filter secondary-btn">Apply Filter</button>
                        <button wire:click="clearCountries" class="text-xs text-gray-700 hover:text-purple-900">Clear Countries</button>
                    </form>
        
                </div>
            </div>
        </div>
        
        <div x-data="{ open: false }" class="py-3">
            <h3 class="-my-3 flow-root bg-gray-50 dark:bg-zinc-700 px-4">
                <button @click="open = !open" type="button" class="py-3 w-full flex items-center justify-between text-sm text-gray-400 hover:text-gray-500 outline-none focus:outline-none">
                    <h4><span class="font-semibold text-xl text-gray-900">Filter Budget</span></h4>
                    <span class="ltr:ml-6 rtl:mr-6 flex items-center">
                        <svg class="h-5 w-5" x-description="Expand icon, show/hide based on section open state. Heroicon name: solid/plus-sm" x-show="!(open)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path> </svg>
                        <svg class="h-5 w-5" x-description="Collapse icon, show/hide based on section open state. Heroicon name: solid/minus-sm" x-show="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="display: none;"> <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 1100 2H6a1 1 0 01-1-1z" clip-rule="evenodd"></path> </svg>
                    </span>
                </button>
            </h3>
            <div class="pt-6 px-4" x-show="open" wire:ignore>
                <div class="space-y-4 text-center">
                    <form wire:submit.prevent="applyBudget">
                        <div class="mb-4 text-left">
                            <label for="budget_min" class="block text-sm font-medium text-gray-700">Minimum Budget</label>
                            <input type="text" wire:model.defer="budget_min" id="budget_min" name="budget_min" value="0" class="mt-1 p-2 border rounded-md w-full">
                        </div>
                        <div class="mb-4 text-left">
                            <label for="budget_max" class="block text-sm font-medium text-gray-700">Maximum Budget</label>
                            <input type="text" wire:model.defer="budget_max" id="budget_max" name="budget_max" value="5000" class="mt-1 p-2 border rounded-md w-full">
                        </div>
                        <button type="submit" class="w-full text-[13px] btn-grad-filter secondary-btn" wire:loading.attr="disabled" wire:target="applyBudget" :disabled="!budget_min || !budget_max">
                            Filter
                        </button>
                        <button wire:click="clearBudget" class="text-xs text-gray-700 hover:text-purple-900">Clear Budget</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
      
      <div class="col-sm-12 col-md-9 col-lg-9">
          
        
        
        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <div class="card card-primary gap-6 pt-2 mb-4 shadow-sm border-gray-100 dark:border-zinc-600 h-fit">
            <div class="flex flex-col md:flex-row md:items-center" style="padding-left: 10px;">
                
                <div class="mx-auto md:mx-0 md:mr-6 mb-4 md:mb-0 flex-shrink-0">
                    <img class="w-28 h-28 rounded-full object-cover lazy border-gray shadow-md"
                         src="<?php echo e(placeholder_img()); ?>"
                         data-src="<?php echo e(src($seller->avatar)); ?>"
                         alt="<?php echo e($seller->username); ?>"
                         style="margin-right: 15px;">
                </div>
    
                <div class="flex-1">
                    
                    <div class="flex items-center mb-2">
                        <h3 class="mt-4 md:mt-0 text-gray-900 dark:text-gray-200 text-base font-bold tracking-wider">
                            <a href="<?php echo e(url('profile', $seller->username)); ?>"><?php echo e($seller->fullname); ?></a>
                        </h3>
                        <?php if($seller->status === 'verified'): ?>
                            <img data-tooltip-target="tooltip-account-verified-<?php echo e($seller->id); ?>" class="h-4 w-4 ml-2 mt-4" src="<?php echo e(url('public/img/auth/verified-badge.svg')); ?>" alt="<?php echo e(__('messages.t_account_verified')); ?>">
                            <div id="tooltip-account-verified-<?php echo e($seller->id); ?>" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <?php echo e(__('messages.t_account_verified')); ?>

                            </div>
                        <?php else: ?> 
                            <img data-tooltip-target="tooltip-account-verified-<?php echo e($seller->id); ?>" class="h-4 w-4 ml-2 mt-4" src="<?php echo e(url('public/img/auth/verified-email.png')); ?>" alt="<?php echo e(__('messages.t_email_verified')); ?>">
                            <div id="tooltip-account-verified-<?php echo e($seller->id); ?>" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <?php echo e(__('messages.t_email_verified')); ?>

                            </div>
                        <?php endif; ?>
                        <strong class="text-sm font-medium mt-4 ml-2 px-2 bg-purple-50 rounded-full border" style="color:<?php echo e($seller->level->level_color); ?>"><?php echo e($seller->level->title); ?></strong>
                    </div>
                    
                    <h4 class="mt-1 text-gray-900 dark:text-gray-200 text-sm font-bold">
                        <?php echo e($seller->headline); ?>

                    </h4>
                    <p class="mt-1 text-gray-900 dark:text-gray-200 text-sm font-medium">
                        <?php echo e(Str::limit($seller->description, 130, '...')); ?>

                    </p>
                    
                    
                    <p class="mt-1 text-gray-500 text-sm">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        <?php echo e($seller->country ? $seller->country->name : ''); ?>

                    </p>
    
                    
                   
                    <div class="mt-2 text-center">
                        <?php if($seller && $seller->skills && count($seller->skills) > 0): ?>
                            <h5 class="font-semibold text-gray-700 bg-gray-200 rounded px-2 py-1 mb-2"><?php echo e(__('messages.t_expertise')); ?></h5>
                            <ul class="inline-flex flex-wrap gap-2">
                                <?php $__currentLoopData = $seller->skills->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="text-white btn-grad-skills secondary-btn rounded-full text-sm font-medium capitalize">
                                        <a href="<?php echo e(url('hire', $skill->slug)); ?>" class="block px-3 py-1 hover:text-gray-100 capitalize"><?php echo e($skill->name); ?></a>
                                    </li>
                                    <?php if(!$loop->last): ?>
                                        <li class="py-1 text-gray-700 font-extrabold">&#183;</li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                                <?php if(count($seller->skills) > 4): ?>
                                    <li class="py-1 px-3 bg-gray-200 rounded-full text-sm font-medium text-gray-700 border border-purple-700">
                                        <a href="<?php echo e(url('profile', $seller->username)); ?>#skills">+<?php echo e(count($seller->skills) - 4); ?> more skills...</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    
                    <div class="mt-3">
                        <?php if($seller && $seller->languages && count($seller->languages) > 0): ?>
                        <span class="font-semibold text-gray-700 bg-gray-200 rounded px-2 py-1 mr-2"><?php echo e(__('messages.t_speaking_languages')); ?>:</span>
                        <ul class="inline-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $seller->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-1 px-3 bg-gray-200 rounded-full text-sm font-medium text-primary border-primary">
                                    <?php echo e($language->name); ?>

                                </li>
                                <?php if(!$loop->last): ?>
                                    <li class="py-1 text-gray-500 font-extrabold">&#183;</li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>
    
                </div>
            </div>
            
            <div class="flex justify-between" style="">
                <a href="<?php echo e(url('profile', $seller->username)); ?>"
                   class="py-2 px-4 rounded-lg text-white text-xs font-semibold btn-grad-card footer-second card-link" style="background-color: #91C444;">
                    <?php echo e(__('messages.t_view_profile')); ?>

                </a>
                <a href="<?php echo e(url('messages/new', $seller->username)); ?>"
                   class="py-2 px-4 rounded-lg text-white text-xs font-semibold btn-grad-card footer-second card-link" style="background-color: #91C444;">
                    <?php echo e(__('messages.t_contact_me')); ?>

                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php if($sellers->hasPages()): ?>
        <div class="flex justify-center pt-12">
            <?php echo $sellers->links('pagination::tailwind'); ?>

        </div>
    <?php endif; ?>            
        </div>
        
    </div>


</div>

<?php $__env->startPush('scripts'); ?>
    
    <script>
        function xRiqSKhIlmnKtWu() {
            return {

                open: false,

                // Init component
                init() {
                    
                }

            }
        }
        window.xRiqSKhIlmnKtWu = xRiqSKhIlmnKtWu();
    </script>

<script>
    window.onload = function() {
        document.querySelectorAll('.category-title').forEach(function(categoryTitle) {
            categoryTitle.addEventListener('click', function() {
                const icon = categoryTitle.querySelector('i');
                icon.classList.toggle('fa-plus');
                icon.classList.toggle('fa-minus');
                const subcategoriesList = categoryTitle.nextElementSibling;
                subcategoriesList.classList.toggle('active');
            });
        });
    };
</script>


<script>
    $(document).ready(function() {
        // Handle expand/collapse buttons
        $('#expand-btn').click(function() {
            $('.form-check.d-none').removeClass('d-none');
            $('#expand-btn').addClass('d-none');
            $('#collapse-btn').removeClass('d-none');
        });
        $('#collapse-btn').click(function() {
            $('.form-check:gt(5)').addClass('d-none');
            $('#collapse-btn').addClass('d-none');
            $('#expand-btn').removeClass('d-none');
        });

    });
</script>



<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>

<style>
    .category-title {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .subcategories-list {
        display: none;
    }

    .subcategories-list.active {
        display: block;
    }
    .subcategories-list.active li {
      margin-left: 15px;
    }
    span.category-title {
      font-size: 16px;
      font-weight: 700;
    }
</style>
        
<?php $__env->stopPush(); ?><?php /**PATH /home/skillmonde/public_html/resources/views/livewire/main/sellers/sellers.blade.php ENDPATH**/ ?>