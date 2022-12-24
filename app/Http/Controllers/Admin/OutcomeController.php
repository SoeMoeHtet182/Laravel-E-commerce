<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outcome;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcome = Outcome::latest()->paginate(10);
        $todayOutcome = Outcome::whereDay('created_at', date('d'))->sum('amount');
        return view('admin.outcome.index', compact('outcome', 'todayOutcome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.outcome.create');
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
            'title' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);
        Outcome::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description
        ]);
        return redirect('/admin/outcome')->with('success', 'Outcome created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outcome = Outcome::where('id', $id)->first();
        return view('admin.outcome.edit', compact('outcome'));
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
        $outcome = Outcome::where('id', $id)->first();
        if (!$outcome) {
            return redirect()->back()->with('error', 'Outcome not found');
        }

        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);

        $outcome->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description
        ]);
        return redirect('/admin/outcome')->with('success', 'Outcome updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
