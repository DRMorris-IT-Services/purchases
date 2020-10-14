
<div class="row">
    <div class="col-md-12">
<!-- SYSTEM NOTIFICATIONS -->
@if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div  class="alert alert-success alert-dismissible fade show" role="alert" >
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
            aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
            </button>

                {{ session('status') }}
            </div>
        @endif

        @if (session('warning'))
            <div  class="alert alert-warning alert-dismissible fade show" role="alert" >
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
            aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
            </button>

                <h5><i class="fa fa-warning"></i> {{ session('warning') }}</h5> 
            </div>
        @endif

        @if (session('download'))
            <div  class="alert alert-info alert-dismissible fade show" role="alert" >
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
            aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
            </button>

                <h5><i class="fa fa-info-circle fa-lg"></i> {{ session('download') }}</h5>
            </div>
        @endif

        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
            aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
            </button>

                {{ session('delete') }}
            </div>
            @endif

            
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif

        <!-- END OF NOTIFICATIONS -->
    </div>
</div>
