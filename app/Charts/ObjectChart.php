<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Pedestrian;
use App\Models\Vehicle;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectChart extends BaseChart
{
    public ?string $routeName = 'sample_chart';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $object = $request->object ?? null;
        $items = $request->items ? json_decode($request->items): [];
        $groups = [];
        foreach ($items as $single) {
            $groups['labels'][] = $single->dateFormat;
            $groups['values'][] = $single->passes;
        }
        return Chartisan::build()
            ->labels($groups['labels'] ?? [])
            ->dataset("Кол-во {$object}", $groups['values'] ?? []);
    }
}
