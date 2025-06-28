<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "feedbacksys");
if ($conn->connect_error) die("DB error: " . $conn->connect_error);

$allYears = ['First', 'Second', 'Third', 'Final'];
$allSemesters = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8'];

$filter_option = $_GET['filter_option'] ?? 'overall';
$year_selected = $_GET['year'] ?? '';
$semester_selected = $_GET['semester'] ?? '';

$where = [];
if ($filter_option === 'year' && $year_selected) {
    $where[] = "year = '" . $conn->real_escape_string($year_selected) . "'";
} elseif ($filter_option === 'semester' && $semester_selected) {
    $where[] = "semester = '" . $conn->real_escape_string($semester_selected) . "'";
}
$filter_sql = $where ? "WHERE " . implode(" AND ", $where) : "";

// Fetch charts and stats only if not viewing open-ended feedback
if ($filter_option !== 'open_ended') {
    $dept = $conn->query("
      SELECT
        ROUND(AVG(CASE quality_teaching WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS quality,
        ROUND(AVG(CASE technical_resources WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS resources,
        ROUND(AVG(CASE faculty_support WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS support
      FROM feedback $filter_sql
    ")->fetch_assoc();

    $col = $conn->query("
      SELECT
        ROUND(AVG(CASE college_library_facilities WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS library,
        ROUND(AVG(CASE computer_labs WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS labs,
        ROUND(AVG(CASE extracurricular WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS extra,
        ROUND(AVG(CASE sports WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS sports,
        ROUND(AVG(CASE cleanliness WHEN 'Excellent' THEN 4 WHEN 'Good' THEN 3 WHEN 'Fair' THEN 2 WHEN 'Poor' THEN 1 END),2) AS clean
      FROM feedback $filter_sql
    ")->fetch_assoc();

    $tc = [];
    $res = $conn->query("SELECT best_teachers FROM feedback $filter_sql");
    while ($r = $res->fetch_assoc()) {
        foreach (json_decode($r['best_teachers'], true) as $t) {
            $tc[$t] = ($tc[$t] ?? 0) + 1;
        }
    }
    arsort($tc);
    $topTeachers = array_slice($tc, 0, 5, true);

    $tot = [];
    $cnt = [];
    $res2 = $conn->query("SELECT syllabus_completion FROM feedback $filter_sql");
    while ($r = $res2->fetch_assoc()) {
        $arr = json_decode($r['syllabus_completion'], true);
        if (is_array($arr)) {
            foreach ($arr as $sub => $v) {
                $val = floatval($v);
                $tot[$sub] = ($tot[$sub] ?? 0) + $val;
                $cnt[$sub] = ($cnt[$sub] ?? 0) + 1;
            }
        }
    }
    $labels = [];
    $values = [];
    foreach ($tot as $sub => $sum) {
        $avg = round($sum / $cnt[$sub], 1);
        $labels[] = strlen($sub) > 15 ? substr($sub, 0, 15) . '…' : $sub;
        $values[] = $avg;
    }
}

// Open-ended feedback fetch only if selected
$open = [];
if ($filter_option === 'open_ended') {
    $q = $conn->query("SELECT email, mobile, year, semester, suggestions, positive_comments, negative_comments FROM feedback $filter_sql");
    while ($r = $q->fetch_assoc()) $open[] = $r;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
<div class="container my-4">
    <h2 class="text-center mb-4">Admin Feedback Dashboard</h2>

    <form method="POST" class="text-end mb-3">
        <button name="logout" class="btn btn-danger">Logout</button>
    </form>

    <!-- Filter Form -->
    <form method="GET" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label class="form-label"><strong>Filter Option</strong></label>
            <select name="filter_option" id="filter_option" class="form-select" required>
                <option value="overall" <?= $filter_option === 'overall' ? 'selected' : '' ?>>Overall B.Tech Feedback</option>
                <option value="year" <?= $filter_option === 'year' ? 'selected' : '' ?>>Particular Year Feedback</option>
                <option value="semester" <?= $filter_option === 'semester' ? 'selected' : '' ?>>Particular Semester Feedback</option>
                <option value="open_ended" <?= $filter_option === 'open_ended' ? 'selected' : '' ?>>Open-Ended Feedback</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label"><strong>Year</strong></label>
            <select name="year" id="year" class="form-select" <?= !in_array($filter_option, ['year', 'open_ended']) ? 'disabled' : '' ?>>
                <option value="">-- Select Year --</option>
                <?php foreach ($allYears as $y): ?>
                    <option <?= $year_selected === $y ? 'selected' : '' ?>><?= $y ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label"><strong>Semester</strong></label>
            <select name="semester" id="semester" class="form-select" <?= !in_array($filter_option, ['semester', 'open_ended']) ? 'disabled' : '' ?>>
                <option value="">-- Select Semester --</option>
                <?php foreach ($allSemesters as $s): ?>
                    <option <?= $semester_selected === $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Apply</button>
        </div>
    </form>

    <!-- Charts Section -->
    <?php if ($filter_option !== 'open_ended'): ?>
        <strong>Department Feedback (Avg. 1–4)</strong>
        <canvas id="deptChart" class="mb-4" style="max-width:400px;"></canvas>

        <strong>College Experience (Avg. 1–4)</strong>
        <canvas id="collegeChart" class="mb-4" style="max-width:400px;"></canvas>

        <strong>Syllabus Completion (%)</strong>
        <canvas id="syllabusChart" class="mb-4" style="max-width:400px;"></canvas>

        <strong>Top 5 Best Teachers</strong>
        <ol class="mb-4">
            <?php foreach ($topTeachers as $name => $votes): ?>
                <li><?= htmlspecialchars($name) ?> — <?= $votes ?> votes</li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>

    <!-- Open-ended Feedback Display -->
    <?php if ($filter_option === 'open_ended'): ?>
        <strong>Open-Ended Feedback (Filtered)</strong>
        <ul class="list-group mb-4">
            <?php foreach ($open as $f): ?>
                <li class="list-group-item">
                    <strong>Email:</strong> <?= htmlspecialchars($f['email']) ?> |
                    <strong>Year:</strong> <?= $f['year'] ?> |
                    <strong>Sem:</strong> <?= $f['semester'] ?><br>
                    <strong>Suggestions:</strong> <?= nl2br(htmlspecialchars($f['suggestions'])) ?><br>
                    <strong>Positive:</strong> <?= nl2br(htmlspecialchars($f['positive_comments'])) ?><br>
                    <strong>Negative:</strong> <?= nl2br(htmlspecialchars($f['negative_comments'])) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<script>
    document.getElementById('filter_option').addEventListener('change', e => {
        const opt = e.target.value;
        document.getElementById('year').disabled = !(opt === 'year' || opt === 'open_ended');
        document.getElementById('semester').disabled = !(opt === 'semester' || opt === 'open_ended');
    });

    <?php if ($filter_option !== 'open_ended'): ?>
    new Chart(document.getElementById('deptChart'), {
        type: 'bar',
        data: {
            labels: ['Quality', 'Resources', 'Support'],
            datasets: [{
                label: 'Avg',
                data: [<?= $dept['quality'] ?: 0 ?>, <?= $dept['resources'] ?: 0 ?>, <?= $dept['support'] ?: 0 ?>],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107']
            }]
        },
        options: { indexAxis: 'y', responsive: true, scales: { x: { beginAtZero: true, max: 4 } } }
    });

    new Chart(document.getElementById('collegeChart'), {
        type: 'bar',
        data: {
            labels: ['Library', 'Labs', 'Extra', 'Sports', 'Clean'],
            datasets: [{
                label: 'Avg',
                data: [<?= $col['library'] ?: 0 ?>, <?= $col['labs'] ?: 0 ?>, <?= $col['extra'] ?: 0 ?>, <?= $col['sports'] ?: 0 ?>, <?= $col['clean'] ?: 0 ?>],
                backgroundColor: ['#0d6efd', '#6f42c1', '#198754', '#dc3545', '#fd7e14']
            }]
        },
        options: { indexAxis: 'y', responsive: true, scales: { x: { beginAtZero: true, max: 4 } } }
    });

    new Chart(document.getElementById('syllabusChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: '%',
                data: <?= json_encode($values) ?>,
                backgroundColor: '#0dcaf0'
            }]
        },
        options: { indexAxis: 'y', responsive: true, scales: { x: { beginAtZero: true, max: 100 } } }
    });
    <?php endif; ?>
</script>
</body>
</html>
