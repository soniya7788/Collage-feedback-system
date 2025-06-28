<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Feedback Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .section-box { display: none; margin-top: 20px; }
  </style>
</head>

<body class="bg-light">
<div class="container mt-5 mb-5">
  <h2 class="text-center mb-4">Student Feedback - B.Tech Computer Engineering</h2>

  <form id="feedbackForm" action="submit_feedback.php" method="POST">
    <!-- Student Info -->
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="col-md-6">
        <label for="mobile">Mobile Number</label>
        <input type="tel" id="mobile" name="mobile" class="form-control" pattern="[0-9]{10}" placeholder="Enter 10-digit mobile number" required>
      </div>
    </div>

    <!-- Year & Semester Selection -->
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="year">Current Year</label>
        <select class="form-control" id="year" name="year" required>
          <option value="">Select Year</option>
          <option>First</option>
          <option>Second</option>
          <option>Third</option>
          <option>Final</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="semester">Semester</label>
        <select class="form-control" id="semester" name="semester" required>
          <option value="">Select Semester</option>
        </select>
      </div>
    </div>

    <!-- Best Teachers Checkboxes -->
    <div class="form-group mb-4">
      <label>Select up to 3 Best Teachers</label>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="WGS" id="wgs"><label class="form-check-label" for="wgs">WAHI GS (WGS)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="DGR" id="dgr"><label class="form-check-label" for="dgr">DESHPANDE GR (DGR)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="PBK" id="pbk"><label class="form-check-label" for="pbk">PEDGE BK (PBK)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="DNP" id="dnp"><label class="form-check-label" for="dnp">DHOPRE NP (DNP)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="BPS" id="bps"><label class="form-check-label" for="bps">BIHADE PS (BPS)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="TA" id="ta"><label class="form-check-label" for="ta">TAHSHEEN ALI (TA)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="BRB" id="brb"><label class="form-check-label" for="brb">BACCHEWAR RB (BRB)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="LI" id="li"><label class="form-check-label" for="li">LINTA ISAL (LI)</label></div>
      <div class="form-check"><input class="form-check-input best-teacher" type="checkbox" name="best_teachers[]" value="NVW" id="nvw"><label class="form-check-label" for="nvw">NARWADE VW (NVW)</label></div>
    </div>

    <!-- Section Buttons -->
    <div class="text-center mb-4">
      <button type="button" class="btn btn-outline-primary m-2" onclick="showSection('course')">Department Feedback</button>
      <button type="button" class="btn btn-outline-success m-2" onclick="showSection('college')">Overall College Experience</button>
      <button type="button" class="btn btn-outline-dark m-2" onclick="showSection('open')">Open-Ended Feedback</button>
      <button type="button" class="btn btn-outline-info m-2" onclick="showSection('syllabus')">Syllabus Completion</button>
    </div>

    <!-- Department Feedback -->
    <div id="section-course" class="section-box">
      <h5>Department Feedback</h5>
      <div class="form-group"><label>Quality of Teaching</label><select name="quality_teaching" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
      <div class="form-group"><label>Use of Technical Resources</label><select name="technical_resources" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
      <div class="form-group"><label>Faculty Support</label><select name="faculty_support" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
    </div>

    <!-- College Feedback -->
    <div id="section-college" class="section-box">
      <h5>Overall College Experience</h5>
      <div class="form-group"><label>Library Facilities</label><select name="college_library_facilities" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
      <div class="form-group"><label>Computer Lab Facilities</label><select name="computer_labs" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
      <div class="form-group"><label>Extracurricular Activities</label><select name="extracurricular" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
      <div class="form-group"><label>Sports Facilities</label><select name="sports" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
      <div class="form-group"><label>Cleanliness in Department</label><select name="cleanliness" class="form-control" required><option value="">Select</option><option>Excellent</option><option>Good</option><option>Fair</option><option>Poor</option></select></div>
    </div>

    <!-- Open-Ended -->
    <div id="section-open" class="section-box">
      <h5>Open-Ended Feedback</h5>
      <div class="form-group"><label>Suggestions</label><textarea name="suggestions" class="form-control" rows="2"></textarea></div>
      <div class="form-group"><label>Positive Feedback</label><textarea name="positive_comments" class="form-control" rows="2"></textarea></div>
      <div class="form-group"><label>Negative Feedback</label><textarea name="negative_comments" class="form-control" rows="2"></textarea></div>
    </div>

    <!-- Syllabus Completion -->
    <div id="section-syllabus" class="section-box">
      <h5>Syllabus Completion</h5>
      <div id="syllabus-fields"></div>
    </div>

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-success">Submit Feedback</button>
    </div>
  </form>
