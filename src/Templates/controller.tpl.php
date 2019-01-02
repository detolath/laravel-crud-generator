<?php
namespace [[appns]]Http\Controllers;

use Illuminate\Http\Request;
use [[appns]]Http\Requests;
use [[appns]]Http\Controllers\Controller;
use [[appns]][[model_uc]];

use DB;

class [[controller_name]]Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   	/**
   	 * Display a listing of the resource.
   	 *
   	 * @return Response
   	 */
	public function index()
	{
		$index = [[model_uc]]::all();
	    return view('[[view_folder]].index', compact('index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return view('[[view_folder]].add');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$[[model_singular]] = [[model_uc]]::findOrFail($id);
	    return view('[[view_folder]].add', [
	        'model' => $[[model_singular]]
	    ]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$[[model_singular]] = [[model_uc]]::findOrFail($id);
	    return view('[[view_folder]].show', [
	        'model' => $[[model_singular]]
	    ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request) {
	    $this->validate($request, [
	    	[[foreach:columns]]
	        	'[[i.name]]' => 'required',
	        [[endforeach]]
	    ]);

		$[[model_singular]] = null;
		if($request->_model) { $[[model_singular]] = [[model_uc]]::findOrFail($request->_model); }
		else { 
			$[[model_singular]] = new [[model_uc]];
		}
	  
	    [[foreach:columns]]
		[[if:i.name=='id']]
	    //$[[model_singular]]->[[i.name]] = $request->[[i.name]]?:0;
		[[endif]]
		[[if:i.name!='id']]
	    $[[model_singular]]->[[i.name]] = $request->[[i.name]];
		[[endif]]
	    [[endforeach]]
	    $[[model_singular]]->save();
	    return redirect()->action('[[model_uc]]Controller@index')->with('success','[[model_uc]] has been added.');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		return $this->update($request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$[[model_singular]] = [[model_uc]]::findOrFail($id);
		$[[model_singular]]->delete();
		return redirect()->action('[[model_uc]]Controller@index')->with('success', '[[model_uc]] has been deleted.');
	    
	}
	
}
