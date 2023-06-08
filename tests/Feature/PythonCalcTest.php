<?php

use App\Models\PythonFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->seed(); // Seed the database
});

it('makes a power_rule problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'power_rule';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a memorized_derivatives problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'memorized_derivatives';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a product_rule_simplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'product_rule_simplified';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a product_rule_unsimplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'product_rule_unsimplified';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a quotient_rule_simplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'quotient_rule_simplified';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a quotient_rule_unsimplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'quotient_rule_unsimplified';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a chain_rule_simplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'chain_rule_simplified';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});

it('makes a chain_rule_unsimplified problem', function () {
    // Perform the necessary setup for your test, such as creating an instance of the math generator class or setting up any dependencies.
    $input = 'chain_rule_unsimplified';
    $response = $this->post('/make-calc-problem', ['type'=>$input]);
    $problem = json_decode($response->getContent(), true);
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
    $response->assertJson($problem);
});