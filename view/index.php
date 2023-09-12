<?php include 'components/header.php';

?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Velkommen til Konsulent-Huset
                <?php if (!empty($_SESSION["userId"])) {
                    out(", " . $_SESSION["firstName"] . " " . $_SESSION["lastName"]);
                } ?>
            </h1>
        </div>
    </div>
    <body>

    <!-- Automatic Slideshow Images -->
  <div class="mySlides w3-display-container w3-center">
    <img src="./images/KH1.png" style="width:100%">
    <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h3>We are here to help you</h3>
      <p><b>We are here for you, we will try our best to create what you need!</b></p>   
    </div>
  </div>
  <div class="mySlides w3-display-container w3-center">
    <img src="./images/KH2.png" style="width:100%">
    <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h3>We take on every project</h3>
      <p><b>It is not possible to find a project that this team does not have the ability to handle.</b></p>    
    </div>
  </div>
  <div class="mySlides w3-display-container w3-center">
    <img src="./images/KH3.png" style="width:100%">
    <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h3>The team</h3>
      <p><b>We only have hard-working employees who are experts in their own fields.</b></p>    
    </div>
  </div>

<!-- The Home/About Section <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="review">-->

<div class="w3-modal-content w3-animate-top w3-card-4">
    <h2 class="w3-wide">The Mission</h2>
    <p class="w3-opacity"><i>We love helping others</i></p>
    <p class="w3-justify">We have created a fictional website. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur
      adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <div class="w3-row w3-padding-32">
      <div class="w3-third">
        <h3>Lonnie -Novo Nordisk</h3>
        <img src="./images/Lonnie.png" class="w3-round w3-margin-bottom" alt="review" style="width:10%">
        <h5>De Udvalgte, was tasked with creating our new system, 10/10 stars</h5>
      </div>
      <div class="w3-third">
        <h3>Rikke -CphBusiness</h3>
        <img src="./images/rikke.png" class="w3-round w3-margin-bottom" alt="review" style="width:10%">
        <h5>De Udvalgte, was tasked with creating our new system, 10/10 stars</h5>
      </div>
      <div class="w3-third">
        <h3>Carl -Mærsk</h3>
        <img src="./images/Carl.jpeg" class="w3-round" alt="review" style="width:10%">
        <h5>De Udvalgte, was tasked with creating our new system, 10/10 stars</h5>
      </div>
    </div>
  </div>

  <script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}
</script>
</body>
</main>
<?php include 'components/footer.php'; ?>