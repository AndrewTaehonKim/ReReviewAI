<x-mail::message>
<x-mail::panel>
<h2>Today's Review</h2>
<h5> </h5>

<img src="{{ $message->embed(storage_path($question))}}">
<ul style="list-style-type:none;">
    <li> <img src="{{ $message->embed(storage_path($A))}}"></li>
    <li> <img src="{{ $message->embed(storage_path($B))}}"></li>
    <li> <img src="{{ $message->embed(storage_path($C))}}"></li>
    <li> <img src="{{ $message->embed(storage_path($D))}}"></li>
</ul>
</x-mail::panel>
<h3>The correct answers are located at the bottom of this email</h3>

<h5> </h5>

**{{ $collegeboard_unit }}**

*Having Trouble?* _Watch this Quick Video:_ [Review Here]({{ $tutorial_video }})

<x-slot:subcopy>
    <div class="answer"> <b>Answer:</b> {{ $answer_letter }} </div>
</x-slot:subcopy>

</x-mail::message>