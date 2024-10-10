<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneticAlgorithmController extends Controller
{

    private $innerPopSize;
    private $innerCrossoverRate;
    private $innerMutationRate;
    private $innerGenerations;
    private $outerPopSize;
    private $outerCrossoverRate;
    private $outerMutationRate;

    public function __construct()
    {

    }
}