</div>

<!-- Scripts -->
<script>
function showSection(id) {
  document.querySelectorAll('.section-box').forEach(box => box.style.display = 'none');
  document.getElementById('section-' + id).style.display = 'block';
}

const yearSemesters = {
  'First': ['Semester 1','Semester 2'],
  'Second': ['Semester 3','Semester 4'],
  'Third': ['Semester 5','Semester 6'],
  'Final': ['Semester 7','Semester 8']
};

document.getElementById('year').addEventListener('change', function(){
  const sem = document.getElementById('semester');
  sem.innerHTML = '<option value="">Select Semester</option>';
  (yearSemesters[this.value]||[]).forEach(s=> sem.add(new Option(s, s)));
});

const subjectsBySemester = {
  'Semester 1': ['Engineering Mathematics – I','Engineering Physics','Engineering Physics Lab','Communication Skills','Communication Skills Lab'],
  'Semester 2': ['Engineering Mathematics – II','Engineering Chemistry','Engineering Chemistry Lab','Energy & Environment Engineering','Workshop Practices'],
  'Semester 3': ['Engineering Mathematics – III','Discrete Mathematics','Data Structures','Computer Architecture & Organization','Object-Oriented Programming in C++','Object-Oriented Programming in Java'],
  'Semester 4': ['Design & Analysis of Algorithms','Operating Systems','Basic Human Rights','Probability and Statistics','Digital Logic Design & Microprocessors'],
  'Semester 5': ['Database Systems','Theory of Computation','Software Engineering','Human Computer Interaction','Numerical Methods','Economics and Management','Business Communication'],
  'Semester 6': ['Compiler Design','Computer Networks','Machine Learning','Geographic Information System','Internet of Things','Embedded Systems','Development Engineering','Employability and Skill Development','Consumer Behaviour'],
  'Semester 7': ['Artificial Intelligence','Cloud Computing','Bioinformatics','Distributed System','Big Data Analytics','Cryptography and Network Security','Business Intelligence','Blockchain Technology','Virtual Reality','Deep Learning','Design Thinking'],
  'Semester 8': ['Project phase – II (In-house) / Internship and Project in Industry']
};

document.getElementById('semester').addEventListener('change', function(){
  const fields = document.getElementById('syllabus-fields');
  fields.innerHTML = ''; 
  (subjectsBySemester[this.value]||[]).forEach(subject=>{
    const div = document.createElement('div');
    div.className = 'form-group';
    div.innerHTML = `
      <label>${subject}</label>
      <input type="number" 
             name="syllabus_completion[${subject.replace(/[^a-zA-Z0-9 ]/g,'')}]"
             class="form-control" min="0" max="100">
    `;
    fields.appendChild(div);
  });
  restoreInputs(); // Also restore syllabus inputs after generation
});

document.querySelectorAll('.best-teacher').forEach(cb=>{
  cb.addEventListener('change',()=>{
    const sel = document.querySelectorAll('.best-teacher:checked');
    if(sel.length>3){ cb.checked=false; alert('You can select up to 3 teachers only.'); }
  });
});

// LocalStorage persistence
function storageKey(el){
  if(el.type==='checkbox') return 'fb_'+el.name+'_'+el.value;
  return 'fb_'+el.name;
}
function restoreInputs(){
  document.querySelectorAll('#feedbackForm [name]').forEach(el=>{
    const key = storageKey(el);
    const val = localStorage.getItem(key);
    if(val!==null){
      if(el.type==='checkbox'){ el.checked = (val==='true'); }
      else{ el.value = val; }
    }
  });
}
window.addEventListener('load', restoreInputs);
document.querySelectorAll('#feedbackForm [name]').forEach(el=>{
  el.addEventListener('change',()=>{
    localStorage.setItem(storageKey(el), el.type==='checkbox'? el.checked : el.value);
  });
});
document.getElementById('feedbackForm').addEventListener('submit',()=>{
  document.querySelectorAll('#feedbackForm [name]').forEach(el=>{
    localStorage.removeItem(storageKey(el));
  });
});
</script>
</body>
</html>
