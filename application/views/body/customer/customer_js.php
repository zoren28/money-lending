<script>
    $(document).ready(function() {

        var dt_customer = $('#dt_customer').DataTable({
            "destroy": true,
            "ajax": {
                url: "<?php echo site_url('customer_list'); ?>",
                type: "GET"
            },
            "order": [
                [0, "asc"],
                [2, "asc"]
            ],
            "columnDefs": [{
                "targets": [4, 5, 6],
                "orderable": false,
                "className": "text-center",
            }]
        });

        $('table#dt_customer').on('click', 'button.view-account', function() {

            const id = this.id;
            if (!$(this).parents('tr').hasClass('selected')) {
                dt_customer.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');
            }

            $('div#view-customer-account').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })

            $.ajax({
                url: "<?php echo site_url('show'); ?>/" + id,
                type: 'POST',
                data: {
                    view: 'customer-account'
                },
                success: function(data) {

                    $("div.view-customer-account").html(data);
                }
            });
        });

        $('table#dt_customer').on('click', 'button.edit-customer', function() {

            const id = this.id;
            if (!$(this).parents('tr').hasClass('selected')) {
                dt_customer.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');
            }

            $('div#edit-customer').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })

            $.ajax({
                url: "<?php echo site_url('show'); ?>/" + id,
                type: 'POST',
                data: {
                    view: 'customer-edit'
                },
                success: function(data) {

                    $("div.edit-customer").html(data);
                }
            });
        });

        $('table#dt_customer').on('click', 'button.customer-transaction', function() {

            const id = this.id;
            if (!$(this).parents('tr').hasClass('selected')) {
                dt_customer.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');
            }

            $('div#customer-transaction').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })

            $.ajax({
                url: "<?php echo site_url('show'); ?>/" + id,
                type: 'POST',
                data: {
                    view: 'customer-transaction'
                },
                success: function(data) {

                    $("div.customer-transaction").html(data);
                }
            });
        });

        $("button#add-user-btn").click(function() {

            $('div#add-customer').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })

            $.ajax({
                url: "<?php echo site_url('add_user'); ?>",
                type: 'POST',
                success: function(data) {

                    $("div.add-customer").html(data);
                }
            });
        });

        $("form#customer-form").submit(function(e) {

            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "<?php echo site_url('users'); ?>",
                type: 'POST',
                data: formData,
                success: function(data) {

                    data = JSON.parse(data);
                    if (data.status === 200) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500,
                            backdrop: true
                        }).then((result) => {

                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        });
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Opps!',
                            text: data.message,
                            timer: 1500,
                            backdrop: true
                        });
                    }
                }
            });
        });

        $("form#edit-customer-form").submit(function(e) {

            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "<?php echo site_url('update_customer'); ?>",
                type: 'POST',
                data: formData,
                success: function(data) {

                    data = JSON.parse(data);
                    if (data.status === 200) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500,
                            backdrop: true
                        }).then((result) => {

                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        });
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Opps!',
                            text: data.message,
                            timer: 1500,
                            backdrop: true
                        });
                    }
                }
            });
        });
    });

    function select_bank(id) {

        if ($(`input#bank${id}`).is(':checked')) {

            $(`input#account_no${id}`).prop('disabled', false);
        } else {
            $(`input#account_no${id}`).prop('disabled', true);
        }
    }
</script>