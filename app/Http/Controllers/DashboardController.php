<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Question;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasPermissionTo('view dashboard')) {
            $users = DB::table('users')
                ->select(DB::raw('YEAR(CURDATE()) - YEAR(birthday) AS age'))
                ->selectRaw('COUNT(*) as count')
                ->groupBy('age')
                ->orderBy('age', 'desc')
                ->get();

            $ageGroups = [
                'twenty' => ['min' => 20, 'max' => 29],
                'thirty' => ['min' => 30, 'max' => 39],
                'forty' => ['min' => 40, 'max' => 49],
                'fifty' => ['min' => 50, 'max' => 200] // adjust the max value as needed
            ];

            $audienceByAge = [];
            $totalAudience = 0;

            foreach ($ageGroups as $ageGroupName => $ageGroup) {
                $audienceByAge[$ageGroupName] = 0;
                foreach ($users as $user) {
                    if ($user->age >= $ageGroup['min'] && $user->age <= $ageGroup['max']) {
                        $audienceByAge[$ageGroupName] += $user->count;
                    }
                }
                $totalAudience += $audienceByAge[$ageGroupName];
            }

            foreach ($ageGroups as $ageGroupName => $ageGroup) {
                $percentage = $totalAudience > 0 ? round($audienceByAge[$ageGroupName] / $totalAudience * 100) : 0;
                $audienceByAge[$ageGroupName] = [
                    'count' => $audienceByAge[$ageGroupName],
                    'percentage' => $percentage
                ];
            }

            $usersWithoutBirthday = DB::table('users')
                ->whereNull('birthday')
                ->count();

            $audienceByAge['a'] = ($usersWithoutBirthday);
            // dd($audienceByAge);




            $usersThisMonthCount = User::whereMonth('created_at', '=', Carbon::now()->month)
                ->whereYear('created_at', '=', Carbon::now()->year)
                ->count();

            $usersLastMonthCount = User::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', '=', Carbon::now()->subMonth()->year)
                ->count();

            $usersCount = User::count();

            $percentageChange = $usersLastMonthCount > 0 ? round(($usersThisMonthCount - $usersLastMonthCount) / $usersLastMonthCount * 100) : 100;

            $questionsThisMonthCount = Question::whereMonth('created_at', '=', Carbon::now()->month)
                ->whereYear('created_at', '=', Carbon::now()->year)
                ->count();

            $questionsLastMonthCount = Question::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', '=', Carbon::now()->subMonth()->year)
                ->count();
            $percentageQuestionsChange = $questionsLastMonthCount > 0 ? round(($questionsThisMonthCount - $questionsLastMonthCount) / $questionsLastMonthCount * 100) : 100;

            $questionsCount = Question::count();
            // dd($usersLastMonthCount, $usersThisMonthCount, $percentageChange);
            return view('dashboard', compact('audienceByAge', 'percentageChange', 'usersCount', 'percentageQuestionsChange', 'questionsCount'));
        } else {
            return redirect("/");
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
