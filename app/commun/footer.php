<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
	<div class="copyright">
		&copy; Copyright <strong><span>Bibliothèque AKAITSUKI 2023</span></strong>. All Rights Reserved
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
		class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= PROJECT_DIR; ?>public/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/chart.js/chart.umd.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/echarts/echarts.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/quill/quill.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/php-email-form/validate.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/lib/noty.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= PROJECT_DIR; ?>public/js/main.js"></script>
<script src="<?= PROJECT_DIR; ?>public/select2/js/select2.full.js"></script>
<script>
	$(document).ready(function() {
		$('.btn-details').on('click', function() {
			var numAut = $(this).data('numaut');
			var modal = $('#modal-details-' + numAut);

			var nomAut = modal.find('#nom-aut-' + numAut).text();
			var prenomAut = modal.find('#prenom-aut-' + numAut).text();

			modal.find('#nom-aut-' + numAut).text(nomAut);
			modal.find('#prenom-aut-' + numAut).text(prenomAut);
		});
	});

	(function($) {
    $(document).ready(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
  }(jQuery));

</script>

</body>

</html>