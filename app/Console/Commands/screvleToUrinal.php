<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Screvle;
use App\Urinal;

class screvleToUrinal extends Command
{
    private $screvle;
    private $urinal;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urinal:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse screvle data to the urinal table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Screvle $screvle, Urinal $urinal)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(Screvle::all() as $request) {
	    $data = [
		'nb_flush' => hexdec(substr($request->payload, 2, 2)),
		'clogged' => hexdec(substr($request->payload, 6, 2)),
		'congestion' => hexdec(substr($request->payload, 8, 2)),
		'nb_mkey' => hexdec(substr($request->payload, 10, 2)),
		't_evac' => hexdec(substr($request->payload, 14, 2)),
	    ];

	    Urinal::create([
	        'payload' => $request->payload,
	        'address' => $request->address,
		'type'    => $request->type,
		'nb_flush'=> hexdec($data['nb_flush']),
		'clogged' => $data['clogged'] ? true : false,
		'nb_mkey' => $data['congestion'] ? true : false,
		't_evac'  => hexdec($data['t_evac']),
	    ]);	
	}
    }
}
