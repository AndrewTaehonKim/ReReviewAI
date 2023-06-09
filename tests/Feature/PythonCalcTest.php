<?php

use App\Http\Controllers\CalcProblemController;
use Illuminate\Http\Request;

beforeEach(function () {
    $this->seed(); // Seed the database
});
// change method to public before testing
it('makes a power_rule problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'power_rule';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a memorized_derivatives problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'memorized_derivatives';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a product_rule_simplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'product_rule_simplified';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a product_rule_unsimplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'product_rule_unsimplified';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a quotient_rule_simplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'quotient_rule_simplified';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a quotient_rule_unsimplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'quotient_rule_unsimplified';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a chain_rule_simplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'chain_rule_simplified';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();

it('makes a chain_rule_unsimplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'chain_rule_unsimplified';
    $controller = new CalcProblemController();
    $request = new Request(['type'=>$input]);

    $response = $controller->makeProblem($request);
    $problem = json_decode($response, true);
    // Expectations and Assertions
    expect($problem)->toHaveKeys([
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        'python_file_id'
    ]);
})->group('CalcProblemControllerPrivate')->skip();