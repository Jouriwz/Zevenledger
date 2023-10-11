<?php

namespace App\Http\Controllers;

use App\Models\FixedCharge;
use Illuminate\Http\Request;
use Illuminate\http\Response;
use Inertia\Inertia;


class FixedChargesController extends Controller
{
    /**
     * Display a listing of the fixed charges.
     *
     */
    public function index()
    {
        $fixedCharges = auth()->user()->fixedCharges;
        return Inertia::render('Financial/FixedCharges', ['fixedCharges' => $fixedCharges]);
    }

    /**
     * Show the form for creating a new fixed charge.
     *
     */
    public function create()
    {
        return view('fixedCharges.create');
    }

    /**
     * Store a newly created fixed charge in storage.
     *
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        auth()->user()->fixedCharges()->create($data);

        return redirect()->route('fixedCharges.index')->with('success', 'Fixed charge added successfully!');
    }

    /**
     * Show the form for editing the specified fixed charge.
     *
     */
    public function edit(FixedCharge $fixedCharge)
    {
        return view('fixedCharges.edit', compact('fixedCharge'));
    }

    /**
     * Update the specified fixed charge in storage.
     *
     */
    public function update(Request $request, FixedCharge $fixedCharge)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $fixedCharge->update($data);

        return redirect()->route('fixedCharges.index')->with('success', 'Fixed charge updated successfully!');
    }

    /**
     * Remove the specified fixed charge from storage.
     *
     */
    public function destroy(FixedCharge $fixedCharge)
    {
        $fixedCharge->delete();

        return redirect()->route('fixedCharges.index')->with('success', 'Fixed charge deleted successfully!');
    }
}
