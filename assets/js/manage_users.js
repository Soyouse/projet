document.addEventListener('DOMContentLoaded', function() {
  var changePasswordModal = document.getElementById('changePasswordModal');
  changePasswordModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var userId = button.getAttribute('data-userid');

      var modalUserId = changePasswordModal.querySelector('#modalUserId');
      modalUserId.value = userId;
  });
});