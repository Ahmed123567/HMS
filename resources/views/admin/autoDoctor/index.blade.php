@extends('layouts.master')
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>


<div class="row mt-5">
    <div class="col-xl-12 col-lg-6 col-sm-6 col-md-6">
        <div class="card text-center">
            <div class="card-body ">
                <div class="feature widget-2 text-center mt-0 mb-3">
                    <i class="ti ti-github mx-auto text-info xl " style="font-size:50px;"></i>
                </div>
                <h6 class="mb-1 text-muted">Hi ! I'am your medical AI assistant</h6>

                <h3 class="font-weight-semibold">How can I help you?
                </h3>

            </div>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="sortable">
            <div class="row row-sm">
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="card text-center">
                        <img class="card-img-top w-100" src="{{URL::asset('assets/img/photos/9.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Covid Check</h4>
                            <p class="card-text">Accuracy: <span class="badge badge-success">95%</span></p>
                            <div class="btn btn-primary btn-rounded ">
                                <a data-url="{{ route("autoDoctor.covid") }}" style="cursor: pointer"
                                    data-title="Covid Check" class="modal_btn"><i class="fa fa-upload"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="card text-center">
                        <img class="card-img-top w-100" src="{{URL::asset('assets/img/photos/10.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Brain Tumor</h4>
                            <p class="card-text">Accuracy: <span class="badge badge-success">92%</span></p>
                            <div class="btn btn-primary btn-rounded ">
                                <a data-url="{{ route("autoDoctor.covid") }}" style="cursor: pointer"
                                    data-title="Covid Check" class="modal_btn"><i class="fa fa-upload"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="card text-center">
                        <img class="card-img-top w-100" src="{{URL::asset('assets/img/photos/12.jpg')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title mb-3">ECG</h4>
                            <p class="card-text">Accuracy: <span class="badge badge-warning">85%</span></p>
                            <div class="btn btn-primary btn-rounded ">
                                <a data-url="{{ route("autoDoctor.covid") }}" style="cursor: pointer"
                                    data-title="Covid Check" class="modal_btn"><i class="fa fa-upload"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    @endsection

    @push("js")
    <script>
    $(document).on("submit", "#covid_form", function(e) {

        e.preventDefault()

        let form = $(this)
        let form_data = new FormData(form[0]);

        if (resultElement = document.querySelector(".covid_result")) {
            resultElement.remove();
        }

        const spinner = document.getElementById('spinner');

        spinner.style.display = "block";

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form_data,
            contentType: false,
            processData: false,
            cache: false,
            success: function(data) {
                console.log(1);
                spinner.style.display = "none";
                document.querySelector(".modal-body").insertAdjacentHTML('beforeend', data);
            },
            error: function(err) {
                spinner.style.display = "none";
                document.querySelector(".modal-body").insertAdjacentHTML('beforeend',
                    `<p class='text-danger text-center covid_result'> 
                        Error has been occure please check you uploaded image
                    <p>
                    `);
            }

        })
    })
    </script>

    @endpush
