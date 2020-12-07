<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Companies;

class CompaniesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = [
			"title" => "Companies",
			"current" => "companies",
			"records" => Companies::orderBy('created_at','desc')->paginate(20)
		];

		return view("companies/index",$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data = [
			"title" => "Create company",
			"current" => "companies"
		];

		return view("companies/create",$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'status' => 'required',
			'name' => 'required|min:3|max:40|unique:companies',
			'logo' => 'required|file|max:10240|mimes:jpeg,png'
		]);

		$logo = $request->file('logo');
		$extension = $request->file('logo')->extension();

		$set = new Companies();
		$set->status = ($request->input('status') == 1)?1:0;
		$set->name = $request->input('name');
		$set->slug = Str::slug($request->input('name'));
		$set->logo = $logo->storePubliclyAs('images/companies',$set->slug.'.'.$extension,['disk'=>env('APP_DISK')]);

		if ($set->save()) {
			return redirect()->route('companies')->with('success',__('msj.str_success'));
		}
		else{
			return back()->with('error',__('msj.str_error'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{

		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$record = Companies::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		$data = [
			"title" => "Edit ".$record->name,
			"current" => "companies",
			"record" => $record,
		];

		return view("companies/edit",$data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$record = Companies::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		$request->validate([
			'status' => 'required',
			'name' => 'required|min:3|max:40|unique:companies,name,'.$record->id,
		]);

		if ($request->hasFile('logo')) {

			$request->validate([
				'logo' => 'required|file|max:10240|mimes:jpeg,png'
			]);

			$logo = $request->file('logo');
			$extension = $request->file('logo')->extension();
			$record->logo = $logo->storePubliclyAs('images/companies',$record->slug.'.'.$extension,['disk'=>env('APP_DISK')]);
		}



		$record->status = $request->input('status');
		$record->name = $request->input('name');
		$record->slug = Str::slug($request->input('name'));

		if ($record->save()) {
			return back()->with('success',__('msj.str_success_update'));
		}
		else{
			return back()->with('error',__('msj.str_error_update'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$record = Companies::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		if($record->delete()){
			return back()->with('success',__('msj.str_success_delete'));
		}
		else{
			return back()->with('error',__('msj.str_error_delete'));
		}
	}
}
