<div class="w-full">

    <div class="featured mx-sm-5 mx-2"><!--featured start-->
        
        <?php if(settings('appearance')->is_featured_categories && $categories && $categories->count()): ?>
            <div class="container-fluid px-0 text-sm-start">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-12 text-center pb-4 mb-4">
                        <h1 class="text-uppercase font-semibold text-4xl sm:text-lg md:text-xl"><?php echo e(__('messages.t_featured_categories')); ?></h1>
                       
                    </div>
                    <div class="col-lg-12 col-12 d-flex flex-column align-items-center">
                        <div class="row gy-sm-0 gy-4 right w-100 featuredright">
                           <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-2 col-6 first shadow-sm group relative p-4 mb-5 min-h-[190px flex]">
                                <div class="card position-relative rounded-2 text-center text-white absolute inset-0 rounded-lg bg-primary-100 transform transition ease-out duration-150 group-hover:-rotate-2">
                                    <div class="absolute inset-0 rounded-lg bg-primary-100 transform transition ease-out duration-150 skew-y-2 group-hover:-rotate-2"></div>
                                    <a href="<?php echo e(url('categories', $category->slug)); ?>">
                                    <img src="<?php echo e(src($category->image)); ?>" alt="<?php echo e($category->name); ?>" class="relative rounded-lg shadow object-cover">
                                    
                                    
                                    
                                      <h6 class="text-dark leading-6 h-7" style="z-index: 99;position: relative;color: #fff !important;font-weight: 600;"><?php echo e($category->name); ?></h6>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="arrow mt-4">
                            <i class="fa-solid fa-angle-left me-4 rounded-circle border border-1 border-dark featuredactive featuredactiveback" onclick="scrollBack()" title="Back"></i>
                            <i class="fa-solid fa-angle-right rounded-circle border border-1 border-dark featuredactive featuredactiveforword" onclick="scrollForward()" title="Next"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
    </div><!--featured end-->

    <div class="aboutus mx-sm-3 mx-2 py-4 mb-16 mt-4 bg-indigo-100"><!--about us start-->
            <div class="container-fluid text-sm-start text-center mx-4 px-4 mb-16 mt-6">
                <div class="row gy-lg-0 gy-4">
                    <div class="howit col-lg-6 col-sm-12 col-12 order-lg-1 order-2 d-flex align-items-center justify-content-between position-relative red-green">
                        <div class="left w-100 d-flex align-items-center px-3 rounded-2">
                            <h5 class="mb-0 text-white text-start text-center" style="padding-left: 11%;font-size: 20px;text-transform: uppercase;font-weight: 600;">How<br>
                                it<br>
                                Works!</h5>
                        </div>
                        <div class="center position-absolute top-50 start-50 translate-middle shadow">
                            <!--<video width="320" height="240" class="rounded-2" controls>
                                <source src="<?php echo e(asset('public/img/assets/how-it-works.mp4')); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>-->
                            <iframe class="responsive-iframe" height="215" src="https://www.youtube.com/embed/LuD13mHsyBw" title="Unlock Your Business Potential with SkillMonde&#39;s Marketplace and Managed Services" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>

                        <div class="right w-100 d-flex align-items-center px-3 justify-content-end rounded-2 text-center">
                            <h5 class="mb-0 text-white text-end text-center" style="padding-right: 6%;font-size: 20px;text-transform: uppercase;font-weight: 600;">COMMENCE <br>CONNECT<br>
                                CREATE</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12 order-lg-2 order-1 mb-6">
                        <h3 class="pb-4 text-uppercase font-semibold text-4xl">About Us</h3>
                        <p style="max-width: 95%;"><?php echo e(__('messages.t_home_about_us_short_descreption')); ?></p>
                        <a href="https://skillmonde.com/page/about-us" class="btn bg-white rounded-pill px-4 py-2 mt-4">Learn More<i class="fa-solid fa-angle-right ms-3"></i></a>
                    </div>
                </div>
            </div>
    </div><!--about us end-->        
    
        <div class="live mx-sm-5 mx-2 py-12 mb-12"><!--live start-->
            <div class="container px-2 text-center">
                <div class="row ">
                    <div class="col-lg-12 col-12 mb-12">
                        <h3 class="pb-2 text-uppercase font-semibold text-4xl">If you have Talent, We have Clients</h3>
                        <p>Tremendous Opportunities for a Regular Income.<br>
                        Not getting enough work from already Saturated Marketplace Platforms?
                        </p>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="row justify-content-md-center gy-sm-0 gy-4 right w-100">
                            <div class="col-sm-2 col-6 first ">
                                <div class="card position-relative rounded-2 text-center text-white">
                                    <img src="<?php echo e(asset('public/img/home/LOWEST-COMMISSION-IN-INDUSTRY.png')); ?>" alt="LOWEST-COMMISSION-IN-INDUSTRY" class="w-100">
                                    <div class="layer position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 text-base bg-purple-500 uppercase">Lowest <br>Commissions</h6>
                                </div>
                            </div>
                            <div class="col-sm-2 col-6 second">
                                <div class="card position-relative rounded-2 text-center text-white">
                                    <img src="<?php echo e(asset('public/img/home/ROBUST-PLATFORM-3.png')); ?>" alt="LOWEST-COMMISSION-IN-INDUSTRY" class="w-100">
                                    <div class="layer position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 text-base bg-purple-500 uppercase">Robust <br>Platform</h6>
                                </div>
                            </div>
                            <div class="col-sm-2 col-6 third">
                                <div class="card position-relative rounded-2 text-center text-white">
                                    <img src="<?php echo e(asset('public/img/home/MINIMUM-WALLET-BALANCE-5.png')); ?>" alt="LOWEST-COMMISSION-IN-INDUSTRY" class="w-100">
                                    <div class="layer position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 text-base bg-purple-500 uppercase">No Minimum <br>Balance </h6>
                                </div>
                            </div>
                            <div class="col-sm-2 col-6 fourth">
                                <div class="card position-relative rounded-2 text-center text-white">
                                    <img src="<?php echo e(asset('public/img/home/NETWORK-OF-CLIENTS-3.png')); ?>" alt="NETWORK-OF-CLIENTS" class="w-100">
                                    <div class="layer position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 text-base bg-purple-500 uppercase">Huge <br>Network</h6>
                                </div>
                            </div>
                            <div class="col-sm-2 col-6 fifth">
                                <div class="card position-relative rounded-2 text-center text-white">
                                    <img src="<?php echo e(asset('public/img/home/PROJECTS-FROM-SKILLMONDE.png')); ?>" alt="Project Opportunities from SkillMonde Managed services" class="w-100">
                                    <div class="layer position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 text-base bg-purple-500 uppercase">Project <br>Opportunities</h6>
                                </div>
                            </div>
                        </div>
                        <!--<div class="arrow mt-4">
                            <i class="fa-solid fa-angle-left me-4 rounded-circle border border-1 border-dark"></i>
                            <i class="fa-solid fa-angle-right rounded-circle border border-1 border-success"></i>
                        </div>-->
                        <div class="bottom text-center my-5">
                            <a href="https://www.skillmonde.com/start_selling" class="btn rounded-pill btn-sm bg-primary-500 hover:bg-primary-700 text-white font-semibold text-lg px-3">Start Selling<i class="fa-solid fa-angle-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--live end-->
        
        <div class="top-sellers text-center px-sm-5 px-2 py-12 text-white" id="managed-services"><!--top sellers start-->
            <div class="top mb-5">
                <h3 class="pb-2 text-uppercase font-semibold text-4xl">Ready to Get Stuff Done? Let us do it for you</h3>
                <p>We make SkillMonde Managed Services a seamless experience that lets you focus on growing your business. <br>Simplified Outsourcing!</p>
            </div>
            <div class="middle mb-sm-5 mb-4">
                <div class="container-fluid">
                    <div class="row gy-lg-0 gy-4">
                        <div class="col-lg-2 col-sm-3 col-6 mt-0">
                            <div class="card position-relative rounded-2 text-center text-white">
                                <a href="https://www.skillmonde.com/edtech" class="text-white">
                                    <img src="<?php echo e(asset('public/img/home/edtech-purple-skillmonde.png')); ?>" alt="edtech-purple-skillmonde" class="w-100">
                                    <div class="position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 leading-6 bg-purple-500">EDTECH</h6>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-6 mt-0">
                            <div class="card position-relative rounded-2 text-center text-white">
                                <a href="https://www.skillmonde.com/publishers" class="text-white">
                                    <img src="<?php echo e(asset('public/img/home/publisher-2.png')); ?>" alt="edtech-purple-skillmonde" class="w-100">
                                    <div class="position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 leading-6 bg-purple-500">PUBLISHERS</h6>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-6 mt-0">
                            <div class="card position-relative rounded-2 text-center text-white">
                                <a href="https://www.skillmonde.com/ngo" class="text-white">
                                    <img src="<?php echo e(asset('public/img/home/NGO.png')); ?>" alt="NGO" class="w-100">
                                    <div class="position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 leading-6 bg-purple-500">NGO</h6>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-6 mt-0">
                            <div class="card position-relative rounded-2 text-center text-white">
                                <a href="https://www.skillmonde.com/corporate" class="text-white">
                                    <img src="<?php echo e(asset('public/img/home/CORPORATE-2.png')); ?>" alt="CORPORATE" class="w-100">
                                    <div class="position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 leading-6 bg-purple-500">CORPORATE</h6>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-6 mt-0">
                            <div class="card position-relative rounded-2 text-center text-white">
                                <a href="https://www.skillmonde.com/academic" class="text-white">
                                    <img src="<?php echo e(asset('public/img/home/ACADEMIC-INSTITUTIONS-2.png')); ?>" alt="ACADEMIC INSTITUTIONS" class="w-100">
                                    <div class="position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 leading-6 bg-purple-500">ACADEMIC INSTITUTIONS</h6>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-6 mt-0">
                            <div class="card position-relative rounded-2 text-center text-white">
                                <a href="https://www.skillmonde.com/government" class="text-white">
                                    <img src="<?php echo e(asset('public/img/home/GOVERNMENT-2.png')); ?>" alt="GOVERNMENT" class="w-100">
                                    <div class="position-absolute w-100 h-100"></div>
                                    <h6 class="mb-0 z-10 leading-6 bg-purple-500">GOVERNMENT</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<button class="btn rounded-pill bg-white px-3">SEE ALL <i class="fa-solid fa-angle-right ms-2"></i></button>-->
        </div><!--top sellers end-->        
    
    <div class="blog px-sm-5 px-2"><!--blog start-->
            <div class="top mb-4 text-center">
                <h3 class="text-uppercase font-semibold text-4xl pb-4">Our Blog</h3>
                <p><?php echo e(__('messages.t_latest_appname_news', ['app_name' => config('app.name')])); ?></p>
            </div>
            
            <div class="container-fluid">
                <div class="row gy-4">


