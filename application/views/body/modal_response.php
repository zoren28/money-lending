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
<?php
} else if ($request == 'customer-account') {
?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Bank</th>
                <th>Account No.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($customer_banks as $bank) {
            ?>
                <tr>
                    <td><?= $i; ?>.</td>
                    <td><?= $bank->bank ?></td>
                    <td><?= $bank->account_no ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php
} else if ($request == 'customer-edit') {
?>
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="customer_id" value="<?= $customer->id ?>">
            <div class="form-group"> <span class="text-danger">*</span>
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $customer->firstname ?>" required>
            </div>
            <div class="form-group"> <span class="text-danger">*</span>
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $customer->lastname ?>" required>
            </div>
            <div class="form-group"> <span class="text-danger">*</span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $customer->email ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="middlename">Middlename</label>
                <input type="text" name="middlename" id="middlename" value="<?= $customer->middlename ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="suffix">Suffix</label>
                <select name="suffix" id="suffix" class="form-control">
                    <option value="">-- Select --</option>
                    <?php
                    $suffixes = array('Jr', 'Sr', 'I', 'II', 'III');
                    foreach ($suffixes as $key => $value) {
                        if (in_array($customer->suffix, $suffixes)) {

                            echo '<option value="' . $value . '" selected>' . $value . '</option>';
                        } else {

                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
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
                $bank_ids = array_column($customer_banks, 'bank_id');
                foreach ($banks as $bank) {

                    $key = array_search($bank->id, $bank_ids);
                    $account_no = '';
                    if ($key >= 0) {

                        $account_no = $customer_banks[$key]->account_no;
                    }
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="chk_bank[]" id="bank<?= $bank->id ?>" value="<?= $bank->id ?>" <?= (in_array($bank->id, $bank_ids)) ? 'checked' : ''; ?> onchange="select_bank(this.value)">
                        </td>
                        <th><?= $bank->bank ?></th>
                        <td>
                            <input type="text" name="account_no[]" id="account_no<?= $bank->id ?>" class="form-control" <?= (in_array($bank->id, $bank_ids)) ? '' : 'disabled'; ?> value="<?= (in_array($bank->id, $bank_ids)) ? $account_no : ''; ?>" required>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
<?php
}
?>