<?php

namespace App\Http\Controllers;

use App\Models\Pedestrian;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectController extends Controller
{
    public function list(Request $request, $object)
    {
        $type = $request->type ?? 'highcharts';
        $group = $request->group ?? 'clear';

        switch ($object) {
            case 'pedestrians':
                $model = new Pedestrian();
                break;
            case 'vehicles':
                $model = new Vehicle();
                break;
            default:
                abort(404);
        }

        switch ($group) {
            case 'years':
                $result = $model::query()
                    ->select(DB::raw('YEAR(date) as dateFormat'), DB::raw('sum(count) as passes'), 'object')
                    ->groupBy('dateFormat', 'object')
                    ->get();
                break;
            case 'month':
                $result = $model::query()
                    ->select(
                        DB::raw("CONCAT(YEAR(date), '-', LPAD(MONTH(date), 2, '0')) as dateFormat"),
                        DB::raw('sum(count) as passes'),
                        'object'
                    )
                    ->groupBy('dateFormat', 'object')
                    ->get();
                break;
            case 'days':
                $result = $model::query()
                    ->select(
                        DB::raw("CONCAT(YEAR(date), '-', LPAD(MONTH(date), 2, '0'), '-', DAY(date)) as dateFormat"),
                        DB::raw('sum(count) as passes'),
                        'object'
                    )
                    ->groupBy('dateFormat', 'object')
                    ->get();
                break;
            default:
                $result = $model::query()
                    ->select(DB::raw('date as dateFormat'), DB::raw('count as passes'), 'object')
                    ->orderBy('dateFormat')
                    ->get();
        }

        return view('object.list', [
            'items' => $result,
            'object'=> $object,
            'type'  => $type,
            'group' => $group,
        ]);
    }
}
