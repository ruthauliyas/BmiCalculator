<?php

namespace App\Http\Controllers;

use App\Models\Bmi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class BmiController extends Controller
{
    public function index()
    {
        return Inertia::render('Bmis/Index', [
            'bmis' => Bmi::all()->map(function($bmi){
                return [
                    'id' => $bmi->id,
                    'height' => $bmi->height,
                    'weight' => $bmi->weight,
                    'bmiscore' => $bmi->bmiscore,
                ];
            })
        ]);
    }

    public function create(){
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        $weight = $request->weight;
        $height = $request->height;
        $bmiscore = $weight / (($height / 100) ** 2);

        Bmi::create([
            'height' => $height,
            'weight' => $weight,
            'bmiscore' => $bmiscore,
        ]);

        return Redirect::back()->with('success', 'BMI data has been stored successfully.');
    }

    public function destroy(Bmi $bmi)
    {
        $bmi->delete();

        return redirect()->back()->with('success', 'BMI record has been deleted.');
    }
}
