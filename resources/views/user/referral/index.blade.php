<x-app-layout pageTitle="User">
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="page-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <h1 style="color: white; text-align:center">SUPPORTED ACCOMMODATION REFERRAL FORM</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="gray-simple">
        <h2 class="pb-2" style="text-align: center">Please select one option:</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="agents-grid">
                                    
                        <div class="agents-grid-wrap">
                            <div class="fr-grid-thumb">
                                <a href="freelancer-detail.html">
                                    <img src="https://via.placeholder.com/400x400" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>

                            <div class="fr-grid-deatil">
                                <h3 class="fr-can-name"><a href="#">Self Referral</a></h3>
                            </div>
                        </div>

                        <div class="fr-grid-info">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam quae voluptatibus mollitia nesciunt perspiciatis sunt, dolor minima pariatur natus incidunt.</p>
                         </div>
                         
                         <div class="fr-grid-footer">
                             <div class="fr-grid-footer-flex-right">
                                 <a href="{{ route('referral.self-referral') }}" class="prt-view" tabindex="0">Click Here</a>
                             </div>
                         </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="agents-grid">
                                    
                        <div class="agents-grid-wrap">
                            
                            <div class="fr-grid-thumb">
                                <a href="freelancer-detail.html">
                                    <img src="https://via.placeholder.com/400x400" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            
                            <div class="fr-grid-deatil">
                                <h3 class="fr-can-name"><a href="#">Referral Agency</a></h3>
                            </div>
                            
                        </div>
                        
                        <div class="fr-grid-info">
                           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, est minus ipsum voluptatibus totam libero adipisci facilis. Et, laudantium enim!</p>
                        </div>
                        
                        <div class="fr-grid-footer">
                            <div class="fr-grid-footer-flex-right">
                                <a href="{{ route('referral.agency-referral') }}" class="prt-view" tabindex="0">Click Here</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>