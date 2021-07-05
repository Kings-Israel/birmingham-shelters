<!-- ============================ Supporting Agencies ================================== -->
@if (count($agencies) > 0)
<section class="bg-light">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 text-center">
            <div class="sec-heading center">
                <h2>Supporting Agencies</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($agencies as $agency)
                <div class="col-lg-4 col-md-6">
                    <img src="{{asset('storage/agency/images/'.$agency->agency_image)}}" height="200" width="450" style="object-fit: contain" alt="">
                    <p style="text-align: center">{{ $agency->agency_name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- ============================ Step How To Use End ====================== -->
