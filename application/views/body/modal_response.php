<?php

if ($request == 'customer-form') {

?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"> <span class="text-danger">*</span>
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="form-group"> <span class="text-danger">*</span>
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="form-group"> <span class="text-danger">*</span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="middlename">Middlename</label>
                <input type="text" name="middlename" id="middlename" class="form-control">
            </div>
            <div class="form-group">
                <label for="suffix">Suffix</label>
                <select name="suffix" id="suffix" class="form-control">
                    <option value="">-- Select --</option>
                    <?php
                    $suffixes = array('Jr', 'Sr', 'I', 'II', 'III');
                    foreach ($suffixes as $key => $value) {
                        echo '<option value="' . $value . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <h5>Customer Bank(s)</h5>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php
                foreach ($banks as $bank) {
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="chk_bank[]" id="bank<?= $bank->id ?>" value="<?= $bank->id ?>" onchange="select_bank(this.value)">
                        </td>
                        <th><?= $bank->bank ?></th>
                        <td>
                            <input type="text" name="account_no[]" id="account_no<?= $bank->id ?>" class="form-control" disabled required>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        function select_bank(id) {

            if ($(`input#bank${id}`).is(':checked')) {

                $(`input#account_no${id}`).prop('disabled', false);
            } else {
                $(`input#account_no${id}`).prop('disabled', true);
            }
        }
    </script>
<?php
} else if ($request == 'show-customer-form') {
}
?>