@extends('auth.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>{{ __('Verifikasi Email Anda') }}</h3></div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Link Verifikasi Baru Sudah Dikirim ke Email Anda.') }}
                    </div>
                @endif

                <h4>{{ __('Sebelum Melanjutkan, Silakan Cek Email Anda Untuk Verifikasi.') }}</h4>
                <br>
                {{ __('Belum menerima email?') }} <a href="#" onclick="event.preventDefault(); document.getElementById('email-form').submit();">{{ __('kirim ulang email verifikasi') }}</a>.
                <br>
                <form id="email-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                {{-- <a href="{{ url('/') }}">{{ __('Kembali ke Halaman Login') }}</a>. --}}
            </div>
        </div>
    </div>
</div>

@endsection
