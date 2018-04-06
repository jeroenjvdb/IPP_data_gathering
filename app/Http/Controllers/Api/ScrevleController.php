<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Screvle;
use Log;

class ScrevleController extends Controller
{
    private $screvle;

    public function __construct(Screvle $screvle) {
        $this->screvle = $screvle;
    }

    public function index() {
        $data = [
            'screvles' => $this->screvle->all(),
        ];

        return view('screvle.index', $data);
    }

    public function add(Request $request) {
        Log::info('request', [$request->all()]);

        $this->screvle->create([
            'payload' => $request->data,
            'address' => $request->address,
            'type' => $request->type,
        ]);

        return "true";
    }
}