<?php
                
                // Establish a connection to the WordPress database
                $wpdb = new PDO('mysql:host=localhost;dbname=skillmonde_wp_kukdc;charset=utf8', 'skillmonde_wp_cdj3m', 'L4_9InBFJ2%BNiEg');
                
                // Set the table prefix
                $table_prefix = 's5L2lNeX0_';
                
                // Query the WordPress database to retrieve the 4 most recent blog posts with their featured images
                $blogPosts = $wpdb->query("
SELECT 
    {$table_prefix}posts.ID, 
    {$table_prefix}posts.post_title, 
    {$table_prefix}posts.post_excerpt, 
    {$table_prefix}posts.post_name, 
    {$table_prefix}posts.post_content,
    SUBSTRING_INDEX(pm.meta_value, '/', -1) AS featured_image,
    {$table_prefix}posts.post_date
FROM 
    {$table_prefix}posts
    LEFT JOIN {$table_prefix}postmeta ON {$table_prefix}posts.ID = {$table_prefix}postmeta.post_id AND {$table_prefix}postmeta.meta_key = '_thumbnail_id'
    LEFT JOIN {$table_prefix}postmeta AS pm ON pm.post_id = {$table_prefix}postmeta.meta_value AND pm.meta_key = '_wp_attached_file'
WHERE 
    {$table_prefix}posts.post_type = 'post' AND {$table_prefix}posts.post_status = 'publish'
ORDER BY 
    {$table_prefix}posts.post_date DESC
LIMIT 4


                ")->fetchAll(PDO::FETCH_ASSOC);
                
                // Display the retrieved blog posts and their featured images
                foreach ($blogPosts as $blogPost) {
                    $year = date('Y', strtotime($blogPost['post_date']));
                    $month = date('m', strtotime($blogPost['post_date']));
                    // Get the post excerpt and limit it to 100 characters
                    $excerpt = strip_tags($blogPost['post_content']);
                    if (strlen($excerpt) > 130) {
                        $excerpt = substr($excerpt, 0, 130) . '...';
                    }
                ?>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="blog-card container-fluid p-0 pe-sm-3 pe-0 rounded-2 bg-white text-start">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <a href="/blog/<?php echo $blogPost['post_name']; ?>" target="_blank">
                                    <img src="https://www.skillmonde.com/blog/wp-content/uploads/<?php echo $year.'/'.$month.'/'.$blogPost['featured_image']; ?>" alt="<?php echo $blogPost['post_title']; ?>" class="w-100 h-100 image-size">
                                    </a>
                                </div>
                                <div class="col-sm-6 col-12 d-flex flex-column justify-content-between p-sm-3 p-4">
                                    <div class="top-b">
                                        <h5 class="text-capitalize font-semibold"><?php echo $blogPost['post_title']; ?></h5>
                                        <p class="text-muted py-2"><?php echo $excerpt; ?>
                                        </p>
                                        
                                    </div>
                                    <a href="/blog/<?php echo $blogPost['post_name']; ?>" class="btn bg-white rounded-pill px-4 py-2" target="_blank">Learn More<i class="fa-solid fa-angle-right ms-sm-3 ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>
                </div>
            </div>
            
            <div class="bottom text-center my-5">
                <a href="<?php echo e(url('blog')); ?>" class="btn btn-sm rounded-pill text-white px-3">SEE ALL <i class="fa-solid fa-angle-right ms-2"></i></a>
            </div>
        </div><!--blog end-->
        
    <div class="grid grid-cols-12 px-4 gap-6">
        
        <?php if(settings('newsletter')->is_enabled): ?>
            <div class="col-span-12">
                <div class="bg-gray-100 dark:bg-zinc-800 rounded-md p-6 flex items-center sm:p-10">
                    <div class="max-w-lg mx-auto">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100"><?php echo e(__('messages.t_sign_up_for_newsletter')); ?></h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300"><?php echo e(__('messages.t_sign_up_for_newsletter_subtitle')); ?></p>
                        <div class="mt-4 sm:mt-6 sm:flex">
                            <label for="email-address" class="sr-only">Email address</label>
                            <input wire:model.defer="email" id="email-address" type="text" autocomplete="email" required="" placeholder="<?php echo e(__('messages.t_enter_email_address')); ?>"
                                class="h-14 appearance-none min-w-0 w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-700 rounded-md shadow-sm py-2 px-4 text-sm text-gray-900 dark:text-gray-300 placeholder-gray-500 focus:outline-none focus:border-primary-600 focus:ring-1 focus:ring-primary-600">
                            <div class=" sm:flex-shrink-0 sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4">
                                <button wire:click="newsletter" wire:loading.attr="disabled" wire:target="newsletter" type="button" class="dark:disabled:bg-zinc-500 dark:disabled:text-zinc-400 disabled:cursor-not-allowed disabled:!bg-gray-400 disabled:text-gray-500 h-14 w-full bg-primary-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-sm font-bold tracking-wider text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary-600">
                                    <?php echo e(__('messages.t_signup')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>

    
    <?php if(settings('appearance')->is_featured_categories && $categories && $categories->count()): ?>
        <script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function(){
                // Init featured categories slick
                $('#featured-categories-slick').slick({
                    dots          : false,
                    autoplay      : true,
                    infinite      : true,
                    speed         : 300,
                    slidesToShow  : 6,
                    slidesToScroll: 1,
                    arrows        : false,
                    responsive    : [
                        {
                        breakpoint: 1024,
                            settings: {
                                slidesToShow  : 4,
                                slidesToScroll: 2
                            }
                        },
                        {
                        breakpoint: 800,
                            settings: {
                                slidesToShow  : 3,
                                slidesToScroll: 2
                            }
                        },
                        {
                        breakpoint: 600,
                            settings: {
                                slidesToShow  : 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                        breakpoint: 480,
                            settings: {
                                slidesToShow  : 2,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
                $('#featured-categories-slick').removeClass('hidden');
            });
        </script>
    <?php endif; ?>

    
    <?php if(settings('appearance')->is_best_sellers && $sellers && $sellers->count()): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                // Init featured categories slick
                $('#top-sellers-slick').slick({
                    dots          : false,
                    autoplay      : true,
                    infinite      : true,
                    speed         : 300,
                    slidesToShow  : 5,
                    slidesToScroll: 1,
                    arrows        : false,
                    responsive    : [
                        {
                        breakpoint: 1024,
                            settings: {
                                slidesToShow  : 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                        breakpoint: 800,
                            settings: {
                                slidesToShow  : 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                        breakpoint: 600,
                            settings: {
                                slidesToShow  : 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                        breakpoint: 480,
                            settings: {
                                slidesToShow  : 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
                $('#top-sellers-slick').removeClass('hidden');
            });
        </script>
    <?php endif; ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>

    
    <?php if(settings('appearance')->is_featured_categories): ?>
    <link rel="preload" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css" as="style" onload="this.onload=null;this.rel='stylesheet';"/>
    <?php endif; ?>
<style>
.slick-prev.slick-arrow {
  display: none;
}
  .slick-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .slick-arrows {
    display: flex;
    justify-content: center;
    margin-top: 20px; /* adjust as needed */
  }

  .slick-prev,
  .slick-next {
    display: inline-block;
    margin: 0 10px;
  }
  .slider button {
    white-space: nowrap;
  }

</style>
        
<?php $__env->stopPush(); ?>
<?php /**PATH /home/skillmonde/public_html/resources/views/livewire/main/home/home.blade.php ENDPATH**/ ?>