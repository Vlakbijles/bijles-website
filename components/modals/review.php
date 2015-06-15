<!-- Review modal -->
<div id="reviewmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xs">
        <form role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Recensie schrijven over Bolle Henkie</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="review_offer" class="control-label">Bijles</label>
                        <select class="form-control" id="review_offer">
                            <option>League of legends (Nerd)</option>
                            <option>Microsoft Word (Pro)</option>
                            <option>Microsoft Excel (Pro)</option>
                            <option>VIM (0/3)</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="review_msg" class="control-label">Jouw ervaring</label>
                        <textarea class="form-control" rows="3" id="review_msg" placeholder="Beschrijf jouw ervaring met Bolle Henkie"></textarea>

                    </div>
                    <label for="review_offer" class="review_rating">Waardering</label>
                    <div class="form-group">
                        <select class="form-control" id="review_rating">
                            <option>Uitmuntend</option>
                            <option>Goed</option>
                            <option>Matig</option>
                            <option>Slecht</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Versturen</button>
                </div>
            </div>
        </form>
    </div>
</div>