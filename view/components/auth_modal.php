<style>
    /* Change the built-in styling standard for bootstrap validation form
    instead of the standard valid style (green with checkmark) 
    we change to the normal (blue) style for the inputs when a inputfield is valid
    */
    .form-control.is-valid,
    .was-validated .form-control:valid {
        background-image: inherit !important;
        border-color: #dee2e6;
    }

    .form-control.is-valid,
    .was-validated .form-control:valid:focus {
        background-image: inherit !important;
        color: #212529;
        background-color: #FFF;
        border-color: #86B7FE;
        outline: 0;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
    }
</style>


<?php function insertAuthModal($id, $title, $btn_class, $btn_label, $action_btn_label, $action_href, $prev_dir)
{ ?>
    <!-- Button trigger modal -->
    <a type="button" id="<?php out("btn" . $id) ?>" class="<?php out($btn_class) ?>" data-bs-toggle="modal" data-bs-target="<?php out("#modal" . $id) ?>" onclick=>
        <?php echo $btn_label ?>
    </a>
    <!-- Modal -->
    <div class="modal fade" id="<?php out("modal" . $id) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="api/verify_password" method="POST" class="was-validated">
                    <?php set_csrf() ?>
                    <input type="hidden" id="<?php out("action_href" . $id) ?>" name="action_href" value="<?php out($action_href) ?>">
                    <input type="hidden" id="<?php out("prev_dir" . $id) ?>" name="prev_dir" value="<?php out($prev_dir) ?>">
                    <input type="hidden" id="<?php out("id") ?>" name="id" value="<?php out($id) ?>">

                    <?php out("prev_dir" . $id) ?>

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php out($title) ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-form-label">To confirm your action please enter your password.</label>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <div class="form-group password-needs-validation">
                                    <input class="form-control" type="password" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid password.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="<?php out($btn_class) ?>"><?php out($action_btn_label) ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    // for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        // Loop over them and prevent submission
        Array.from(document.querySelectorAll('.password-needs-validation')).forEach(form => {
            form.addEventListener('keypress', event => {
                form.classList.add('was-validated')
            }, false)
        })

    })()
</script>