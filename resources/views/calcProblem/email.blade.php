<x-mail::message>
<x-mail::panel>
***Today's Review***
________________________________________________________________

<img src="{{ $message->embed(storage_path($question))}}">

**A.** <img src="{{ $message->embed(storage_path($A))}}">
**B.** <img src="{{ $message->embed(storage_path($B))}}">
**C.** <img src="{{ $message->embed(storage_path($C))}}">
**D.** <img src="{{ $message->embed(storage_path($D))}}">
</x-mail::panel>
________________________________________________________________

**{{ $collegeboard_unit }}**

_The correct answers are located at the bottom of this email._

**Having Trouble? Watch this Short Video:** [Watch Here]({{ $tutorial_video }})

<x-slot:subcopy>
**Answer:** {{ $answer_letter }}
</x-slot:subcopy>

</x-mail::message>