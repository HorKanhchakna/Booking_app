@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Testimonial for {{ $testimonial->package?->location ?? 'Unknown Location' }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="content" class="form-label">Your Review</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $testimonial->content) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Testimonial</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
