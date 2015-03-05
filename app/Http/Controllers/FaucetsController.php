<?php namespace App\Http\Controllers;

use App\Faucet;
use App\Http\Requests;
use Helpers\Transformers\FaucetTransformer;
use Illuminate\Http\Request;

class FaucetsController extends Controller {

    protected $faucetTransformer;

    function __construct(FaucetTransformer $transformer)   {
        $this->faucetTransformer = $transformer;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$faucets = Faucet::all();

        return $this->faucetTransformer->transformCollection($faucets->all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $faucet = Faucet::findOrFail($id);

        return $this->faucetTransformer->transform($faucet);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    private function transformCollection($faucets)
    {
        return array_map([$this, 'transform'], $faucets->toArray());
    }

    private function transform($faucet)
    {
        return [
            'id' => (int)$faucet['id'],
            'name' => $faucet['name'],
            'url' => $faucet['url'],
            'interval_minutes' => (int)$faucet['interval_minutes'],
            'min_payout' => (int)$faucet['min_payout'],
            'max_payout' => (int)$faucet['max_payout'],
            'has_ref_program' => (boolean)$faucet['has_ref_program'],
            'ref_payout_percent' => (double)$faucet['ref_payout_percent'],
            'comments' => $faucet['comments'],
            'is_paused' => (boolean)$faucet['is_paused']
        ];
    }

}