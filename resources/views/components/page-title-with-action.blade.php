 @props(['title', 'description'])

 <div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h2 class="ipt-title">{{ $title }}s</h2>
                <span class="ipn-subtitle">{{ $description }}</span>
            </div>

            <div class="mt-3 col-lg-4 col-md-4 d-flex justify-content-md-end">
                {{ $action }}
            </div>
        </div>
    </div>
</div>
