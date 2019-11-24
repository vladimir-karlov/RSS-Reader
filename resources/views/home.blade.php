@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RSS Feed</div>

                <div class="card-body">
                                        
					@if ($xml_error || empty($common_words))
					    Failed loading RSS Feed
					@else
					
	                    <h4 class="mb-3">10 Most Common Words</h4>					
					
						<ul>
						@foreach ($common_words as $word=>$count)
						    <li>{{ $word }} - {{ $count }}</li>
						@endforeach	 
						</ul>
						
						<h4 class="mt-3">News</h4>
						
						@foreach ($feed_entries as $entry)
						    <h5><a href="{{ $entry['href'] }}">{{ $entry['title'] }}</a></h5>
						    <p>{{ $entry['summary'] }}</p>
						@endforeach	 												
					
					@endif                        
					              
                </div><!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection