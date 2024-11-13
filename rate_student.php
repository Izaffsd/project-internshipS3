<?php
include 'config.php';

$id = $_GET['id'];
$score = $_POST['score'] ?? null;

if ($score) {
    $sql = "UPDATE students SET score = '$score', status = 'Dinilai' WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$sql = "SELECT * FROM students WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
?>

<style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f3f6fa;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 34px;
            max-width: 850px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        h2, h3 {
            color: #333;
        }   

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 18px;
            margin-top: 25px;
        }

        p {
            color: #666;
            margin-bottom: 15px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 14px;
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
            font-size: 16px;
        }
        table th {
            background-color: #f9fafb;
            color: #555;
        }
        table td.tdtitle {
            text-align: left;
            font-weight: 600;
            font-size: 16px;
            color: #333;
        }
        input[type="radio"] {
            cursor: pointer;
        }
        input[type="checkbox"] {
            cursor: pointer;
        }

        textarea {
            width: 97%;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            resize: vertical;
        }

        .signature-section input {
            padding: 10px;
            width: 200px;
            margin-top: 20px;
            margin-right: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .signature-section input[type="date"] {
            width: 220px;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #0056f1;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
        }

        .total-score {
            font-weight: bold;
            font-size: 21px;
            text-align: right;
            margin-bottom: 40px;
            margin-top: 50px;
        }

        .total-score span {
            color: #0056f1;
        }

        button {
            display: inline-block;
            width: 30%;
            padding: 15px;
            background-color: #0056f1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            margin-top: 24px;
        }
        button:hover {
            background-color: #007bff;
        }

.about {
  padding: 4rem 2rem;
  background-color: #f8f9fa; /* Light background for contrast */
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
  max-width: 100%; /* Limiting width for better readability */
  margin: auto; /* Centering the section */
  width: 47%;
}

.about h2 {
  font-size: 2.5rem;
  color: #343a40; /* Dark text for better readability */
  margin-bottom: 0.5rem;
  margin: auto;

}

.about td {
  font-size: 1.4rem;
  color: #495057; /* Slightly lighter color */
  margin-bottom: 1rem;
  margin-left: 11rem;

}


.about .table {
  width: 100%;
  border-collapse: collapse; /* Remove space between table cells */
  margin-bottom: 1.5rem;
  margin-top: 1.5rem;
}

.about .table td {
  padding: 1.1rem;
  border: 1px solid #dee2e6; 
  width: 100%;
  font-size: 1.5rem;
}

.about .table .titlef {
  border: 1px solid #dee2e6; /* Light border for table cells */
  width: 30%;
}


        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
        <script>
        function downloadPDF() {
            // Initialize jsPDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'pt', 'a4');
            
            // Get all containers
            const containers = document.querySelectorAll('.container');
            let promises = [];
            
            // Process each container
            containers.forEach((container, index) => {
                promises.push(
                    html2canvas(container, {
                        scale: 2,
                        logging: false,
                        useCORS: true,
                        scrollY: -window.scrollY
                    }).then(canvas => {
                        const imgData = canvas.toDataURL('image/png');
                        const imgWidth = 550;
                        const imgHeight = canvas.height * imgWidth / canvas.width;
                        
                        // Add new page for each section except first
                        if (index > 0) {
                            doc.addPage();
                        }
                        
                        // Add content to PDF
                        doc.addImage(imgData, 'PNG', 20, 20, imgWidth, imgHeight);
                    })
                );
            });
            
            // Generate PDF when all sections are processed
            Promise.all(promises).then(() => {
                const studentName = document.querySelector('[placeholder="Enter your name"]')?.value || 'student';
                doc.save(`${studentName}_assessment.pdf`);
            });
        }

        // Your existing calculation functions remain unchanged
        function calculateSection2Score() {
            let totalScore = 0;
            const section2Radios = document.querySelectorAll('#section2-form input[type="radio"]:checked');
            section2Radios.forEach(radio => {
                totalScore += parseInt(radio.value);
            });
            document.getElementById('section2-total').textContent = totalScore;
            
            const maxScore = 40;
            const percentage = (totalScore / maxScore) * 100;
            return { total: totalScore, percentage: percentage.toFixed(1) };
        }

        function calculateSection3Score() {
            let totalScore = 0;
            const section3Radios = document.querySelectorAll('#section3-form input[type="radio"]:checked');
            section3Radios.forEach(radio => {
                totalScore += parseInt(radio.value);
            });
            document.getElementById('section3-total').textContent = totalScore;
            
            const maxScore = 50;
            const percentage = (totalScore / maxScore) * 100;
            return { total: totalScore, percentage: percentage.toFixed(1) };
        }

        function calculateLogBookScores() {
            const contentSijil = parseInt(document.querySelector('input[name="content_performance_sijil"]').value) || 0;
            const neatnessSijil = parseInt(document.querySelector('input[name="neatness_sijil"]').value) || 0;
            const totalSijil = contentSijil + neatnessSijil;
            
            const contentDiploma = parseInt(document.querySelector('input[name="content_performance_diploma"]').value) || 0;
            const neatnessDiploma = parseInt(document.querySelector('input[name="neatness_diploma"]').value) || 0;
            const totalDiploma = contentDiploma + neatnessDiploma;
            
            document.getElementById('totalScoreSijil').textContent = totalSijil;
            document.getElementById('totalScoreDiploma').textContent = totalDiploma;
        }

        // Initialize everything when document loads
        document.addEventListener('DOMContentLoaded', function() {
            // Add download button
            const downloadButton = document.createElement('button');
            downloadButton.innerHTML = 'Download Assessment PDF';
            downloadButton.className = 'btn';
            downloadButton.style.marginLeft = '20px';
            downloadButton.onclick = function() {
                // Calculate all scores before generating PDF
                calculateSection2Score();
                calculateSection3Score();
                calculateLogBookScores();
                downloadPDF();
            };
            
            // Add button next to submit button
            const submitButton = document.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.parentNode.insertBefore(downloadButton, submitButton.nextSibling);
            }
            
            // Add event listeners for calculations
            const section2Form = document.getElementById('section2-form');
            section2Form.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', calculateSection2Score);
            });
            
            const section3Form = document.getElementById('section3-form');
            section3Form.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', calculateSection3Score);
            });
            
            const logbookInputs = document.querySelectorAll('input[name^="content_performance_"], input[name^="neatness_"]');
            logbookInputs.forEach(input => {
                input.addEventListener('input', calculateLogBookScores);
            });
            
            // Initialize calculations
            calculateSection2Score();
            calculateSection3Score();
            calculateLogBookScores();
        });
    </script>
