<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\Income;
use App\Models\Result;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $students = \App\Models\Student::count();
    $teachers = \App\Models\Teacher::count();
    $classes = \App\Models\SchoolClass::count();
    $subjects = \App\Models\Subject::count();

    return view('welcome', compact(
        'students',
        'teachers',
        'classes',
        'subjects'
    ));
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {



Route::middleware('role:admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});



    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

   Route::get('/dashboard', function () {

    $userRole = auth()->user()->role;

    // ==========================================
    // BASIC STATISTICS
    // ==========================================

    $studentCount = Student::count();
    $teacherCount = Teacher::count();
    $classCount = SchoolClass::count();
    $subjectCount = Subject::count();


    // ==========================================
    // ATTENDANCE
    // Admin + Teacher
    // ==========================================

    $todayAttendance = 0;
    $presentCount = 0;
    $absentCount = 0;
    $lateCount = 0;

    // ==========================================
// RECENT ACTIVITY
// ==========================================

$recentAttendances = collect();

$recentFees = collect();

$recentExpenses = collect();

$recentIncome = collect();


// Academic Activity
if (in_array($userRole, ['admin', 'teacher'])) {

    $recentAttendances = Attendance::with('student')
        ->latest('date')
        ->latest()
        ->take(5)
        ->get();
}


// Financial Activity
if (in_array($userRole, ['admin', 'accountant'])) {

    $recentFees = Fee::with('student')
        ->latest()
        ->take(5)
        ->get();

    $recentExpenses = Expense::latest()
        ->take(5)
        ->get();

    $recentIncome = Income::latest()
        ->take(5)
        ->get();
}

    $recentResults = collect();

    if (in_array($userRole, ['admin', 'teacher'])) {

        $today = today();

        $attendanceSummary = Attendance::query()
    ->whereDate('date', $today)
    ->selectRaw("
        COUNT(*) as total,
        SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present,
        SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent,
        SUM(CASE WHEN status = 'late' THEN 1 ELSE 0 END) as late
    ")
    ->first();

    $todayAttendance = (int) $attendanceSummary->total;
    $presentCount = (int) $attendanceSummary->present;
    $absentCount = (int) $attendanceSummary->absent;
    $lateCount = (int) $attendanceSummary->late;

        // Recent Results

        $recentResults = Result::with([
            'student',
            'subject'
        ])
            ->latest()
            ->take(5)
            ->get();
    }


    // ==========================================
    // FINANCE
    // Admin + Accountant
    // ==========================================

    $totalFees = 0;
    $paidFees = 0;
    $unpaidFees = 0;
    $partialFees = 0;

    $totalExpenses = 0;
    $expenseCount = 0;
    $monthlyExpenses = 0;

    $totalIncome = 0;
    $incomeCount = 0;
    $monthlyIncome = 0;

    $netBalance = 0;

    $monthlyIncomeData = [];
    $monthlyExpenseData = [];

    $monthlyLabels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];


    if (in_array($userRole, ['admin', 'accountant'])) {

        // ------------------------------------------
        // Fees
        // ------------------------------------------

        $totalFees = Fee::sum('amount');

        $paidFees = Fee::where(
            'status',
            'paid'
        )->sum('amount');

        $unpaidFees = Fee::where(
            'status',
            'unpaid'
        )->sum('amount');

        $partialFees = Fee::where(
            'status',
            'partial'
        )->sum('amount');


        // ------------------------------------------
        // Expenses
        // ------------------------------------------
            $expenseSummary = Expense::query()
                ->selectRaw("
                    COALESCE(SUM(amount), 0) as total,
                    COUNT(*) as count,
                    COALESCE(SUM(
                        CASE
                            WHEN MONTH(expense_date) = ? AND YEAR(expense_date) = ?
                            THEN amount
                            ELSE 0
                        END
                    ), 0) as monthly
                ", [now()->month, now()->year])
                ->first();

        $totalExpenses = (float) $expenseSummary->total;
        $expenseCount = (int) $expenseSummary->count;
        $monthlyExpenses = (float) $expenseSummary->monthly;


        // ------------------------------------------
        // Income
        // ------------------------------------------
            $incomeSummary = Income::query()
                ->selectRaw("
                    COALESCE(SUM(amount), 0) as total,
                    COUNT(*) as count,
                    COALESCE(SUM(
                        CASE
                            WHEN MONTH(income_date) = ? AND YEAR(income_date) = ?
                            THEN amount
                            ELSE 0
                        END
                    ), 0) as monthly
                ", [now()->month, now()->year])
                ->first();

            $totalIncome = (float) $incomeSummary->total;
            $incomeCount = (int) $incomeSummary->count;
            $monthlyIncome = (float) $incomeSummary->monthly;

        // ------------------------------------------
        // Net Balance
        // ------------------------------------------

        $netBalance = $totalIncome - $totalExpenses;


        // ------------------------------------------
        // Monthly Financial Chart
        // ------------------------------------------

        $currentYear = now()->year;

        $incomeByMonth = Income::query()
            ->selectRaw('MONTH(income_date) as month, SUM(amount) as total')
            ->whereYear('income_date', $currentYear)
            ->groupByRaw('MONTH(income_date)')
            ->pluck('total', 'month');

        $expenseByMonth = Expense::query()
            ->selectRaw('MONTH(expense_date) as month, SUM(amount) as total')
            ->whereYear('expense_date', $currentYear)
            ->groupByRaw('MONTH(expense_date)')
            ->pluck('total', 'month');

        $monthlyIncomeData = [];
        $monthlyExpenseData = [];

        for ($month = 1; $month <= 12; $month++) {

            $monthlyIncomeData[] = (float) ($incomeByMonth[$month] ?? 0);

            $monthlyExpenseData[] = (float) ($expenseByMonth[$month] ?? 0);
        }
 }


    // ==========================================
    // RETURN DASHBOARD
    // ==========================================
    // ==========================================
// DASHBOARD ALERTS
// ==========================================

$dashboardAlerts = [];


// Academic Alerts
if (in_array($userRole, ['admin', 'teacher'])) {

    if ($absentCount > 0) {
        $dashboardAlerts[] = [
            'type' => 'warning',
            'icon' => '⚠️',
            'title' => 'Absent Students',
            'message' => $absentCount . ' student(s) marked absent today.',
            'url' => route('attendances.index'),
            'action' => 'View Attendance',
        ];
    }

    if ($lateCount > 0) {
        $dashboardAlerts[] = [
            'type' => 'info',
            'icon' => '⏰',
            'title' => 'Late Students',
            'message' => $lateCount . ' student(s) marked late today.',
            'url' => route('attendances.index'),
            'action' => 'View Attendance',
        ];
    }
}


// Financial Alerts
if (in_array($userRole, ['admin', 'accountant'])) {

    if ($unpaidFees > 0) {
        $dashboardAlerts[] = [
            'type' => 'warning',
            'icon' => '💰',
            'title' => 'Unpaid Fees',
            'message' => '৳ ' . number_format($unpaidFees, 2) . ' fees are currently unpaid.',
            'url' => route('fees.index'),
            'action' => 'View Fees',
        ];
    }

    if ($netBalance < 0) {
        $dashboardAlerts[] = [
            'type' => 'danger',
            'icon' => '📉',
            'title' => 'Negative Balance',
            'message' => 'Current expenses are higher than total income.',
            'url' => route('income-report'),
            'action' => 'View Finance',
        ];
    }
}


    return view('dashboard', compact(

        // Basic
        'studentCount',
        'teacherCount',
        'classCount',
        'subjectCount',

        // Attendance
        'todayAttendance',
        'presentCount',
        'absentCount',
        'lateCount',

        // Results
        'recentResults',
        'dashboardAlerts',
        // Recent Activity
        'recentAttendances',
        'recentFees',
        'recentExpenses',
        'recentIncome',


        // Fees
        'totalFees',
        'paidFees',
        'unpaidFees',
        'partialFees',

        // Expenses
        'totalExpenses',
        'expenseCount',
        'monthlyExpenses',

        // Income
        'totalIncome',
        'incomeCount',
        'monthlyIncome',

        // Balance
        'netBalance',

        // Chart
        'monthlyIncomeData',
        'monthlyExpenseData',
        'monthlyLabels'
    ));

})->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

   Route::middleware('role:admin,teacher')->group(function () {
    Route::resource('students', StudentController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Teachers
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,teacher')->group(function () {
    Route::resource('teachers', TeacherController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | Classes
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,teacher')->group(function () {
    Route::resource('classes', SchoolClassController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Subjects
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,teacher')->group(function () {
    Route::resource('subjects', SubjectController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,teacher')->group(function () {
    Route::resource('attendances', AttendanceController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | Results
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,teacher')->group(function () {
    Route::resource('results', ResultController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | Student Result Report
    |--------------------------------------------------------------------------
    */
   

   Route::middleware('role:admin,teacher')->group(function () {

    Route::get('/student-result-report', function (Request $request) {

        $studentId = $request->input('student_id');

        $students = Student::orderBy('name')->get();

        $student = null;
        $results = collect();

        if ($studentId) {

            $student = Student::findOrFail($studentId);

            $results = Result::with('subject')
                ->where('student_id', $studentId)
                ->orderBy('exam_name')
                ->orderBy('subject_id')
                ->get();
        }

        return view('results.report', compact(
            'students',
            'student',
            'results'
        ));

    })->name('student-result-report');

}); 

    /*
    |--------------------------------------------------------------------------
    | Fees
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,accountant')->group(function () {
    Route::resource('fees', FeeController::class);
    });


    /*
    |--------------------------------------------------------------------------
    | Fee Report
    |--------------------------------------------------------------------------
    */

   Route::middleware('role:admin,accountant')->group(function () {

    Route::get('/fee-report', function (Request $request) {

        $search = $request->input('search');

        $fees = Fee::with('student')
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'fee_type',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'status',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'receipt_number',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhereHas(
                            'student',
                            function ($studentQuery) use ($search) {

                                $studentQuery
                                    ->where(
                                        'name',
                                        'like',
                                        "%{$search}%"
                                    )
                                    ->orWhere(
                                        'student_id',
                                        'like',
                                        "%{$search}%"
                                    );
                            }
                        );
                });
            })
            ->latest()
            ->get();

        $totalFees = $fees->sum('amount');

        $paidFees = $fees
            ->where('status', 'paid')
            ->sum('amount');

        $unpaidFees = $fees
            ->where('status', 'unpaid')
            ->sum('amount');

        $partialFees = $fees
            ->where('status', 'partial')
            ->sum('amount');

        return view('fees.report', compact(
            'fees',
            'totalFees',
            'paidFees',
            'unpaidFees',
            'partialFees'
        ));

    })->name('fee-report');

});

    /*
    |--------------------------------------------------------------------------
    | Expenses
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,accountant')->group(function () {
    Route::resource('expenses', ExpenseController::class);
});


    /*
    |--------------------------------------------------------------------------
    | Expense Report
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,accountant')->group(function () {

    Route::get('/expense-report', function (Request $request) {

        $search = $request->input('search');

        $expenses = Expense::query()
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'title',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'category',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'payment_method',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'reference_number',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->latest('expense_date')
            ->get();

        $totalExpenses = $expenses->sum('amount');

        $categoryTotals = $expenses
            ->groupBy('category')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        return view('expenses.report', compact(
            'expenses',
            'totalExpenses',
            'categoryTotals'
        ));

    })->name('expense-report');

});


    /*
    |--------------------------------------------------------------------------
    | Income
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,accountant')->group(function () {
    Route::resource('incomes', IncomeController::class);
});


    /*
    |--------------------------------------------------------------------------
    | Income Report
    |--------------------------------------------------------------------------
    */

   Route::middleware('role:admin,accountant')->group(function () {

    Route::get('/income-report', function (Request $request) {

        $search = $request->input('search');

        $incomes = Income::query()
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'title',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'category',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'payment_method',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'reference_number',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->latest('income_date')
            ->get();

        $totalIncome = $incomes->sum('amount');

        $categoryTotals = $incomes
            ->groupBy('category')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        return view('incomes.report', compact(
            'incomes',
            'totalIncome',
            'categoryTotals'
        ));

    })->name('income-report');

});

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';