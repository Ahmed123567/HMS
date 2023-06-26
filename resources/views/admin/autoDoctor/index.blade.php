@extends('layouts.master')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mt-5">
                <div class="p-6 text-gray-900">
                    <div class="col-lg-3 col-md-6">
                        <div class="card  bg-info-gradient">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    
                                    <div class="counter-icon text-primary">
                                       <a data-url="{{ route("autoDoctor.covid") }}"style="cursor: pointer" data-title="Covid Check" class="modal_btn" ><i class="icon icon-docs"></i></a>
                                    </div>
                                    <div class="mr-auto">
                                        <a data-url="{{ route("autoDoctor.covid") }}" style="cursor: pointer" data-title="Covid Check" class="modal_btn"><h5 class="tx-13 mt-4 mx-2 tx-white-8 mb-3">Covid Check</h5></a>
                                    </div>
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


    $(document).on("submit", "#covid_form" , function (e) {

        e.preventDefault()

        let form = $(this)
        let form_data = new FormData(form[0]);

        if(resultElement = document.querySelector(".covid_result")) {
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