</head>

<body>

<div class="container">

    <h2>Penilaian Pelajar</h2>
    
    <table class="table">
        <tr>
            <td class="titlef">Nama</td>
            <td><?= htmlspecialchars($student['student_name']); ?></td>
        </tr>
        <tr>
            <td class="titlef">Bengkel</td>
            <td><?= htmlspecialchars($student['campus']); ?></td>
        </tr>
        <tr>
            <td class="titlef">NDP</td>
            <td><?= htmlspecialchars($student['ndp']); ?></td>
        </tr>
   
    </table>

    
    </div>


<br>
<hr>
<br>
    <div class="container">
        <h2>SEKSYEN II (SECTION II): PENILAIAN TERHADAP PELAJAR</h2>
        <p>(To be completed by the employer / employer representative)</p>
        <form action="" method="POST" id="section2-form">
            <h3>A: Assessment of Students</h3>
            <table>
                <thead>
                    <tr>
                        <th>Criteria</th>
                        <th>1 (Weak)</th>
                        <th>2 (Poor)</th>
                        <th>3 (Satisfy)</th>
                        <th>4 (Good)</th>
                        <th>5 (Very Good)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tdtitle">1. Workplace Knowledge</td>
                        <td><input type="radio" name="workplace_knowledge" value="1"></td>
                        <td><input type="radio" name="workplace_knowledge" value="2"></td>
                        <td><input type="radio" name="workplace_knowledge" value="3"></td>
                        <td><input type="radio" name="workplace_knowledge" value="4"></td>
                        <td><input type="radio" name="workplace_knowledge" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">2. General/Technical Ability</td>
                        <td><input type="radio" name="technical_ability" value="1"></td>
                        <td><input type="radio" name="technical_ability" value="2"></td>
                        <td><input type="radio" name="technical_ability" value="3"></td>
                        <td><input type="radio" name="technical_ability" value="4"></td>
                        <td><input type="radio" name="technical_ability" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">3. Instruction and decision making ability</td>
                        <td><input type="radio" name="workplace1" value="1"></td>
                        <td><input type="radio" name="workplace1" value="2"></td>
                        <td><input type="radio" name="workplace1" value="3"></td>
                        <td><input type="radio" name="workplace1" value="4"></td>
                        <td><input type="radio" name="workplace1" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">4. Persistence and Interest</td>
                        <td><input type="radio" name="workplace2" value="1"></td>
                        <td><input type="radio" name="workplace2" value="2"></td>
                        <td><input type="radio" name="workplace2" value="3"></td>
                        <td><input type="radio" name="workplace2" value="4"></td>
                        <td><input type="radio" name="workplace2" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">5. Self adjustment and work task</td>
                        <td><input type="radio" name="workplace3" value="1"></td>
                        <td><input type="radio" name="workplace3" value="2"></td>
                        <td><input type="radio" name="workplace3" value="3"></td>
                        <td><input type="radio" name="workplace3" value="4"></td>
                        <td><input type="radio" name="workplace3" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">6. Initiatives / Work Quality</td>
                        <td><input type="radio" name="workplace4" value="1"></td>
                        <td><input type="radio" name="workplace4" value="2"></td>
                        <td><input type="radio" name="workplace4" value="3"></td>
                        <td><input type="radio" name="workplace4" value="4"></td>
                        <td><input type="radio" name="workplace4" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">7. Discipline / Attendance and punctuality</td>
                        <td><input type="radio" name="workplace5" value="1"></td>
                        <td><input type="radio" name="workplace5" value="2"></td>
                        <td><input type="radio" name="workplace5" value="3"></td>
                        <td><input type="radio" name="workplace5" value="4"></td>
                        <td><input type="radio" name="workplace5" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">8. Personality and Communication Skills</td>
                        <td><input type="radio" name="workplace6" value="1"></td>
                        <td><input type="radio" name="workplace6" value="2"></td>
                        <td><input type="radio" name="workplace6" value="3"></td>
                        <td><input type="radio" name="workplace6" value="4"></td>
                        <td><input type="radio" name="workplace6" value="5"></td>
                    </tr>
                    <!-- Add more rows as per criteria -->
                </tbody>
            </table>

            <div class="total-score">
                <p>Total Score: <span id="section2-total">0</span>  /40</p>
            </div>

            <h3>B: State Student's Weaknesses (If Any)</h3>
            <textarea name="weaknesses" rows="4" placeholder="Enter weaknesses..."></textarea>

            <h3>C: Future Interest</h3>
            <p>Is your company interested in receiving students for Industrial Training in the future?</p>
            <label>
                <input type="checkbox" name="future_interest" value="Yes"> Yes
            </label>
            <label>
                <input type="checkbox" name="future_interest" value="No"> No
            </label>
            <br>
            <label for="num_students">If Yes, indicate the number of students that may be accepted:</label>
            <input type="number" name="num_students" id="num_students" min="1">

            <div class="signature-section">
                <label for="signature">Signature:</label>
                <input type="text" name="signature" id="signature" placeholder="Enter your signature">
                
                <label for="date">Date:</label>
                <input type="date" name="date" id="date">
            </div>

        </form>
    </div>
    <br>

    <hr>
    <!-- form ke 2 -->

    <br>
    <div class="container">
        <h2>SEKSYEN III ( SECTION III) PENILAIAN TERHADAP PELAJAR</h2>
        <p>(To be completed by the Assessment Officer)</p>
        <form id="section3-form">
        <h3>A: Assessment of Students</h3>
            <table>
                <thead>
                    <tr>
                        <th>Criteria</th>
                        <th>1 (Weak)</th>
                        <th>2 (Poor)</th>
                        <th>3 (Satisfy)</th>
                        <th>4 (Good)</th>
                        <th>5 (Very Good)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tdtitle">1. Workplace Knowledge</td>
                        <td><input type="radio" name="workplace_knowledge" value="1"></td>
                        <td><input type="radio" name="workplace_knowledge" value="2"></td>
                        <td><input type="radio" name="workplace_knowledge" value="3"></td>
                        <td><input type="radio" name="workplace_knowledge" value="4"></td>
                        <td><input type="radio" name="workplace_knowledge" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">2. General/Technical Ability</td>
                        <td><input type="radio" name="technical_ability" value="1"></td>
                        <td><input type="radio" name="technical_ability" value="2"></td>
                        <td><input type="radio" name="technical_ability" value="3"></td>
                        <td><input type="radio" name="technical_ability" value="4"></td>
                        <td><input type="radio" name="technical_ability" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">3. Instruction and decision making ability</td>
                        <td><input type="radio" name="workplace1" value="1"></td>
                        <td><input type="radio" name="workplace1" value="2"></td>
                        <td><input type="radio" name="workplace1" value="3"></td>
                        <td><input type="radio" name="workplace1" value="4"></td>
                        <td><input type="radio" name="workplace1" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">4. Persistence and Interest</td>
                        <td><input type="radio" name="workplace2" value="1"></td>
                        <td><input type="radio" name="workplace2" value="2"></td>
                        <td><input type="radio" name="workplace2" value="3"></td>
                        <td><input type="radio" name="workplace2" value="4"></td>
                        <td><input type="radio" name="workplace2" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">5. Self adjustment and work task</td>
                        <td><input type="radio" name="workplace3" value="1"></td>
                        <td><input type="radio" name="workplace3" value="2"></td>
                        <td><input type="radio" name="workplace3" value="3"></td>
                        <td><input type="radio" name="workplace3" value="4"></td>
                        <td><input type="radio" name="workplace3" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">6. Initiatives / Work Quality</td>
                        <td><input type="radio" name="workplace4" value="1"></td>
                        <td><input type="radio" name="workplace4" value="2"></td>
                        <td><input type="radio" name="workplace4" value="3"></td>
                        <td><input type="radio" name="workplace4" value="4"></td>
                        <td><input type="radio" name="workplace4" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">7. Discipline / Attendance and punctuality</td>
                        <td><input type="radio" name="workplace5" value="1"></td>
                        <td><input type="radio" name="workplace5" value="2"></td>
                        <td><input type="radio" name="workplace5" value="3"></td>
                        <td><input type="radio" name="workplace5" value="4"></td>
                        <td><input type="radio" name="workplace5" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">8. Personality and Communication Skills</td>
                        <td><input type="radio" name="workplace6" value="1"></td>
                        <td><input type="radio" name="workplace6" value="2"></td>
                        <td><input type="radio" name="workplace6" value="3"></td>
                        <td><input type="radio" name="workplace6" value="4"></td>
                        <td><input type="radio" name="workplace6" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">9. Character</td>
                        <td><input type="radio" name="workplace7" value="1"></td>
                        <td><input type="radio" name="workplace7" value="2"></td>
                        <td><input type="radio" name="workplace7" value="3"></td>
                        <td><input type="radio" name="workplace7" value="4"></td>
                        <td><input type="radio" name="workplace7" value="5"></td>
                    </tr>
                    <tr>
                        <td class="tdtitle">10. Student Attendance</td>
                        <td><input type="radio" name="workplace8" value="1"></td>
                        <td><input type="radio" name="workplace8" value="2"></td>
                        <td><input type="radio" name="workplace8" value="3"></td>
                        <td><input type="radio" name="workplace8" value="4"></td>
                        <td><input type="radio" name="workplace8" value="5"></td>
                    </tr>
                    <!-- Add more rows as per criteria -->
                </tbody>
            </table>


            <div class="total-score">
                Total Score: <span id="section3-total">0</span> / 50
            </div>
        </form>

        <!-- Section B -->

        
        <div class="section">
            <h3>B. Problem Students Facing During Industrial Training</h3>
            <textarea name="student_problems" rows="4" placeholder="Enter any problems faced by students..."></textarea>
        </div>

        <!-- Section C -->
        <div class="section">
            <h3>C. Review of Industrial Training Supervisor</h3>
            <textarea name="supervisor_review" rows="4" placeholder="Enter supervisor's review..."></textarea>
        </div>

        <!-- Section D - Log Book Assessment -->
        <div class="section">
            <h3>D. Log Book Assessment</h3>
            <table class="logbook-table">
                <thead>
                    <tr>
                        <th>Criteria</th>
                        <th>Certificate Program (Max 50)</th>
                        <th>Diploma Program (Max 20)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Content / Performance</td>
                        <td><input type="number" name="content_performance_sijil" max="40" placeholder="0 - 40"></td>
                        <td><input type="number" name="content_performance_diploma" max="15" placeholder="0 - 15"></td>
                    </tr>
                    <tr>
                        <td>Neatness</td>
                        <td><input type="number" name="neatness_sijil" max="10" placeholder="0 - 10"></td>
                        <td><input type="number" name="neatness_diploma" max="5" placeholder="0 - 5"></td>
                    </tr>
                </tbody>
            </table>
            <div class="total-score">

                Total for Sijil Program: <span id="totalScoreSijil">0</span> / 50
                <br>
                Total for Diploma Program: <span id="totalScoreDiploma">0</span> / 20
            </div>
        </div>

        <!-- Section E - Endorsement -->
        <div class="section signature-section">
            <h3>E. Endorsement of Industrial Tarining Supervisor</h3>
            <label for="signature">Supervisor's Signature:</label>
            <input type="text" name="signature" id="signature" placeholder="Enter your signature">

            <label for="date">Date:</label>
            <input type="date" name="date" id="date">
        </div>
        <div class="section signature-section">
            <label for="officer-stamp">Cop Pegawai Penilai (Officer Stamp)</label>
            <input type="file" id="officer-stamp" name="officer_stamp">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Submit Assessment</button>
    </div>

    <!-- JavaScript for Score Calculation -->
