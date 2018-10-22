<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Screvle;
use App\Urinal;
use App\UrinalData;
use Log;
use App\Events\FlushEvent;

class ScrevleController extends Controller
{
    private $screvle;

    private $urinal;

    public function __construct(Screvle $screvle, Urinal $urinal) {
        $this->screvle = $screvle;
        $this->urinal = $urinal;
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
			'urinals' => $this->urinal->all(),
        ];

        return $data;//view('screvle.index', $data);
    }

/* Guillaume : Addon for HMI */
    public function hmi() {

	$screvles = $this->screvle->where('type', 66)->orderBy('created_at', 'DESC')->get();
	foreach($screvles as $parser) {
		$parser->data = [
			'nb_flush' => hexdec(substr($parser->payload, 2, 2)),
			'clogged' => hexdec(substr($parser->payload, 6, 2)),
			'congestion' => hexdec(substr($parser->payload, 8, 2)),
			'nb_mkey' => hexdec(substr($parser->payload, 10, 2)),
			't_evac' => hexdec(substr($parser->payload, 14, 2)),
		];
	} 

	$urinals = $this->urinal->with(['uData' => function($query) {
		return $query->orderBy('created_at', 'DESC')->limit(100);
	}])->get();

	foreach($urinals as $urinal) {
		$urinal->lastClog = $urinal->data()->orderBy('created_at','DESC')->where('clogged',true)->first();
		$urinal->lastCongestion = $urinal->data()->orderBy('created_at','DESC')->where('congestion',true	)->first();
	}



	$data = [
		'screvles' => $screvles,
		'urinals' => $urinals,
	];

	//dd($data['urinals']);

	return view('screvle.hmi', $data);
    }

/* Guillaume : end */
	protected function littleToBigEndian($little) {
		return implode('',array_reverse(str_split($little,2)));
	}

	public function add(Request $request) 
	{
		if(substr($request->payload,0,2) != '0x') {
			return "false";
		}
	        Log::info('request', [$request->all()]);
		$data = [
			'nb_flush' => hexdec(substr($request->payload, 2, 2)),
			'clogged' => hexdec(substr($request->payload, 6, 2)),
			'congestion' => hexdec(substr($request->payload, 8, 2)),
			'nb_mkey' => hexdec(substr($request->payload, 10, 2)),
			't_evac' => hexdec(substr($request->payload, 14, 2)),
		];



		$uData = [
			'payload' => $request->payload,
			'address' => $request->address,	
	                'type'    => $request->type,					
			'nb_flush' => hexdec(substr($request->payload, 2, 2)),
			'nb_user' => hexdec(substr($request->payload, 4, 2)),
			'status' => hexdec(substr($request->payload, 6, 2)),
			'user_flush_time' => hexdec(substr($request->payload, 8, 2)),
			'key_present_ev' => hexdec($this->littleToBigEndian(substr($request->payload, 10, 2))),
			'flush_time' => hexdec($this->littleToBigEndian(substr($request->payload, 14, 2))),
		];
		Log::info('parsed request', $data);	

        $this->screvle->create([
            'payload' => $request->payload,
            'address' => $request->address,
            'type' => $request->type,
        ]);

        $flush = $this->urinal->where('device',$request->address)->first()->data()->create([
		    'payload' => $request->payload,
		    'address' => $request->address,
		    'type'    => $request->type,
		    'nb_flush'=> $data['nb_flush'],
		    'clogged' => $data['clogged'] ? true : false,
		    'nb_mkey' => $data['congestion'] ? true : false,
		    't_evac'  => hexdec($data['t_evac']),
		]);

		$uFlush = $this->urinal->where('device',$request->address)
			->first()
			->uData()
			->create($uData);

		$channelName = 'flush.' . $flush->device_id;

		event(new FlushEvent($channelName, $uFlush));

        return "true";
	}
	
	
}
