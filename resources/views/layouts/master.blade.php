<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('layouts.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <style>
        .selection .select2-selection {
            padding: 5px 0 0 0;
            height: 39px;
        }

        .selection b {
            margin: 4px 0 0 -1px !important;
        }
    </style>


    @livewireStyles

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    
</head>

<body class="main-body app sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ URL::asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @if (auth()->user()->isDoctor() ||
            auth()->user()->isLabAnalyst())
        <div>
        @else
            @include('layouts.main-sidebar')
            <div class="main-content app-content">
    @endif
    <!-- main-content -->
    @include('layouts.main-header')
    <!-- container -->
    <div class="container-fluid">


        @yield('page-header')

        @if (session()->has('error'))
            <div class="alert-danger alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert-success alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @yield('content')


        <div class="modal fade" id="global_modal">
            <div class="modal-dialog modal-lg" role="document">
                <div id="global_modal_content" class="modal-content modal-content-demo">


                </div>
            </div>
        </div>

        {{-- @include('layouts.sidebar') --}}
        {{-- @include('layouts.footer') --}}
        @include('layouts.footer-scripts')

        <script src="{{ asset('assets/js/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        @livewireScripts
        @searcableScripts
        <script>
            $(".modal_btn").on("click", function() {
                let url = this.dataset.url;
                let title = this.dataset.title;
                let modal_header = `
						<div class="modal-header">
									<h6 class="modal-title">${title}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
					`;

                $.get(url, function(res) {

                    let html = modal_header + res;

                    $("#global_modal_content").html(html);

                    $("#global_modal").modal()
                })
            })


            const buttons = document.querySelectorAll('.delete_button');

            buttons.forEach(button => {
                button.onclick = (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                    let buttonName = e.target.dataset.button_name ?? "Delete";
                    Swal.fire({
                        title: "are you sure",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: buttonName
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.closest("form").submit()
                        }
                    })
                }
            });


            

            const urlFor = (route, bind) => {
 
                Object.keys(bind).forEach(param => {
                    route = route.replace(":" + param, bind[param])
                });

                return route;
            }

            $(document).ready(function() {
                $(document).on("submit", ".validate", function(e) {
                    e.preventDefault()
                    let form = $(this)
                    let form_data = new FormData(form[0]);

                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form_data,
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(data) {
                            location.reload();
                        },
                        error: function(data) {

                            $(".validation-message").hide();
                            let errors = data.responseJSON.errors;
                            for (const inputName in errors) {

                                let input = document.querySelector(
                                    `[name=${inputName}]`);

                                if (input) {
                                    let errorMessages = '';
                                    errors[inputName].forEach(error => {
                                        errorMessages +=
                                            `<p class='text-danger validation-message' style="font-size:12px"><span style="font-size:15px">😡</span>${error}</p>`
                                    });
                                    input.insertAdjacentHTML("afterend", errorMessages)
                                }
                            }
                        },
                    });
                })  
            })
        </script>

        @stack('js')

</body>





</html>



<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--- Internal Darggable js-->
<script src="{{ URL::asset('assets/plugins/darggable/jquery-ui-darggable.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/darggable/darggable.js') }}"></script>
