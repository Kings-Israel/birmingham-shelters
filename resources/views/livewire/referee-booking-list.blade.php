<div>
    <ul>
        @foreach ($referees as $referee)
            <div class="row" style="margin-bottom: -10px">
                <div class="col-sm-7 text-center">
                    {{ $referee->applicant_name }}
                </div>
                <div class="col-sm-5">
                    <button class="rounded btn btn-primary btn-sm px-4" wire:click="addUserToList({{ $referee->id }})">Add</button>
                </div>
            </div>
            <hr>
        @endforeach
    </ul>
    <div>
        @if (session('error'))
            <div class="alert alert-danger">
                <p class="text-center">{{ session('error') }}</p>
            </div>
        @elseif (session('success'))
            <div class="alert alert-success">
                <p class="text-center">{{ session('success') }}</p>
            </div>
        @endif
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){
                window.livewire.on('remove_alert',()=>{
                    setTimeout(function(){
                        $(".alert-success").slideUp();
                    }, 4000);
                    setTimeout(function(){
                        $(".alert-danger").slideUp();
                    }, 4000);
                });
            });
        </script>
    @endpush
</div>
