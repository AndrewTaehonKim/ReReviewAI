@component('mail::message')
#Today's Review
<img src="{{ $message->embed(storage_path($question))}}">

@component('mail::panel')
- A: <img src="{{ $message->embed(storage_path($A))}}">
- B: <img src="{{ $message->embed(storage_path($B))}}">
- C: <img src="{{ $message->embed(storage_path($C))}}">
- D: <img src="{{ $message->embed(storage_path($D))}}">
@endcomponent

@component('mail::subcopy')
The correct answers are located at the bottom of this email.
@endcomponent

@component('mail::panel')
**Having Trouble? Watch this Short Video:** [Watch Here]({{ $tutorial_video }})

**Unit:** {{ $collegeboard_unit }}

**Tags:**
@foreach (json_decode($tags) as $tag)
    @component('mail::tag', ['value' => $tag])
    @endcomponent
@endforeach
@endcomponent

@component('mail::panel')
**Answer:** {{ $answer_letter }}
@endcomponent
@endcomponent