<% if $Images %>
<section class="image-gallery section">
    <div class="container">
        <div class="loop">
            <div class="row">
                <% loop $Images %>
                    <figure class="col-xs-6 col-sm-4 item">
                        <a href="#" data-toggle="modal" data-target="#image_{$Pos}">{$croppedImage(360, 203)}</a>
                    </figure><!-- /.col-xs-6 col-sm-4 item -->
                    <div class="modal fade" id="image_{$Pos}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close <i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                                    {$croppedImage(1140, 641)}
                                </div>
                            </div>
                        </div>
                    </div>
                <% end_loop %>
            </div><!-- /.row -->
        </div><!-- /.loop -->
    </div><!-- /.container -->
</section><!-- /.image-gallery section -->
<% end_if %>