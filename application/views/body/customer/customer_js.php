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
                "targets": [4, 5],
                "orderable": false,
                "className": "text-center",
            }]
        });

        $('table#dt_customer').on('click', 'button.view', function() {

            const id = this.id;
            if (!$(this).parents('tr').hasClass('selected')) {
                dt_customer.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');
            }

            $('div#view-customer').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })

            $.ajax({
                url: "<?php echo site_url('show'); ?>/" + id,
                type: 'POST',
                data: {
                    action: 'view'
                },
                success: function(data) {

                    $("div.view-customer").html(data);
                }
            });
        });

        $('table#dt_customer').on('click', 'button.edit', function() {

            const id = this.id;
            if (!$(this).parents('tr').hasClass('selected')) {
                dt_customer.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');
            }
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

                        location.reload();
                    } else {
                        console.log(data.message);
                    }
                }
            });
        })
    });
</script>