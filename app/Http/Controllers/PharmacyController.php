<?php

namespace App\Http\Controllers;

use App\Services\PharmacyService;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    protected $pharmacyService;

    public function __construct(PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pharmacies.index', [
            'pharmacies' => $this->pharmacyService->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->pharmacyService->create($request);

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pharmacyID)
    {
        return view('pharmacies.show', [
            'pharmacy' => $this->pharmacyService->withProducts($pharmacyID)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pharmacyID)
    {
        return view('pharmacies.edit', [
            'pharmacy' => $this->pharmacyService->find($pharmacyID)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pharmacyID)
    {
        $this->pharmacyService->update($request, $pharmacyID);

        return redirect()
            ->route('pharmacies.show', ['pharmacy' => $pharmacyID])
            ->with('success', 'Pharmacy updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pharmacyID)
    {
        $this->pharmacyService->destroy($pharmacyID);

        return redirect()->back();
    }
}
