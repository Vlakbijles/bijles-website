<!-- Login modal -->
<div id="loginmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xs">
        <form role="form" method="POST" action="login.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Inloggen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="email" class="form-control" id="login_email" placeholder="E-mailadres">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="login_pwd" placeholder="Wachtwoord">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Inloggen</button>
                </div>
            </div>
        </form>
    </div>
</div>
