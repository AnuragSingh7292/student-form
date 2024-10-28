function updateProgramOptions() {
    const programSelect = document.getElementById('program');
    const courseSelect = document.getElementById('course');
    const branchSelect = document.getElementById('branch');
    const regulationSelect = document.getElementById('regulation');

    const ugCourses = ['Btech', 'BBA', 'BCA', 'BPharm'];
    const pgCourses = ['Mtech', 'MBA', 'MCA'];
    const branches = {
        'Btech': ['CSE', 'ECE', 'EEE', 'Mechanical', 'Civil'],
        'BBA': ['Business Administration'],
        'BCA': ['Computer Applications'],
        'BPharm': ['Pharmacy'],
        'Mtech': ['CSE', 'ECE'],
        'MBA': ['Finance', 'HR', 'Marketing'],
        'MCA': ['Computer Applications']
    };
    const regulations = ['R19', 'R22'];

    // Clear current options
    courseSelect.innerHTML = '<option value="">Select</option>';
    branchSelect.innerHTML = '<option value="">Select</option>';
    regulationSelect.innerHTML = '<option value="">Select</option>';

    // Populate course options based on program (UG/PG)
    let selectedProgram = programSelect.value;
    let courses = selectedProgram === 'UG' ? ugCourses : pgCourses;
    courses.forEach(course => {
        let option = document.createElement('option');
        option.value = course;
        option.text = course;
        courseSelect.add(option);
    });

    // Event listener for course selection
    courseSelect.addEventListener('change', function () {
        branchSelect.innerHTML = '<option value="">Select</option>'; // Clear branch options
        let selectedCourse = courseSelect.value;
        if (selectedCourse) {
            let availableBranches = branches[selectedCourse];
            availableBranches.forEach(branch => {
                let option = document.createElement('option');
                option.value = branch;
                option.text = branch;
                branchSelect.add(option);
            });
        }
    });

    // Populate regulation options
    regulations.forEach(regulation => {
        let option = document.createElement('option');
        option.value = regulation;
        option.text = regulation;
        regulationSelect.add(option);
    });
}

