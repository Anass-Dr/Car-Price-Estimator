<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function search(Request $request)
    {
        $marque = $request->marque ?? '';
        $modele = $request->model ?? '';
        $annee = $request->year ?? '';
        $cars = Car::where('marque', 'like', '%' . $marque . '%')->where('modele', 'like', '%' . $modele . '%')->where('annee', $annee)->get();

        if (!count($cars)) return response()->json(["message" => "No car found"]);
        return response()->json(["data" => $cars]);
    }

    public function sum($arr)
    {
        $total = 0;
        foreach ($arr as $item) {
            $total += $item['prix'];
        }
        return $total;
    }

    public function estimatePrice(Request $request)
    {
        $marque = $request->marque ?? '';
        $modele = $request->modele ?? '';
        $annee = $request->annee ?? '';
        $cars = Car::where('marque', 'like', '%' . $marque . '%')->where('modele', 'like', '%' . $modele . '%')->where('annee', $annee)->get();

        if (!count($cars)) return response()->json(["Estimated-price" => 0]);
        $totalPrice = $this->sum($cars->toArray());
        $avgPrice = $totalPrice / count($cars);
        return response()->json(["Estimated-price" => $avgPrice]);
    }
}
