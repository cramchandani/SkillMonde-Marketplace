<div class="about-us" style="max-width:97%; margin:auto;">

            <div class="hiw my-5 px-md-5 px-sm-4 px-3 container-fluid">
                <h1 class="fw-bold text-center">Welcome! Please Login</h1>
                  
                    {{-- Session success message --}}
            		@if (session()->has('success'))
            			<div class="mb-6 sm:max-w-md sm:w-full sm:mx-auto sm:overflow-hidden">
            				<div class="rounded-md bg-green-100 p-4">
            					<div class="flex">
            						<div class="flex-shrink-0">
            							<svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/> </svg>
            						</div>
            						<div class="ltr:ml-3 rtl:mr-3">
            							<p class="text-sm font-medium text-green-800">{{ session()->get('success') }}</p>
            						</div>
            					</div>
            				</div>
            			</div>
            		@endif
                <div class="bottom text-center my-5">
                    <a href="https://www.skillmonde.com/auth/login" class="btn rounded-pill bg-primary-500 hover:bg-primary-700 text-white font-semibold text-lg px-3">Sign In<i class="fa-solid fa-user ms-2"></i>
                    </a>
                    <p>You will be redirected to the login page in <span id="countdown">10</span> seconds.</p> 
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

        </div>
@push('styles')

<style>
.about-us {
  margin-top: -65px !important;
}
.about-us h1 {
  font-size: 50px;
  line-height: 70px;
}
</style>
@endpush


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
      $(document).ready(function() {
        var countdown = setInterval(function() {
          var seconds = $("#countdown").text();
          if (seconds == 1) {
            clearInterval(countdown);
            window.location.href = "https://www.skillmonde.com/auth/login";
          } else {
            seconds--;
            $("#countdown").text(seconds);
          }
        }, 1000);
      });
    </script>
<script type="text/javascript" src="https://affiliate.skillmonde.com/integration/general_integration"></script>
<script type="text/javascript">
 AffTracker.setWebsiteUrl( "https://skillmonde.com/auth/register" );
 //set custom value
 AffTracker.setData("rreferrer","affiliate");
 AffTracker.createAction( "YfRL4ejKTH" )
</script>
