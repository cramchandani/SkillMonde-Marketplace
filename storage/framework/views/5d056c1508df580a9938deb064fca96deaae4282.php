<div class="about-us" style="max-width:97%; margin:auto;">

            <div class="cover vh-100" style="position: relative; background-image: url('<?php echo e(asset('public/img/managed/iStock-154099334_compressed.jpg')); ?>'); background-size: cover;">
                <div style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; background-color: rgba(21, 3, 32, 0.5);"></div>
                <div class="bg-dark h-100 w-100 bg-opacity-25 d-flex flex-column align-items-center justify-content-center text-white">
                    <h1 class="fw-bold">Government</h1>
                    <h4 class="mb-0 text-center text-lg font-medium p-4" style="background: rgba(0, 0, 0, 0.38);">Customized solutions for government projects <br>and content/courses development - achieve your goals while staying within your budget </h4>
                </div>
            </div>

            <div class="hiw my-5 px-md-5 px-sm-4 px-3 container-fluid">
                <div class="row gy-4">
                    <!--
                    <div class="col-lg-3 col-6 order-lg-0 order-2">
                        <div class="rounded-2 overflow-hidden">
                            <img src="assets/how-it-work-1.png" alt="" class="w-100">
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 order-1">
                        <div class="rounded-2 overflow-hidden">
                            <img src="assets/how-it-work-2.png" alt="" class="w-100">
                        </div>
                    </div>
                    -->
                    <div class="col-lg-12 col-12 order-lg-2 order-0 d-flex">
                        <div>
                            <h3 class="text-center py-2">Content Solution Offering for Government</h3>
                            <p class="mb-0 text-secondary text-base text-justify pt-4">Reaching out to the populace and raising awareness among them are among a government's top priorities in order to aid in their ascent. Effective communication and the right educational programme are essential elements of any welfare plan or policy. To get these two components right, the government needs top-notch content services. Content services are necessary to ensure that the government is providing its residents with current, correct information. For spreading the awareness E-learning is essential because it enables the government to offer training on crucial subjects including public health, financial literacy, the development of work skills and child education. To assist the government in meeting their objective of  helping every citizen in their social and economic growth path, SkillMonde offers a wide range of services at an optimum cost by managing the entire project to achieve delivery excellence.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="omso mb-5">
                <h3 class="text-center mb-4">Our Managed Service Offerings</h3>
                <div class="container-fluid px-md-5 px-sm-4 px-3">
                    <div class="row">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 col-sm-4 col-12 py-2">
                            <div class="rounded-2 overflow-hidden position-relative">
                                <img src="<?php echo e(src($category->image)); ?>" alt="<?php echo e($category->name); ?>" class="relative rounded-lg shadow object-cover">
                                <div class="bg-dark h-100 w-100 position-absolute top-0 bg-opacity-50 d-flex align-items-center justify-content-center text-center">
                                    <h6 class="mb-0 text-white fw-normal py-1" style="background-color: rgba(0, 0, 0, 0.56);width: 100%;"><?php echo e($category->name); ?></h6>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                </div>
            </div>

            <div class="why-us mx-md-5 mx-sm-4 mx-3 mb-5 row">
                <h3 class="font-bold text-center pb-2" style="color: #8ccf27;">Why Us</h3>
                <h4 class="font-semibold text-secondary mb-4 text-center">One-stop Solution to All Your Content-driven Requisites</h4>
                
                <div class="col-lg-6 col-md-6 col-sm-12">   
                    <div class="d-flex align-items-center mb-3">
                        <i
                            class="fa-solid fa-circle-check me-2 fa-lg px-3 py-4 bg-primary bg-opacity-25 rounded-4 text-primary"></i>
                        <h6 class="mb-0 fw-normal">Scalable Solutions through Digital Means</h6>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i
                            class="fa-solid fa-handshake me-2 fa-lg px-3 py-4 bg-success bg-opacity-25 rounded-4 text-success"></i>
                        <h6 class="mb-0 fw-normal">Intuitive self-learning course content</h6>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i
                            class="fa-solid fa-face-smile me-2 fa-lg px-3 py-4 bg-warning bg-opacity-25 rounded-4 text-warning"></i>
                        <h6 class="mb-0 fw-normal">Resource Optimization to save cost</h6>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-clock me-2 fa-lg px-3 py-4 bg-info bg-opacity-25 rounded-4 text-info"></i>
                        <h6 class="mb-0 fw-normal">Delivery Excellence to meet milestones</h6>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">  
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-q me-2 fa-lg px-3 py-4 bg-primary bg-opacity-25 rounded-4 text-primary"></i>
                        <h6 class="mb-0 fw-normal">Domain Expertise for Multiple Sectors
                        </h6>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i
                            class="fa-solid fa-microchip me-2 fa-lg px-3 py-4 bg-success bg-opacity-25 rounded-4 text-success"></i>
                        <h6 class="mb-0 fw-normal">Robust Project Management</h6>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-users me-2 fa-lg px-3 py-4 bg-danger bg-opacity-25 rounded-4 text-danger"></i>
                        <h6 class="mb-0 fw-normal">Enhanced Operational Efficiency</h6>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-globe me-2 fa-lg px-3 py-4 bg-warning bg-opacity-25 rounded-4 text-warning"></i>
                        <h6 class="mb-0 fw-normal">Best-in-class learning expereince </h6>
                    </div>
                </div>
            </div> 

            <div class="aof mx-md-5 mx-sm-4 mx-3 mb-5 row">
                <h3 class="mx-md-5 mx-sm-4 mx-3 mb-4 text-center font-bold" style="color: #8ccf27;">About our Founder</h3>
                <div class="row">
                    <div class="col-lg-6 col-12 aof-left px-0">
                        <!--<div class="h-100 aof-photo">
                        </div>-->
                        <div class="shadow">
                            <!--
                            <video width="320" height="240" class="rounded-2" controls>
                                <source src="<?php echo e(asset('public/img/assets/how-it-works.mp4')); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            -->
                            <iframe class="responsive-iframe" height="300" width="100%" src="https://www.youtube.com/embed/LuD13mHsyBw" title="Unlock Your Business Potential with SkillMonde&#39;s Marketplace and Managed Services" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 aof-right mt-3 align-items-center">
                        <div class="bg-white px-sm-4 px-3 py-4 rounded-2 box">
                            <p>Chander Ramchandani is the founder of SkillMonde. SkillMonde is a brand of
                                CoreConcepts Learning Solutions and Technologies Private Limited. He has done
                                Masters of Business Administration with specialization in Marketing, from
                                University of Pune. He has followed his love for Mathematics, with a rigorous
                                course on Mathematics Honours from Department of Mathematics, KMC,
                                University of Delhi</p>
                            <div class="btn rounded-pill px-4 py-2 text-white">LEARN MORE<i
                                    class="fa-solid fa-chevron-right ms-3"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact mx-md-5 mx-sm-4 mx-3 mb-5 mt-10">
                <div class="row w-100 text-white m-0">
                    <div class="col-sm-6 col-12 left px-4 py-4 h-auto">
                        <div class="h-100 d-flex flex-column justify-content-between">
                            <div><h3 class="mb-2">Contact us</h3>
                                <p class="fw-light">Click <a href="https://t.me/+m5b4VvDJEjQ2N2U9" class="font-semibold" target="_blank">here</a> to connect our community.
                                </p>
                            </div>
                            <p>OR</p>
                            <div>
                                <a class="w-auto bg-primary-500 hover:bg-primary-700 text-white text-base sm:text-normal md:text-md font-bold py-2 px-4 rounded-full" href="https://www.skillmonde.com/help/contact"> Contact Us</a>
                            </div>
                            <div><p class="mb-2 fw-light">Phone no.</p>
                            <h4>89956771256</h4></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 right px-4 py-4">
                        <div>
                            <p class="mb-2 fw-light">Address : </p>
                            <h5 class="mb-4 fw-normal">CoreConcepts Learning Solutions and Technologies Private Limited
                                Plot No. 29, First Floor,
                                Nukleus Tower, Sector-142,
                                Noida- 201305
                                Phone: +91-9650023642 </h5>
                            <p class="mb-2 fw-light">Email :  </p>
                            <h5 class="mb-4 fw-normal"><a href="mailto:info@skillmonde.com">info@skillmonde.com</a></h5>
                            <p class="mb-2 fw-light">Social :  </p>
                            <div>
                                <i class="fa-brands fa-facebook-f fa-lg me-4"></i>
                                <i class="fa-brands fa-twitter fa-lg me-4"></i>
                                <i class="fa-brands fa-linkedin-in fa-lg me-4"></i>
                                <i class="fa-brands fa-youtube fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ocat mx-md-5 mx-sm-4 mx-3 mb-5">
                <h3>Our Clients and Testimonials</h3>
                <p class="text-secondary">Lorem Ipsum Dolor Sit Amet Consectetursdf Adipisicing Elit.</p>
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <div class="card px-3 py-3 border border-0">
                            <i class="fa-solid fa-quote-left mb-2"></i>
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. M
                                axime mollitia,molestiae quas vel sint commodi repudian
                                dae consequuntur voluptatum laborumnumquam bland
                                itiis harum quisquam eius sed oditLorem Ipsum Dolor Sit A
                                met Consectetur Adipisicing Elit. MAxime Mollitia,Molestiae
                                Quas Vel Sint Commodi RepudianDae</p>
                            <div class="profile d-flex align-items-center p-0">
                                <img src="assets/user-1.png" alt="" class="me-3">
                                <div>
                                    <h6 class="mb-0">John Rayan</h6>
                                    <p class="mb-0 text-secondary fw-light">Lorem</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card px-3 py-3 border border-0">
                            <i class="fa-solid fa-quote-left mb-2"></i>
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. M
                                axime mollitia,molestiae quas vel sint commodi repudian
                                dae consequuntur voluptatum laborumnumquam bland
                                itiis harum quisquam eius sed oditLorem Ipsum Dolor Sit A
                                met Consectetur Adipisicing Elit. MAxime Mollitia,Molestiae
                                Quas Vel Sint Commodi RepudianDae</p>
                            <div class="profile d-flex align-items-center p-0">
                                <img src="assets/user-2.png" alt="" class="me-3">
                                <div>
                                    <h6 class="mb-0">John Rayan</h6>
                                    <p class="mb-0 text-secondary fw-light">Lorem</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card px-3 py-3 border border-0">
                            <i class="fa-solid fa-quote-left mb-2"></i>
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. M
                                axime mollitia,molestiae quas vel sint commodi repudian
                                dae consequuntur voluptatum laborumnumquam bland
                                itiis harum quisquam eius sed oditLorem Ipsum Dolor Sit A
                                met Consectetur Adipisicing Elit. MAxime Mollitia,Molestiae
                                Quas Vel Sint Commodi RepudianDae</p>
                            <div class="profile d-flex align-items-center p-0">
                                <img src="assets/user-2.png" alt="" class="me-3">
                                <div>
                                    <h6 class="mb-0">John Rayan</h6>
                                    <p class="mb-0 text-secondary fw-light">Lorem</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card px-3 py-3 border border-0">
                            <i class="fa-solid fa-quote-left mb-2"></i>
                            <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. M
                                axime mollitia,molestiae quas vel sint commodi repudian
                                dae consequuntur voluptatum laborumnumquam bland
                                itiis harum quisquam eius sed oditLorem Ipsum Dolor Sit A
                                met Consectetur Adipisicing Elit. MAxime Mollitia,Molestiae
                                Quas Vel Sint Commodi RepudianDae</p>
                            <div class="profile d-flex align-items-center p-0">
                                <img src="assets/user-1.png" alt="" class="me-3">
                                <div>
                                    <h6 class="mb-0">John Rayan</h6>
                                    <p class="mb-0 text-secondary fw-light">Lorem</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4"><div class="btn text-white rounded-pill px-4 py-2 text-center">SEE ALL<i
                    class="fa-solid fa-chevron-right ms-3"></i></div></div>
            </div>

        </div>
<?php $__env->startPush('styles'); ?>
<style>
.about-us {
  margin-top: -65px !important;
}
.about-us h1 {
  font-size: 50px;
  line-height: 70px;
}
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/skillmonde/public_html/resources/views/livewire/main/custompage/government.blade.php ENDPATH**/ ?>