<div class="w-full">

    <div class="mb-12 bg-white dark:bg-zinc-800 shadow shadow-gray-100 rounded-md border border-gray-200 dark:border-zinc-700 dark:shadow-none max-w-xl mx-auto">
        
        
        <div class="bg-gray-50 dark:bg-zinc-700 px-8 py-4 rounded-t-md border-b-2 border-gray-100 dark:border-zinc-700">
            <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
                <div class="ltr:ml-4 rtl:mr-4 mt-4">
                <h3 class="text-sm leading-6 font-semibold text-gray-900 dark:text-gray-100 tracking-wide mb-2"><?php echo e(__('messages.t_contact_us')); ?></h3>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-300"><?php echo e(__('messages.t_contact_us_subtitle')); ?></p>
                </div>
            </div>
        </div>
        
        <div class="mt-16 px-2 dark:text-gray-200 quill-container text-base">
                    <p class="text-justity py-2">Just send us your questions or concerns by writing a mail to <a href="mailto:info@skillmonde.com">info@skillmonde.com</a> and we will give you the help you need.</p>
                    
                    <p class="text-justity py-2">SkillMonde support will be available from <span class="font-semibold">Monday to Friday (10:00 pm to 6:00 pm)</span> except on <span class="font-semibold">Indian Banking Holidays</span>.</p>
                    
                    <p class="text-justity py-2">Please allow us time to resolve your queries as there might be existing tickets going through resolution.</p>
                    
                    <p class="text-justity py-2">In addition to it you can go through FAQ's listed on our website and ask for suggestions in our telegram community channel.</p>
                    
                    <div class="row">
                        <h4 class="font-bold text-lg">Operating Address:</h4>
                      <address class="border rounded-md">
                        <strong>CoreConcepts Learning Solutions and Technologies Private Limited</strong><br>
                        Plot No. 29, First Floor, <br>
                        Nukleus Tower, Sector-142,<br>
                        Noida- 201305<br>
                        <abbr title="Phone">Phone:</abbr> +91-9650023642
                      </address>
                    </div>
                    
                    <h4 class="font-bold text-lg py-2">Telegram Community Channel</h4>
                    
                     <p class="text-justity pb-2">Click <a href="https://t.me/+m5b4VvDJEjQ2N2U9" class="font-semibold" target="_blank">here</a> to connect our community.</p>
                </div>
                <hr/>
        
        
        <div class="px-8 py-6">
            <h2 class="font-extrabold text-lg text-center pb-6 capitalize" style="color: #8dc440 !important;">Need to get in touch with us? Fill the form below with your inquiry and our team will contact you soon.</h2>
            <div class="grid grid-cols-12 gap-5">

                
                <div class="col-span-12">
                    <?php if (isset($component)) { $__componentOriginala0274761f86638d78e36787c771a294b67c238db = $component; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_name')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_enter_your_fullname')),'icon' => 'account','model' => 'name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0274761f86638d78e36787c771a294b67c238db)): ?>
<?php $component = $__componentOriginala0274761f86638d78e36787c771a294b67c238db; ?>
<?php unset($__componentOriginala0274761f86638d78e36787c771a294b67c238db); ?>
<?php endif; ?>
                </div>

                
                <div class="col-span-12">
                    <?php if (isset($component)) { $__componentOriginala0274761f86638d78e36787c771a294b67c238db = $component; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_email_address')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_enter_email_address')),'icon' => 'at','model' => 'email','type' => 'email']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0274761f86638d78e36787c771a294b67c238db)): ?>
<?php $component = $__componentOriginala0274761f86638d78e36787c771a294b67c238db; ?>
<?php unset($__componentOriginala0274761f86638d78e36787c771a294b67c238db); ?>
<?php endif; ?>
                </div>

                
                <div class="col-span-12">
                    <?php if (isset($component)) { $__componentOriginala0274761f86638d78e36787c771a294b67c238db = $component; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_subject')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_enter_message_subject')),'icon' => 'format-text','model' => 'subject']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0274761f86638d78e36787c771a294b67c238db)): ?>
<?php $component = $__componentOriginala0274761f86638d78e36787c771a294b67c238db; ?>
<?php unset($__componentOriginala0274761f86638d78e36787c771a294b67c238db); ?>
<?php endif; ?>
                </div>

                
                <div class="col-span-12">
                    <?php if (isset($component)) { $__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11 = $component; } ?>
<?php $component = App\View\Components\Forms\Textarea::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Textarea::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_message')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_descibe_ur_message_in_details')),'icon' => 'file','model' => 'message']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11)): ?>
<?php $component = $__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11; ?>
<?php unset($__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11); ?>
<?php endif; ?>
                </div>

                
                <div class="col-span-12 mt-6">
                    <?php if (isset($component)) { $__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c = $component; } ?>
<?php $component = App\View\Components\Forms\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => 'contact','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_lets_talk')),'block' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c)): ?>
<?php $component = $__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c; ?>
<?php unset($__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c); ?>
<?php endif; ?>
                </div>

            </div>
        </div>

        
        <div class="px-4 py-6 bg-gray-50 dark:bg-zinc-700 border-t border-gray-200 dark:border-zinc-700 sm:px-10 text-center">
            <p class="text-xs leading-5 text-gray-500 dark:text-gray-300">
                <?php echo __('messages.t_by_continue_agree_terms_privacy', [
                    'privacy_link' => settings('footer')->privacy ? url('page', settings('footer')->privacy->slug) : "#",
                    'privacy_text' => settings('footer')->privacy ? settings('footer')->privacy->title : __('messages.t_privacy_policy'),
                    'terms_link'   => settings('footer')->terms ? url('page', settings('footer')->terms->slug) : "#",
                    'terms_text'   => settings('footer')->terms ? settings('footer')->terms->title : __('messages.t_terms_of_service'),
                ]); ?>

            </p>
        </div>

    </div>
</div><?php /**PATH /home/skillmonde/public_html/resources/views/livewire/main/help/contact/contact.blade.php ENDPATH**/ ?>