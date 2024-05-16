<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Table;

class AdminScheduleController
{
    public function index(Request $request)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $datesOfWeek = [];

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $datesOfWeek[] = $date->toDateString();
        }

        return view('admin.schedule.index', ['days' => collect($datesOfWeek), 'employees' => User::all(), 'selectedEmployees' => Schedule::all(), 'tables' => Table::all()]);
    }

    public function store(Request $request)
    {

        // Table / Date

        $values = array();

        foreach ($request->toArray() as $key => $value) {
            if ($key == '_token') continue;
            $keys = explode('/', $key);
            $values[$keys[0]][] = [$keys[1], $value];
        }

        foreach ($values as $key => $value) {
            foreach ($value as $v) {

                if ($v[1] == 0) continue;

                $schedule = Schedule::where(['date' => Carbon::parse($v[0])->format('Y-m-d'), 'table_id' => $key])->first();
                if (!$schedule) {
                    Schedule::create(['date' => Carbon::parse($v[0])->format('Y-m-d'), 'employee_id' => $v[1], 'table_id' => $key]);
                } else {
                    $schedule->update(['employee_id' => $v[1]]);
                }
            }
        }

        return redirect()->route('admin.schedule.index');
    }
}
