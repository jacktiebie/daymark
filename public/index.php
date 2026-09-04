<?php
require_once '../app/bootstrap.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php require_once '../app/css.php'; ?>
    <link rel="stylesheet" href="../assets/css/index.css">
    <title>Document</title>
</head>
<body>
<?php require_once 'C:\Users\PC\Desktop\codingProjects\dayMark\app\views\partials\nav.php';?>
<section class="sectionOne">
    <div class="sectionOneGroup">
<h1>Lorem Ipsum dolor sit amet</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed commodo tellus ligula, vitae pharetra nulla suscipit eget. Sed faucibus arcu et dui finibus fringilla. Proin nec pharetra leo. Nam at diam laoreet, sollicitudin diam sit amet, vestibulum turpis. Ut et lacinia est. Nullam purus felis, posuere eget porttitor dignissim</p>
<div>
<a href="" class="button">Primary Action</a>
<a href="" class="button">Secundary Action</a>
</div>
</div>
<img src="assets/images/backgroundAuth.jpg" alt="">
</section>
<section class="sectionTwo">
    <h2>Bibendum amet at melstie mattis.</h2>
    <p>Rhoncus morbi et augue nec, in id ullamcorper at sit. Condimentum sit nunc in eros scelerisque sed. Commodo in viverra nunc, ullamcorper ut. Non, amet, aliquet scelerisque nullam sagittis, pulvinar. Fermentum scelerisque sit consectetur hac mi. Mollis leo eleifend ultricies purus iaculis.</p>
<div class="sectionTwoGroup">
<div class="statItem">
    <img src="./assets/images/smileyIcon.svg" alt="">

    <div>
        <p>250+</p>
        <p>Happy Customer</p>
    </div>
</div>
  <div class="statItem">
    <img src="./assets/images/smileyIcon.svg" alt="">

    <div>
        <p>250+</p>
        <p>Happy Customer</p>
    </div>
</div>
<div class="statItem">
    <img src="./assets/images/smileyIcon.svg" alt="">

    <div>
        <p>250+</p>
        <p>Happy Customer</p>
    </div>
</div>
   <div class="statItem">
    <img src="./assets/images/smileyIcon.svg" alt="">

    <div>
        <p>250+</p>
        <p>Happy Customer</p>
    </div>
</div>
</div>
</section>
<section class="sectionThree">
    <p>Testimonials</p>
    <h3>Lorem Ipsum dolor sit amet, consectur adipiscing elit. Bibendum amet at melstie mattis.</h3>
<div class="sectionThreeGroup">
    <div>
        <img src="./assets/images/logoPlaceholder.svg" alt="">
        <p>Malesuada facilisi libero, nam eu. Quis pellentesque tortor a elementum ut blandit sed pellentesque arcu. Malesuada in faucibus risus velit diam. Non, massa ut a arcu, fermentum, vel interdum.</p>
        <img src="./assets/images/userPlaceholder.svg" alt="">
        <p>Author Name</p>
        <p>Role</p>
    </div>
        <div>
        <img src="./assets/images/logoPlaceholder.svg" alt="">
        <p>Malesuada facilisi libero, nam eu. Quis pellentesque tortor a elementum ut blandit sed pellentesque arcu. Malesuada in faucibus risus velit diam. Non, massa ut a arcu, fermentum, vel interdum.</p>
        <img src="./assets/images/userPlaceholder.svg" alt="">
        <p>Author Name</p>
        <p>Role</p>
    </div>
</div>
</section>
   <?php require_once 'C:\Users\PC\Desktop\codingProjects\dayMark\app\views\partials\footer.php';?>

<?php if (isset($_SESSION['registerSucces'])) {foreach ($_SESSION['registerSucces'] as $succes) {
    echo "<span class='errorMessage'>" . $succes . "</span>";
}unset($_SESSION['registerSucces']);
}  ?>