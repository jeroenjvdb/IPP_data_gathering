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
        $screvles = $this->screvle->orderBy('created_at', 'DESC')->get();
        foreach($screvles as $screvle) {
            $screvle->data = [
                'f_bottom' => hexdec(substr($screvle->payload, 2,2)),
                'v_measure' => hexdec(substr($screvle->payload, 4,2)),
                'seconds' => hexdec(substr($screvle->payload, 6,2))/2,
                'minutes' => hexdec(substr($screvle->payload, 8,2)),
                'hours' => hexdec(substr($screvle->payload, 10,2)),
            ];
        }


        $data = [
            'screvles' => $screvles,
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
