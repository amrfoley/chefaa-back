<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\IPharmacyRepository;

class PharmacyController extends Controller
{
    protected $pharmacyRepo;

    public function __construct(IPharmacyRepository $pharmacyRepository)
    {
        $this->pharmacyRepo = $pharmacyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pharmacies.index', [
            'pharmacies' => $this->pharmacyRepo->paginate(25)
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
        $data = $request->validate([
            'name'      => 'required|max:120',
            'address'   => 'required|max:120',
            'code'      => 'required|unique:pharmacies,code|max:120'
        ]);

        $this->pharmacyRepo->create($data);

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
            'pharmacy' => $this->pharmacyRepo->withPaginated($pharmacyID, 'products', 10)
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
            'pharmacy' => $this->pharmacyRepo->find($pharmacyID)
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
        $data = $request->validate([
            'name'         => 'required|max:160',
            'address'   => 'required|max:260',
            'code'           => 'required|unique:pharmacies,code,'.$pharmacyID
        ]);

        $this->pharmacyRepo->update($data, $pharmacyID);

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
        $this->pharmacyRepo->delete($pharmacyID);

        return redirect()->back();
    }
}
