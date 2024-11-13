<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap");
:root {
  --yellow: #3137fd;
  --black: #111;
  --white: #fff;
  --light-color: #666;
  --light-bg: #eee;
  --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  --border: 0.1rem solid rgba(0, 0, 0, 0.3);
}
/* Global Styles */
:root {
  --primary-color: #007bff;
  --primary-color-hover: #0056b3;
  --secondary-color: #333;
  --background-light: #f9f9f9;
  --background-dark: #f5f5f5;
  --text-light: #495151;
  --white: #fff;
  --black: #000;
}

* {
  box-sizing: border-box;
  margin: 10px;
  padding: 0px;
  font-family: 'Helvetica Neue', sans-serif;
  
}

body {
  background-color: var(--background-dark);
  color: var(--secondary-color);
}


.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px;
}

h4.form-header {
    text-align: center;
    margin-bottom: 1.5rem;
    color: var(--secondary-color);
}

/* Home Section */
.home {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    background-color: var(--background-dark);
    position: relative;
}


.home .content {
    text-align: center;
    max-width: 560px;
    z-index: 2;
    margin-left: 6.3rem;
}

.home .content h3 {
    font-size: 3.8rem;
    color: var(--black);
    text-transform: uppercase;
    margin-bottom: 1.5rem;
}

.home .content p {
    font-size: 1.8rem;
    color: var(--text-light);
    line-height: 2.1;
    margin-bottom: 2rem;
}

/* Form Styles */
.home .form-container {
    display: flex;
    justify-content: center;
    width: 100%;
    padding: 0.4rem;
    margin-left: 10rem;
}

.home .form-card {
    background-color: var(--background-light);
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
    position: relative;
    opacity: 0.95;
}

.home .form-header {
    font-size: 2.1rem;
    font-weight: 700;
    margin-bottom: 3rem;
    text-align: center;
    color: var(--black);
}

.home .form-group {
    margin-bottom: 1.6rem;
    
}

.home .form-group label {
    display: block;
    font-size: 1.5rem;
    font-weight: 540;
    margin-bottom: 0.7rem;
    color: var(--secondary-color);
}
.home .form-group #campus, #sesi{
    display: block;
    font-size: 1.3rem;
    font-weight: 540;
    padding: 1rem;
    margin-bottom: 0.7rem;
    color: var(--secondary-color);
}

.home .form-control{
    width: 100%;
    padding: 1.4rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1.3rem;
    background-color: var(--background-light);
    transition: border-color 0.3s ease;
}

.home .form-control:focus {
    border-color: var(--primary-color);
    outline: none;
}

.home .btn {
    display: block;
    width: 100%;
    padding: 0.9rem;
    background-color: var(--primary-color);
    color: var(--white);
    border: none;
    border-radius: 5px;
    font-size: 1.4rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 3rem;
}

.home .btn:hover {
    background-color: var(--primary-color-hover);
}

.home .form-card p {
    text-align: center;
    font-size: 1.3rem;
    color: var(--text-light);
    line-height: 1;
    padding-top: 1.1rem;
}

.home .form-card p a {
    color: var(--yellow);
}

.home .form-card p a:hover {
    text-decoration: underline;
}

/* Back Button */
.backb {
    position: absolute;
    top: 20px;
    left: 20px;
}

.back-btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    background-color: var(--primary-color);
    color: var(--white);
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
}

.back-btn:hover {
    background-color: var(--primary-color-hover);
}

/* Swiper Navigation */
.home .swiper-button-next, .swiper-button-prev {
    color: var(--text-light);
    font-size: 2rem;
}

.home .swiper-button-next:hover, .swiper-button-prev:hover {
    color: var(--primary-color);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .home .content h3 {
        font-size: 2.5rem;
    }

    .home .content p {
        font-size: 1rem;
    }

    .home .form-card {
        max-width: 90%;
        margin-left: 0;
    }

    .home .form-container {
        margin-left: 0;
        padding: 1rem;
    }
}
</style>
</head>
<body>

<section class="home" id="home">

   

<div class="form-container">
  <div class="form-card">
  <h4 class="form-header">Student Information</h4>

<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="user_type" value="student">
    <div class="form-group">
        <label for="student-name">Nama Pelajar (Student's Name)</label>
        <input type="text" id="student-name" class="form-control" name="student_name" placeholder="Enter your full name" required>
    </div>
    <div class="form-group">
        <label for="campus">Kursus (Course)</label>
        <select name="campus" id="campus" required>
            <option value="" disabled selected>Select Campus</option>
            <option value="ILPKLS - TPP">ILPKLS - TPP</option>
            <option value="ILPKLS - CADD">ILPKLS - CADD</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ndp">NDP (Student ID No.)</label>
        <input type="text" id="ndp" class="form-control" name="ndp" placeholder="Enter your student ID number" required>
    </div>
    <div class="form-group">
        <label for="sesi">Sesi LI (Session)</label>
        <select name="sesi" id="sesi" required>
            <option value="" disabled selected>Select Sesi</option>
            <option value="I">I</option>
            <option value="II">II</option>
        </select>
    </div>
    <div class="form-group">
        <label for="employer">Nama dan Alamat Majikan (Name and Address of Employer)</label>
        <textarea id="employer" class="form-control" name="employer" placeholder="Enter employer's name and address" required></textarea>
    </div>
    <div class="form-group">
        <label for="company-type">Jenis Perusahaan (Type of Company)</label>
        <input type="text" id="company-type" class="form-control" name="company_type" placeholder="Enter type of company" required>
    </div>
    <div class="form-group">
        <label for="company-stamp">Cop Majikan (Company Stamp)</label>
        <input type="file" id="company-stamp" class="form-control" name="company_stamp" accept="image/*" required>
        <small>Upload gambar cop syarikat (format: jpg, png, atau gif).</small>
    </div>

    <div class="form-group">
        <label for="choose-ppli">Pilih PPLI</label>
        <select name="sesi" id="sesi" required>
            <option value="" disabled selected>Select PPLI</option>
            <option value="Rozitawati Binti Muhammad">Rozitawati Binti Muhammad</option>
            <option value="Tg Muzlina Hanim Binti Tg Semara">Tg Muzlina Hanim Binti Tg Semara</option>
            <option value="Rosnidaini Binti Shudin">Rosnidaini Binti Shudin</option>
        </select>
    </div>
    <button type="submit" class="btn">Submit</button>
</form>
  </div>
</div>

      </section>

</body>
</html>