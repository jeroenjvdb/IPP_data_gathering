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
