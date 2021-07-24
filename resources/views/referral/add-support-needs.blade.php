<x-app-layout pageTitle="Support Needs">
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

    <section class="bg-light">
        <div class="container-fluid">
            <form action="{{ route('support-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="referee_data_id" value="{{ $refereeData->id }}">
                <div class="submit-page">

                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5>SUPPORT GROUPS AND NEEDS</h5>
                        <div class="submit-section">
                            <p>Section 5 of 6</p>
                            <p><strong>*For each selected option please provide details of support information required</strong></p>
                            <br>
                            <div class="container">
                                @for ($i = 0; $i < count($support_group_list); $i++)
                                    <div class="row">
                                        <div class="form-group col-lg-5 col-md-6 col-sm-12">
                                            <input id="{{ $support_group_list[$i] }}" class="checkbox-custom" name="support_group[]" value="{{ $support_group_list[$i] }}" type="checkbox">
                                            <label for="{{ $support_group_list[$i] }}" class="checkbox-custom-label">{{ $support_group_list[$i] }}</label>
                                        </div>
                                        <div class="form-group col-lg-7 col-md-6 col-sm-12">
                                            <label>Support Needs</label>
                                            <input type="text" id="support_needs" name="support_needs[{{ $support_group_list[$i] }}]" class="form-control">
                                            @error($support_group_list[$i])
                                                <p class="error-message"><strong>{{ $message }}</strong></p>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                @endfor
                                <br>
                                <div class="listing-submit-button">
                                    <div class="form-group col-lg-12 col-md-12" id="listing-buttons">
                                        <a href="{{ route('referee.cancel', $refereeData->id ?? '') }}" class="btn btn-md btn-outline-theme">
                                            Cancel
                                        </a>
                                        <button class="btn btn-theme-light-2 rounded" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
