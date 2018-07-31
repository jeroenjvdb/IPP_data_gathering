<?php

namespace App\Http\Controllers\Api;

use App\Urinal;
use App\UrinalData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlushController extends Controller
{
    private $urinal;

    private $data;

    public function __construct(UrinalData $data, Urinal $urinal) {
        $this->urinal = $urinal;
        $this->data = $data;
    }

    public function index($urinal) {
        $data = Urinal::where('id', $urinal)->first()->data()->orderBy('created_at', 'DESC')->get();

        return $data;
    }
}
