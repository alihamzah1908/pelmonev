@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body border-top-1 border-top-teal">
            <div class="list-feed">
                @foreach ($disposisi as $timeline)	
                <div class="list-feed-item">
                    <div class="text-muted">{{ tgl_dan_jam($timeline->created_at)}}<br>{{ $timeline->timeline_by }}</div>
                    <span class='badge badge-flat border-white text-white-600 d-block'>{{ comCodeName($timeline->status) }}</span>
                    Catatan : {{ $timeline->note }}
                    @if ($timeline->file_asesmen)
                    <br><a href="{{ url('storage/asesmen-file/'.$timeline->file_asesmen) }}"> Download Berkas Asesmen</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>

    var saveMethod = 'ubah';
    var baseUrl = '{{ url("status-proposal") }}';
    var dataCd = '{{ $proposal->trx_proposal_id }}';
	
    
</script>
@endpush