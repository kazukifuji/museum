<button id="hamburgerButton" class="hamburger-button" type="button">

  <?php for ($i = 0; $i < 2; $i++) : ?>

    <svg class="hamburger-button__svg" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 70 15" height="15" width="70">
      <path d="M 0,7.5 H 70"></path>
    </svg>

  <?php endfor; ?>

</button>