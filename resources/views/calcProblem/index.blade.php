@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-white">Question: {!! $calcProblem->question !!}</h1>
            <div class="justify-left">
                <p class="text-white">A: \({{$calcProblem->A}}\)</p>
                <p class="text-white">B: \({{$calcProblem->B}}\)</p>
                <p class="text-white">C: \({{$calcProblem->C}}\)</p>
                <p class="text-white">D: \({{$calcProblem->D}}\)</p>
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded" onclick="toggleAnswers()">Show Answers</button>
            <div id="answers" class="hidden">
                <p class="text-white">Answer: {{$calcProblem->answer_letter}}</p>
            </div>
            <div class="flex flex-col justify-center text-white">
                <h1 class="mx-auto">Need Help?</h1>
                <a href={{$calcProblem->tutorial_video}}><h2>Watch a Tutorial Video</h2></a>
            </div>
        </div>
    </div>
@endsection 

<script>
    function toggleAnswers() {
        var answers = document.getElementById('answers');
        answers.classList.toggle('hidden');
    }
</script>