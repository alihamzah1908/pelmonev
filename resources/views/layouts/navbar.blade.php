@php 
    use App\Models\VwNotif;
@endphp

<style>
.navbar-brand img {
    height: 1.5rem;
    display: block;
}
.notification .dropdown-menu .dropdown-item, .notification .dropdown-menu .dropdown-item:hover{
    color: black;
}

.notification .dropdown-menu{
    max-height: 300px;
    overflow-y: auto;
    z-index: 200;
}
</style>
<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark navbar-static">

    <!-- Header with logos -->
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="{{ url('') }}" class="d-inline-block w-100">
                <!--<img src="{{ asset('') }}/{{ configuration('INST_LOGO') }}" alt="" width="175" height="50">-->
				{{-- <img src="{{ url('/images/logo-01.png') }}" alt="" width="175" height="50"> --}}
                <img src="{{ asset('/images/navbar.png') }}" class="center mx-auto" alt="">
            </a>
		</div>
        
        <div class="navbar-brand navbar-brand-xs">
            <a href="{{ url('') }}" class="d-inline-block w-100">
                {{-- <img src="{{ asset('') }}/{{ configuration('INST_LOGO') }}" alt=""> --}}
                <img src="{{ asset('/images/logo_bpkh.png') }}"class="mx-auto" alt="">
            </a>
        </div>
    </div>
    <!-- /header with logos -->


    <!-- Mobile controls -->
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="{{ url('') }}" class="d-inline-block">
                <img src="{{ asset('') }}/{{ configuration('INST_LOGO') }}" alt="">
            </a>
        </div>	

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <!-- /mobile controls -->

    @php
        $userData = \Auth::user()->mGetDetailUser(Auth::user()->user_id)->first();
        
        $dataNotif = VwNotif::select('*')->whereRaw("proses_roles::text like '%".$userData->role_cd."%'")->orderBy('updated_at', 'DESC')->get();
    @endphp


    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
        <span class="navbar-text ml-md-3 d-md-flex align-items-md-center justify-content-md-center">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            <p class="mb-0 mr-2">{{ salam() }}</p>
           
            <div class="dropdown notification">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><i class="icon-bell3"></i>&nbsp;&nbsp;{{$dataNotif->count()}}</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  @foreach ($dataNotif as $itemNotif)
                    <a class="dropdown-item" href="{{url('proposal/'.$itemNotif->trx_proposal_id)}}">{{$itemNotif->judul_proposal}} ({{$itemNotif->proses_nm}})</a>
                  @endforeach
                </div>
              </div>
            
        </span>

        <span class="navbar-text ml-md-3 mr-md-auto">
        </span>
    </div>
    <!-- /navbar content -->
    
</div>
<!-- /main navbar -->