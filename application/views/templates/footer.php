<?php if($this->session->userdata('logged_in')): ?>
            </main>
        </div>
    </div>
<?php else: ?>
    </div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {

        $('.dataTable').DataTable();
        
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    });
</script>

</body>
</html>