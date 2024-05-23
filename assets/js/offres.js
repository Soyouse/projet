document.addEventListener('DOMContentLoaded', function() {
  const toggleButtons = document.querySelectorAll('.toggle-details');
  
  toggleButtons.forEach(button => {
      button.addEventListener('click', function() {
          const offre = this.closest('.offre');
          offre.classList.toggle('expanded');
      });
  });
});